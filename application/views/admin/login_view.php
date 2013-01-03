	<div>
		<?php
		
		echo form_open('admin/index');
		echo form_fieldset('Rayco Control Panel');
		
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
		<div class="note">
			<small> <?php anchor('admin/fetch', 'Forgot your password?') ?> </small><br />		
			<small> <?php anchor('admin/register', 'Sign up here!')  ?> </small>
		</div>
	</div>