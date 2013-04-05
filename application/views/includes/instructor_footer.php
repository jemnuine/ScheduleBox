		
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
				$('#modalAddInstructor').modal('show');
				
				
		
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
		        	url: "<?php echo base_url();?>index.php/instructors/list_edit_instructor",
		        	type: 'POST',
		        	data: form_data
		        });

		        request.done(function (response, textStatus, jqXHR){
			        $('#modalEditInstructor').modal('show');
					var temp = new Array();
					temp = response.split("*");
			       	$('#editInstructor').val(temp[0]);
			    });
				    	
			});

			//this is very poor and unsafe don't you worry I'll fix this later using ajax request
			var deleteid;

			$(".deletebutton").click(function() {
				$('#modalConfirm').modal('show');
				deleteid = $(this).attr('id');

			});

			$("#triggerdelete").click(function() {
		        window.location.href = "<?php echo base_url();?>index.php/instructors/delete_instructor/" + deleteid;				    	
			});

			$(".delall").click(function() {
				$('#modalConfirm2').modal('show');

			});

			$("#triggerdelall").click(function() {
		        window.location.href = "<?php echo base_url();?>index.php/instructors/delete_all_instructor";				    	
			});
			
			<?php if(!is_null($add_instructor_error_action)) echo $add_instructor_error_action;?>
			
		</script>
	</body>
</html>