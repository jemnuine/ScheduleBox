<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>scripts/http://platform.twitter.com/widgets.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-transition.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-alert.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-modal.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-dropdown.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-scrollspy.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-tab.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-tooltip.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-popover.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-button.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-collapse.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-carousel.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-typeahead.js"></script>
	    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-affix.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>scripts/time.js"></script>
		<script>
			$("#addbutton").click(function() {
				$('#modalAddSemester').modal('show');
				$('#modalAddDepartment').modal('show');
				$('#modalAddCourse').modal('show');
				$('#modalAddSection').modal('show');
				$('#modalAddSubject').modal('show');
				$('#modalAddRoom').modal('show');
				$('#modalAddInstructor').modal('show');
				$('.semester').focus();
			});

			$("#target2").click(function() {
				$('#modalRegister').modal('show');
				$('.regusername').focus();
			});

			$(document).ready(function() { 
			  	$("#time").load("<?php echo base_url();?>addons/now.php");
			});

			$('.dropdown-toggle').dropdown();
			<?php if(!is_null($add_sem_error_action)) echo $add_sem_error_action;?> 
		</script>
	</body>
</html>