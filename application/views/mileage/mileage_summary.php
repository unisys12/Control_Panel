	
	<section id="panel" class="flexbox">
		<div class="summary_form">
		<h2>Mileage Summary</h2>
		<?php	

		echo form_open('mileage/mileage_summary', '');
		echo form_date('starting_range', isset($starting_range) ? $starting_range : set_value("starting_range")) . "<br />";
		echo form_date('ending_range', isset($ending_range) ? $ending_range : set_value("ending_range"));
		echo form_submit('submit', 'Submit');
		echo form_close();
		
		echo "<br />";		
		?>         
		</div>
		<article id="panel_display">
			<?php

			$attr = array('class' => 'class = "icon-printer"');

			echo form_open('mileage/mileage_print', '');
			echo form_hidden('starting_range', isset($starting_range) ? $starting_range : set_value("starting_range"));
			echo form_hidden('ending_range', isset($ending_range) ? $ending_range : set_value("ending_range"));
			echo form_submit('print', 'Print', $attr['class']);
			echo form_close();

			echo "<br><br>";
			echo "<table class='mileage-table' rules='all'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>" . 'Date' . "</th>";
			echo "<th>" . 'Starting Odometer' . "</th>";
			echo "<th>" . 'Ending Odometer' . "</th>";
			echo "<th>" . 'Daily Total' . "</th>";
			echo "</tr>";
			echo "</thead><tr>";

			foreach ($mileage->result() as $row){
				echo "<td>" . $row->date . "</td>";
				echo "<td>" . $row->start . "</td>";
				echo "<td>" . $row->end . "</td>"; 
				echo "<td>" . $row->total . "</td>";
				echo "<td>" . anchor('mileage/mileage_edit/' . $row->id , 'Edit');
				echo "</tr>";
			}
			echo "<tr><td colspan='3'><span><h6>Monthly Total</h6></span><td>" . $monthly_total . "</td></td></tr>";
			echo "</table>";
			echo "<br>";
			?>

		</article>
	</section>