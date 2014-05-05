<script>
function toggleForm(such, doge, wow) {
	$('#feedback').hide();
	if ($(such).css('display') == 'none') {
		$(doge).hide();
		$(such).fadeIn(500);
		$(wow).focus();
	} else
		$(such).hide();
}
</script>

<div id="such_options">
<div class="padded_right"><b><a onClick="toggleForm('#login_form','#registration_form','#login_input_username');return false;" href="">login</a></b> • <a onClick="toggleForm('#registration_form','#login_form','#register_input_username');return false;" href="">register</a></div>
<div id="feedback">
<?php
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error)
            echo $error;
    }
    if ($login->messages) {
        foreach ($login->messages as $message)
            echo $message;
    }
}

if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error)
            echo $error;
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message)
            echo $message;
    }
}
?>
</div>

<div id="login_form" style="display:none;">
<form method="post" action="" name="loginform">
	<table>
		<tr><td>username</td><td><input id="login_input_username" class="login_input" type="text" name="user_name" required /></td></tr>
		<tr><td>password</td><td><input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required /></tr>
	</table>
    <input type="submit" class="styled-button" style="float: right;" name="login" value="wow" />
</form>
</div>
<div id="registration_form" style="display:none;">
<form method="post" action="" name="registerform">
    <label for="register_input_username">username</label>
    <br />
    <input id="register_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
	<br />
    <label for="register_input_email">email</label>
    <br />
    <input id="register_input_email" class="login_input" type="email" name="user_email" required />
	<br />
    <label for="register_input_password_new">password</label>
    <br />
    <input id="register_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
	<br />
    <label for="register_input_password_repeat">confirm password</label>
    <br />
    <input id="register_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
	<br />
    <input type="submit" class="styled-button" name="register" value="track my periods" />
</form>
</div>
</div>
