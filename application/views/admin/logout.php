<section class="row">
	<article class="small-8 columns">
	<?php

	echo $logout_message;

	echo form_open('');
	echo form_fieldset('PLEASE LOG IN!');
	echo form_label('Username: ');
	echo form_input('username', set_value('username'), 'id="username"') . "<br />";
	echo form_error('username');
	echo form_label('Password: ');
	echo form_password('password', '', 'id="password"') . "<br />";
	echo form_error('password');
	echo form_submit('submit', 'Login');
	echo form_reset('reset', 'Clear');
	echo form_fieldset_close();
	echo form_close();

	?>
	<small>Forgot your password? Click <a href="fetch.php">here</a>!</small><br />
	<small>Don't have an account yet? Sign up <a href="register.php">here</a>!</small>
</article>
</section>