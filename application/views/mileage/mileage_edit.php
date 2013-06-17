<section class="row">
		<article class="small-8 columns">
				<?php

				$receipt_input = array(
				'name'        => 'receipt',
		    'id'          => 'receipt',
		    'value'       => 'Receipt'
				);

				$receipt_label = array(
					'id'  => 'receipt_label'
				);

				$mileage_attr = array('class'=>'mileage_form');
				echo form_open('mileage/mileage_correction', $mileage_attr);
				echo form_fieldset('Edit Your Mileage');

				echo form_label('Date: ') . "<br />";
				echo form_date('date', $edit->date) . "<br />"; // Fill value with date value from mileage summary
				echo form_error('date');

				echo form_label('Starting Odometer: ');
				echo form_input('start', $edit->start) . "<br />"; // Fill value with data from mileage summary
				echo form_error('start');

				echo form_label('Ending Odometer: ');
				echo form_input('end', $edit->end) . "<br />"; // Fill value with data from mileage summary
				echo form_error('end');

				echo form_label('Add Receipt to Todays Report: ', 'receipt', $receipt_label);
				echo form_file($receipt_input);

				echo form_label('Notes: ') . "<br />";
				echo form_textarea('notes', $edit->notes, '') . "<br />";
				echo form_error('notes');

				echo form_submit('submit', 'Submit');
				echo form_fieldset_close();
				echo form_close();
				echo "<br>";
				echo anchor('mileage/mileage_summary', 'Mileage Summary');
				?>
		</article>
	</section>