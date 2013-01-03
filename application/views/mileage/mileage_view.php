
	<section id="panel" class="flexbox">
		<article id="panel_display">
				<?php 
				$mileage_attr = array('class'=>'mileage_form');
				echo form_open('mileage/mileage_submit', $mileage_attr);
				echo form_fieldset('Enter Your Milegae');
				echo form_label('Date: ') . "<br />";
				echo form_date('date') . "<br />";
				echo form_error('date');
				echo form_label('Starting Odometer: ');
				echo form_input('start') . "<br />";
				echo form_error('start');
				echo form_label('Ending Odometer: ');
				echo form_input('end') . "<br />";
				echo form_error('end');
				echo form_label('Notes: ') . "<br />";
				echo form_textarea('notes', '', '') . "<br />";
				echo form_error('notes');
				echo form_submit('submit', 'Submit');
				echo form_fieldset_close();
				echo form_close();
				echo "<br>";
				echo anchor('mileage/mileage_summary', 'Mileage Summary');
				?>
		</article>
	</section>

