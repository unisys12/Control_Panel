<section class="summary">
	<header class="header">
		<h2>Rayco Timesheet for <?php echo $name ?></h2>
		<h6>for the date range of <?php echo $starting_range ?> through <?php echo $ending_range ?></h6>
	</header>
	
	<article>

		<?php	
		echo "<table class='print' rules='all'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>" . 'Date' . "</th>";
		echo "<th>" . 'Work Hours' . "</th>";
		echo "<th>" . 'Vacation Hours' . "</th>";
		echo "<th>" . 'Sick Hours' . "</th>";
		echo "<th>" . 'Holidays' . "</th>";
		echo "<th>" . 'Payable Totals' . "</th>";
		echo "</tr>";
		echo "</thead><tr>";	

		foreach ($time->result() as $row){
				echo "<td>" . $row->date . "</td>";
				echo "<td>" . $row->wrkHrs . "</td>";
				echo "<td>" . $row->vacHrs . "</td>"; 
				echo "<td>" . $row->sickHrs . "</td>";
				echo "<td>" . $row->holiday . "</td>";
				echo "</tr>";
			}
			echo "</tr>";
			echo "<tr><td><span><h6>Period Totals</h6></span>";
			echo "<td>" . $wrkTotal . "</td>";
			echo  "<td>"  . $vacTotal . "</td>";
			echo  "<td>"  . $sickTotal . "</td>";
			echo "<td>" . $holidayTotal . "</td>";
			echo "<td><span>" . $total . "</span></td>";

			echo "</td></tr>";
			echo "</table>";
		?>
	</article>
</section>