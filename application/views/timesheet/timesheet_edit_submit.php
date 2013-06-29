<section class="row">
	<article class="small-8 columns">
	<?php

	echo "<h3>" . "For a summary of your entered time, enter a range below." . "</h3>";

	echo form_open('timesheet/time_summary', '');
	echo form_date('starting_range', '') . "<br />";
	echo form_date('ending_range', '');
	echo form_submit('submit', 'Submit');
	echo form_close();
	?>
	</article>
</section>
