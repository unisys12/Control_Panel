<section id="panel" class="flexbox">
		<div class="summary_form">
		<h2>Timesheet Summary</h2>
		<?php

		echo form_open('timesheet/time_summary', '');
		echo form_date('starting_range', isset($starting_range) ? $starting_range : set_value("starting_range")) . "<br />";
		echo form_date('ending_range', isset($ending_range) ? $ending_range : set_value("ending_range"));
		echo form_submit('submit', 'Submit');
		echo form_close();
		
		echo "<br />";		
		?>         
		</div>
		<article id="panel_display">
			<!-- <a href="admin/mileage_print" class="icon-printer"> Print</a> -->
			<?php

			$attr = array('class' => 'class = "icon-printer"');

			echo form_open('timesheet/timesheet_print', '');
			echo form_hidden('starting_range', isset($starting_range) ? $starting_range : set_value("starting_range"));
			echo form_hidden('ending_range', isset($ending_range) ? $ending_range : set_value("ending_range"));
			echo form_submit('print', 'Print', $attr['class']);
			echo form_close();

			//echo anchor("admin/mileage_print", ' Print', 'class="icon-printer"');
			//echo anchor("admin/mileage_pdf", 'PDF', 'class="icon-file-pdf"'); 
			echo "<br><br>";
			echo "<table class='mileage-table' rules='all'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>" . 'Date' . "</th>";
			echo "<th>" . 'Hours Worked' . "</th>";
			echo "<th>" . 'Vacation Hours' . "</th>";
			echo "<th>" . 'Sick Hours' . "</th>";
			echo "<th>" . 'Holiday Hours' . "</th>";
			echo "</tr>";
			echo "</thead><tr>";

			foreach ($time->result() as $row){
				echo "<td>" . $row->date . "</td>";
				echo "<td>" . $row->wrkHrs . "</td>";
				echo "<td>" . $row->vacHrs . "</td>"; 
				echo "<td>" . $row->sickHrs . "</td>";
				echo "<td>" . $row->holiday . "</td>";
				echo "<td>" . anchor('timesheet/time_edit/' . $row->id , 'Edit');
				echo "</tr>";
			}
			//echo "<tr><td colspan='3'><span><h6>Monthly Total</h6></span><td>" . $monthly_total . "</td></td></tr>";
			echo "</table>";
			?>

		</article>
	</section>