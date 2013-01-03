	
	<section id="panel" class="flexbox">
		<article id="panel_display">
			<p>Welcome, <?php echo $this->user->getName(); ?>, to the Rayco Employee Administration Panel</p>
			<?php

			echo form_open('');
			echo form_label('Date Function Test: ');
			echo form_date('date', '');
			echo form_close();
			echo "<br />";
			?>

		</article>
	</section>