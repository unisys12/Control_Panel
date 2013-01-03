<section class="main_content">
	<?php 

	echo form_open('admin/register');
	echo form_fieldset('Registration');

	echo form_label('Full Name:', 'name');
	echo form_input('name', set_value('name'));
	echo form_error('name');

	echo form_label('Username:', 'username');
	echo form_input('username', set_value('username'));
	echo form_error('username');

	echo form_label('Email:', 'email');
	echo form_input('email', set_value('email') );
	echo form_error('email');

	echo form_label('Password:', 'password');
	echo form_password('password');
	echo form_error('password');

	echo form_label('Confirm Password:', 'password_confirmed');
	echo form_password('password_conf', '');
	echo form_error('password');

	echo form_submit('submit', 'Register');

	echo form_fieldset_close();
	echo form_close();

	?>
</section>