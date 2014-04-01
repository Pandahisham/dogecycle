<?php
if (isset($_POST['add_cycle'])) {
	$start_date_value = $_POST['start_date'];
	if (strlen($_POST['end_date']))
		$end_date_value = $_POST['end_date'];
	else
		$end_date_value = "0000-00-00";

	if ((strtotime($start_date_value) <= time() and strtotime($end_date_value) <= time()) and  // wow foresight
		($start_date_value < $end_date_value or $end_date_value == "0000-00-00")) {
		$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (!mysqli_connect_errno()) {
			if ($end_date_value == "0000-00-00") {
				$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end = '0000-00-00';";
				$result = $db_connection->query($sql);
				$row = mysqli_fetch_array($result);
				if ($row[0] == '0') {  // only one period pls :(
					$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end >= '" . $start_date_value . "';";
					$result = $db_connection->query($sql);
					$row = mysqli_fetch_array($result);
					if ($row[0] == '0') {  // no magic retroactive or successive periods
						$sql = "INSERT INTO cycles VALUES ('" . $_SESSION['user_name'] . "', '" . $start_date_value . "', '" . $end_date_value . "');";
						$db_connection->query($sql);
					}
				}
			} else {
				$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND ('" .
					   $start_date_value . "' BETWEEN start AND end OR '" .
					   $end_date_value   . "' BETWEEN start AND end OR ('" .
					   $start_date_value . "' < start AND '" . $end_date_value . "' > end));";
				$result = $db_connection->query($sql);
				$row = mysqli_fetch_array($result);
				if ($row[0] == '0') {  // no collisions
					$sql = "INSERT INTO cycles VALUES ('" . $_SESSION['user_name'] . "', '" . $start_date_value . "', '" . $end_date_value . "');";
					$db_connection->query($sql);
				}
			}
		}
	}
} else if (isset($_POST['delete_cycle'])) {
	$cycle = $_POST['cycle'];
	$parts = explode('_', $cycle);

	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!mysqli_connect_errno()) {
		$sql = "DELETE FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND start = '" . $parts[0] . "' AND end = '" . $parts[1] . "';";
		$db_connection->query($sql);
	}
} else if (isset($_POST['begin_cycle'])) {
	$start_date_value = date('Y-m-d');

	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!mysqli_connect_errno()) {
		$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end = '0000-00-00';";
		$result = $db_connection->query($sql);
		$row = mysqli_fetch_array($result);
		if ($row[0] == '0') {  // only one period pls :(
			$sql = "SELECT MAX(end) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "';";
			$result = $db_connection->query($sql);
			$row = mysqli_fetch_array($result);
			if ($row[0] != $start_date_value) {  // end period and start new cycle on same day = not normal
				$sql = "INSERT INTO cycles VALUES ('" . $_SESSION['user_name'] . "', '" . $start_date_value . "', '0000-00-00');";
				$db_connection->query($sql);
			}
		}
	}
} else if (isset($_POST['end_cycle'])) {
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!mysqli_connect_errno()) {
		$sql = "SELECT start FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end = '0000-00-00';";
		$result = $db_connection->query($sql);
		$row = mysqli_fetch_array($result);
		if ($row[0] != null) {
			$start_date_value = $row[0];
			$end_date_value   = date('Y-m-d');

			$sql = "DELETE FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND start = '" . $start_date_value . "' AND end = '0000-00-00';";
			$db_connection->query($sql);

			if ($start_date_value != $end_date_value) {
				$sql = "INSERT INTO cycles VALUES ('" . $_SESSION['user_name'] . "', '" . $start_date_value . "', '" . $end_date_value . "');";
				$result = $db_connection->query($sql);
			}
		}
	}
}
?>