<section class="timesheet">
	<?php

	$timesheet_attr = array('class'=>'timesheet');

	echo form_open('timesheet/time_submit', $timesheet_attr);
	echo form_fieldset('Rayco Timesheet');

	echo form_label('Name', 'name');
	echo form_input('name', isset($name) ? $name : set_value("name"));
	echo form_error('name');
	echo "<br>";

	echo form_label('Date', 'date');
	echo "<br>";
	echo form_date('date', '');
	echo form_error('date');
	echo "<br>";

	echo form_label('Holiday?', 'holiday');
	echo form_checkbox('holiday', '1');
	echo "<br>";

	echo form_label('Hours Worked', 'wrkHrs');
	echo form_input('wrkHrs', '8');
	echo form_error('wrkHrs');
	echo "<br>";

	echo form_label('Vacation Hrs', 'vacHrs');
	echo form_input('vacHrs', '0');
	echo form_error('vacHrs');
	echo "<br>";

	echo form_label('Sick Hrs', 'sickHrs');
	echo form_input('sickHrs', '0');
	echo form_error('sickHrs');
	echo "<br>";

	echo form_submit('submit', 'Submit');
	echo form_reset('reset', 'Reset');

	echo form_fieldset_close();
	echo form_close();
	echo "<br>";

	echo anchor('timesheet/time_summary', 'Time Summary');
	?>
</section>