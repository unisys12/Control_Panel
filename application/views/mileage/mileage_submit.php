<section class="row">
	<article class="small-8 columns">
		<?php
		echo "<br>";
		echo "<p>" . $msg . "</p>";



		?>
		<br />

		<div class="summary_form">
		<h2>Mileage Summary</h2>
		<?php
		echo form_open('mileage/mileage_summary', '');
		echo form_date('starting_range', '') . "<br />";
		echo form_date('ending_range', '');
		echo form_submit('submit', 'Submit');
		echo form_close();

		echo "<br />";
		?>
		</div>

	</article>
</section>