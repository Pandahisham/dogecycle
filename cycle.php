<?php

function get_cycle() {
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!mysqli_connect_errno()) {
		// get cycle day
		$sql = "SELECT MAX(start) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "';";
		$result = $db_connection->query($sql);
		$row = mysqli_fetch_array($result);
		if ($row[0] == null)  // no periods wow
			return array('day' => '-1', 'avg' => '0', 'type' => 'amaze', 'img' => 'doge-regular.png');
		$datetime1 = new DateTime(date('Y-m-d'));
		$datetime2 = new DateTime($row[0]);
		$day = $datetime1->modify('+1 day')->diff($datetime2)->format('%a');

		// get logged cycles count
		$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end != '0000-00-00';";
		$result = $db_connection->query($sql);
		$row = mysqli_fetch_array($result);
		$cnt = intval($row[0]);

		// get average cycle length
		$avg = 28.0;
		if ($cnt < 2)
			$len = $avg;
		else {
			$sql = "SELECT DATEDIFF(MAX(start), MIN(start)) / " . ($cnt-1) . " FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end != '0000-00-00';";
			$result = $db_connection->query($sql);
			$row = mysqli_fetch_array($result);
			$len = floatval($row[0]);
		}

		// wow period
		$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end = '0000-00-00';";
		$result = $db_connection->query($sql);
		$row = mysqli_fetch_array($result);
		if ($row[0] != '0')
			return array('day' => $day, 'avg' => $len, 'type' => 'blood', 'img' => '02.png');

		// catherine's magic
		$proportion = $day / $len;
		if ($proportion < (7 / $avg))
			return array('day' => $day, 'avg' => $len, 'type' => 'happy', 'img' => '01.png');
		else if ($proportion < (12 / $avg))
			return array('day' => $day, 'avg' => $len, 'type' => 'pretty', 'img' => '03.png');
		else if ($proportion < (14 / $avg))
			return array('day' => $day, 'avg' => $len, 'type' => 'horny', 'img' => '04.png');
		else if ($proportion < (24 / $avg))
			return array('day' => $day, 'avg' => $len, 'type' => 'happy', 'img' => '01.png');
		else
			return array('day' => $day, 'avg' => $len, 'type' => 'PMS', 'img' => '05.png');
	} else
		return array('day' => '-3', 'avg' => '0.0', 'type' => 'database error', 'img' => 'doge-regular.png');
}

if ($login->isUserLoggedIn() == true)
	echo json_encode(get_cycle());
else
	echo json_encode(array('day' => '-2', 'avg' => '0.0', 'type' => 'doge', 'img' => 'doge-regular.png'));

?>
