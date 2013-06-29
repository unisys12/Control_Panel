<section class="print_summary">
	<header class="print_header">
		<h4>Rayco Mileage Report Summary for <?php echo $name ?></h4>
		<h6>for the date range of <?php echo $starting_range ?> through <?php echo $ending_range ?></h6>
	</header>

	<article>

		<?php
		echo "<table class='print' rules='all'>";
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
				echo "</tr>";
			}
			echo "<tr><td colspan='3'><span><h6>Monthly Total</h6></span><td>" . $monthly_total . "</td></td></tr>";
			echo "</table>";
		?>
	</article>
</section>

<div class="signature"></div>
