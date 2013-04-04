		
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
				$('#modalAddRoom').modal('show');
				
				
		
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
		        	url: "<?php echo base_url();?>index.php/rooms/list_edit_room",
		        	type: 'POST',
		        	data: form_data
		        });

		        request.done(function (response, textStatus, jqXHR){
		        	alert(response);
			        $('#modalEditRoom').modal('show');
					var temp = new Array();
					temp = response.split("*");
			       	$('#editRoom').val(temp[0]);
			       	$('#editCapacity').val(temp[2]);
			       	$('#editType').val(temp[1]);
			    });
				    	
			});

			//this is very poor and unsafe don't you worry I'll fix this later using ajax request
			var deleteid;

			$(".deletebutton").click(function() {
				$('#modalConfirm').modal('show');
				deleteid = $(this).attr('id');

			});

			$("#triggerdelete").click(function() {
		        window.location.href = "<?php echo base_url();?>index.php/rooms/delete_room/" + deleteid;				    	
			});

			$(".delall").click(function() {
				$('#modalConfirm2').modal('show');

			});

			$("#triggerdelall").click(function() {
		        window.location.href = "<?php echo base_url();?>index.php/rooms/delete_all_room";				    	
			});
			
			<?php if(!is_null($add_room_error_action)) echo $add_room_error_action;?>
			
		</script>
	</body>
</html>