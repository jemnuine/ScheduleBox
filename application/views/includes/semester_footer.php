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

			$('.dropdown-toggle').dropdown();

			

			$(document).ready(function() { 
			  	$("#time").load("<?php echo base_url();?>addons/now.php");
			  	
			});

			$(".editbutton").click(function() {
			        //$('#modalEditSemester').modal('show');
			        var form_data = {
			        	dataid: $(this).attr('id'),
			        	ajax: '1'
			        };

			        var request = $.ajax({
			        	url: "<?php echo base_url();?>index.php/semester/list_edit_semester",
			        	type: 'POST',
			        	data: form_data
			        });

			        request.done(function (response, textStatus, jqXHR){
				        $('#modalEditSemester').modal('show');
						var temp = new Array();
						temp = response.split("*");
				       	$('#editsemester').val(temp[0]);
				       	$('#edityear').val(temp[1]);
				       	$('#editselectsemester').val(temp[0]);
				    });
				    	
			    });
			
			<?php if(!is_null($add_sem_error_action)) echo $add_sem_error_action;?>
			
		</script>
	</body>
</html>