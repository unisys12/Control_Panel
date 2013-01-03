<section class="main_content">
	<?php 

	echo form_fieldset('Retrieve Password');
	echo form_open('admin/fetch');

	echo form_label('What is your name: ', 'name');
	echo form_input('name');
	echo form_error('name');

	echo form_label('What is your E-Mail', 'email');
	echo form_input('email');
	echo form_error('email');

	echo form_submit('Submit', 'submit');
	echo form_fieldset_close();
	echo form_close();
	?>
</section>