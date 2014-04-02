<div id="such_options" onMouseOver="document.getElementById('options').style.display='';" onMouseOut="document.getElementById('options').style.display='none';">
<div class="padded_right">very <b><?php echo $_SESSION['user_name']; ?></b> • <a href="../index.php?logout">bye bye</a></div>
<div id="options" style="display:none;">
	<br />
	<form method="post" action="">
		<input type="submit" class="styled-button" <?php 
			$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if (!mysqli_connect_errno()) {
				$sql = "SELECT COUNT(*) FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' AND end = '0000-00-00';";
				$result = $db_connection->query($sql);
				$row = mysqli_fetch_array($result);
				if ($row[0] != '0')
					echo 'value="end period" name="end_cycle"';
				else
					echo 'value="begin period" name="begin_cycle"';
			}
		?>>
	</form>
	<br />
	<form method="post" action="">
		start blood <input type="date" class="styled_input" name="start_date" required><br />
		end blood <input type="date" class="styled_input" name="end_date"><br />
		<input type="submit" class="styled-button" value="add period" name="add_cycle">
	</form>
	<br />

	<form onSubmit="return confirm('much caution erase period no return');" method="post" action="">
		suffering<br />
		<select class="styled_input" name="cycle" value='' style="min-width: 50px;">
		<?php
			$sql = "SELECT start, end FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' ORDER BY start DESC;";
			$db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if (!mysqli_connect_errno()) {
				$result = mysqli_query($db_connection, $sql);
				while ($row = mysqli_fetch_array($result))
					printf("<option value='%s_%s'>%s ~ %s</option>",
					       $row['start'], $row['end'],
					       date("F j, Y", strtotime($row['start'])),
					       ($row['end'] == '0000-00-00') ? "current suffering" : date("F j, Y", strtotime($row['end'])));
				mysqli_close($con);
			}
		?>
		</select>
		<br />
		<input type="submit" class="styled-button" value="delete period" name="delete_cycle">
	</form>
</div>
</div>
