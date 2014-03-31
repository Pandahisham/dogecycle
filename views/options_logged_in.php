<script>
function toggleOptions() {
	if (document.getElementById('options').style.display == 'none')
		document.getElementById('options').style.display='';
	else
		document.getElementById('options').style.display='none';
}
</script>

<a onClick="toggleOptions();return false;" href="">such options</a>
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
		start blood<br />
		<table border="0" cellspacing="0">
		<tr><td align=left>
		<select class="selectClass" name="start_month" value=''>
		<option value='01'>January</option>
		<option value='02'>February</option>
		<option value='03'>March</option>
		<option value='04'>April</option>
		<option value='05'>May</option>
		<option value='06'>June</option>
		<option value='07'>July</option>
		<option value='08'>August</option>
		<option value='09'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
		</select>

		</td><td align=left>   
		<select class="selectClass" name="start_day">
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
		<option value='24'>24</option>
		<option value='25'>25</option>
		<option value='26'>26</option>
		<option value='27'>27</option>
		<option value='28'>28</option>
		<option value='29'>29</option>
		<option value='30'>30</option>
		<option value='31'>31</option>
		</select>

		</td><td align=left>
		<input type="text" pattern="[0-9]{4}" class="styled_input" name="start_year" size=4 value="<?php echo date('Y'); ?>" required>
		</table>

		end blood<br />
		<table border="0" cellspacing="0">
		<tr><td align=left>
		<select class="selectClass" name="end_month" value=''>
		<option value='00'>--</option>
		<option value='01'>January</option>
		<option value='02'>February</option>
		<option value='03'>March</option>
		<option value='04'>April</option>
		<option value='05'>May</option>
		<option value='06'>June</option>
		<option value='07'>July</option>
		<option value='08'>August</option>
		<option value='09'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
		</select>

		</td><td align=left>   
		<select class="selectClass" name="end_day">
		<option value='00'>--</option>
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
		<option value='24'>24</option>
		<option value='25'>25</option>
		<option value='26'>26</option>
		<option value='27'>27</option>
		<option value='28'>28</option>
		<option value='29'>29</option>
		<option value='30'>30</option>
		<option value='31'>31</option>
		</select>

		</td><td align=left>
		<input type="text" pattern="[0-9]{4}" class="styled_input" name="end_year" size=4 value="0000" required>

		<br />
		</table>
		<input type="submit" class="styled-button" value="add period" name="add_cycle">
	</form>
	<br />

	<form method="post" action="">
	suffering
	<table border="0" cellspacing="0">
		<tr><td align=left>
		<select class="selectClass" name="cycle" value=''>
		<?php
			$sql = "SELECT start, end FROM cycles WHERE user_name = '" . $_SESSION['user_name'] . "' ORDER BY start DESC;";
			$db_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if (!mysqli_connect_errno()) {
				$result = mysqli_query($db_connection, $sql);
				while ($row = mysqli_fetch_array($result))
					echo "<option value='" . $row['start'] . "_" . $row['end'] . "'>" . $row['start'] . " ~ " . $row['end'] . "</option>";
				mysqli_close($con);
			}
		?>
		</select>
		</td>
		<br />
		</table>
		<input type="submit" class="styled-button" value="delete period" name="delete_cycle">
	</form>
</div>