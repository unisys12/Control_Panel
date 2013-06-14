	<div class="row">

		<footer class="small-8 columns">
			<?php echo anchor('admin/logout', 'Log Out'); ?><br>
			<small>&copy; Phillip Jackson Designs; Project for Rayco Inc</small><br>
			<small><span class="icon-html5"></span><span class="icon-css3"></span> </small>
		</footer>

	</div>

	</div><!-- End Main Wrapper -->

<!-- Check for Zepto support, load jQuery if necessary -->
<script>
  document.write('<script src=/employees/javascripts/vendor/'
    + ('__proto__' in {} ? 'zepto' : 'jquery')
    + '.js><\/script>');
</script>

<script src=<?php echo base_url('javascripts/foundation/foundation.js')?>></script>

<script>
	$(function(){
		$(document).foundation();
	});
</script>

<?php

if($mileage == "mileage"){
	echo '<script src="' . base_url('javascripts/mileage_reciept.js') . '"></script>';
}
?>
</body>
</html>