<script>
function toggleOptions() {
	document.getElementById('registration_form').style.display = 'none';
	document.getElementById('login_form').style.display = '';
	document.getElementById('login_input_username').focus();
	document.getElementById('user_feedback').style.display = 'none';
	document.getElementById('options_feedback').style.display='';
}
</script>

<a onClick="toggleOptions();return false;" href="">such options</a>
<br />
<div class="feedback" id="options_feedback" style="display:none;">
	require account wow
</div>