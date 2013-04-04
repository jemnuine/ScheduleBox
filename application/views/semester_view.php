<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- Navigation Bar -->
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand yow" href="<?php echo base_url(); ?>" style="margin-left:15px"><img src="<?php echo base_url();?>img/logo.png" height="50px" style="margin-right:10px">ScheduleBox</a>

				<ul class="nav">
					<li><?php echo anchor('#', 'Manage Schedule');?></li>
					<li><?php echo anchor('#', 'About Us');?></li>
					<li><?php echo anchor('#', 'Help');?></li>
				</ul>

				<div class="pull-right shoo"><!-- <a class="brand shoo" id="current"></a> -->

					<div class="btn-group">
					  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="site">
					    <i class="icon-tasks icon-white"></i>
					    Logged as <?php echo $current_username; ?>
					    
					  </a>
					  <ul class="dropdown-menu">
					    <li>
					    	<?php echo anchor('#', 'Edit Account Info');?>
					    	<?php echo anchor('#', 'Change Password');?>
					    	<?php echo anchor(base_url().'index.php/logout', 'Logout');?>
					    </li>
					  </ul>
					</div>
				</div>
					
			</div>
		</div>
		<!-- Navigation Bar -->


		<!-- Welcome -->
		<div class="hero-unit">
		
			<h1>Semester Information</h1>
			
			
			<p>ScheduleBox provides you a simple interface for quick location of the things that you need.</p>
		</div>
		<!-- Welcome -->


		<!-- Container Fluid -->
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					<button class="btn btn-primary pull-right" type="button" onClick="window.print()"><i class="icon-print icon-white"></i> Print Page</button>
					<b class="pull-right">&nbsp;</b>
					<button id="addbutton" class="btn btn-success" type="button"><i class="icon-plus icon-white"></i> New</button>
					<b class="pull-right">&nbsp;</b>
					<button class="btn btn-danger pull-right delall" type="button"><i class="icon-remove icon-white"></i> Delete All</button>
					<table class="table table-striped">
						<thead>
							<td>
								Semester

							</td>
							<td>
								Curriculum Year
							</td>
							
									
						</thead>

						<?php if(isset($records)) : foreach($records as $row) : ?>
							<tr>
								<td><?php echo $row->semester;?></td>
								<td><?php echo $row->curriculum_year;?></td>
								<td class="">
									<a id="<?php echo $row->curriculum_id;?>" style="cursor:pointer;" class="deletebutton pull-right"><i class="icon-trash"></i></a>
									<a id="<?php echo $row->curriculum_id;?>" style="cursor:pointer;" class="editbutton pull-right"><i class="icon-pencil"></i></a>	
								</td>
							</tr>
							<?php endforeach;?>

						<?php endif; ?>
						
					</table>

					<?php if(!isset($records)) echo '<div class="alert alert-info" align="center">No Records Yet!</div>'?>

				</div>

				<div class="span3">
					<div class="sideb">
						<div class="bread hidePrint">
							<i class="icon-check icon-white"></i> Manage Entries
						</div>

						<div class="well">
					        <ul class="nav nav-list">
					          
					          <li class="active"><a href="<?php echo base_url();?>index.php/semester/add_semester">Semester</a></li>
					          <li><a href="<?php echo base_url();?>index.php/departments">Departments</a></li>
					          <li><a href="<?php echo base_url();?>index.php/courses">Courses</a></li>
					          <li><a href="<?php echo base_url();?>index.php/sections">Sections</a></li>
					     	  <li><a href="<?php echo base_url();?>index.php/subjects">Subjects</a></li>
					     	  <li><a href="<?php echo base_url();?>index.php/rooms">Rooms</a></li>
					     	  <li><a href="<?php echo base_url();?>index.php/instructors">Instructors</a></li>
					        </ul>
					    </div>
					</div>

					<div class="sideb">
						<div class="bread">
							<i class="icon-calendar icon-white"></i> Schedule Planner
						</div>
						<div class="well">
					        <ul class="nav nav-list">
					          <li><a class="btn btn-warning btn-block" href="<?php echo base_url();?>index.php/schedules">Manage Timetable</a></li>
					        </ul>
					    </div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container Fluid -->

		<!-- Add Semester Modal -->
		<div id="modalAddSemester" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Add New Semester </h3>
			</div>
			<!-- Modal Header -->
			<?php if(!is_null($add_sem_error_msg)) echo $add_sem_error_msg;?>  
			<br/>
			<form action='<?php echo base_url();?>index.php/semester/add_semester' method='post' name='register'>
				<!-- Modal Content -->
				<table cellpadding="0" align=center>
					<tr>
						<td>Semester: </td>
						<td>&nbsp;</td>
						<td>
							<select id="addsemester" name='addsemester'>
								<option value="First">First</option>
								<option value="Second">Second</option>
								<option value="Third">Third</option>
								<option value="Summer">Summer</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Year: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='addyear' id='addyear' size='25'/></td>
					</tr>
					
				</table>

				<!-- Modal Footer -->
				<div class="modal-footer">
					<table cellpadding="0" align=center>
						<tr>
							<td></td>
							<td width="400px" style="text-align:center">
								<input type="submit" value="Save" class="btn btn-warning btn-large"/>
								<a class="btn btn-primary btn-large" data-dismiss="modal" aria-hidden="true">Cancel</a>
							</td>
							<td></td>
						</tr>
					</table>
				</div>
				<!-- Modal Footer -->
			</form>
		</div>
		<!-- Add Semester Modal -->

		<!-- Edit Semester Modal -->
		<div id="modalEditSemester" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Edit Semester </h3>
			</div>
			<!-- Modal Header -->
			<?php if(!is_null($add_sem_error_msg)) echo $add_sem_error_msg;?>  
			<br/>
			<form action='<?php echo base_url();?>index.php/semester/list_edit_semester' method='post' name='register'>
				<!-- Modal Content -->
				<table cellpadding="0" align=center>
					<tr>
						<td>Semester: </td>
						<td>&nbsp;</td>

						<td>
							<select id="editsemester" name="editsemester">
								<option value="First">First</option>
								<option value="Second">Second</option>
								<option value="Third">Third</option>
								<option value="Summer">Summer</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td>Year: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='edityear' id='edityear' size='25'/></td>
					</tr>
					
				</table>

				<!-- Modal Footer -->
				<div class="modal-footer">
					<table cellpadding="0" align=center>
						<tr>
							<td></td>
							<td width="400px" style="text-align:center">
								<input type="submit" value="Save" class="btn btn-warning btn-large"/>
								<a class="btn btn-primary btn-large" data-dismiss="modal" aria-hidden="true">Cancel</a>
							</td>
							<td></td>
						</tr>
					</table>
				</div>
				<!-- Modal Footer -->
			</form>
		</div>
		<!-- Edit Semester Modal -->

		<!-- Delete Semester Modal -->
		<div id="modalConfirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Confirm</h3>
			</div>
			<!-- Modal Header -->
			<br/>
			<table cellpadding="0" align=center>
				<tr>
					<td>&nbsp;</td>

					<td>
						Are you sure you want to delete this data?
					</td>	
					<td>&nbsp;</td>
				</tr>
			</table>

			<br/>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<table cellpadding="0" align=center>
					<tr>
						<td></td>
						<td width="400px" style="text-align:center">
							
							<a id="triggerdelete" class="btn btn-warning btn-large" data-dismiss="modal" aria-hidden="true">Delete</a>

							<a class="btn btn-primary btn-large" data-dismiss="modal" aria-hidden="true">Cancel</a>
						</td>
						<td></td>
					</tr>
				</table>
			</div>
			<!-- Modal Footer -->	
		</div>
		<!-- Delete Semester Modal -->

		<!-- Delete All -->
		<div id="modalConfirm2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Warning!</h3>
			</div>
			<!-- Modal Header -->
			<br/>
			<table cellpadding="0" align=center>
				<tr>
					<td>&nbsp;</td>

					<td>
						You are about to delete all records. Do you want to continue this operation?
					</td>	
					<td>&nbsp;</td>
				</tr>
			</table>

			<br/>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<table cellpadding="0" align=center>
					<tr>
						<td></td>
						<td width="400px" style="text-align:center">
							
							<a id="triggerdelall" class="btn btn-warning btn-large" data-dismiss="modal" aria-hidden="true">Delete</a>

							<a class="btn btn-primary btn-large" data-dismiss="modal" aria-hidden="true">Cancel</a>
						</td>
						<td></td>
					</tr>
				</table>
			</div>
			<!-- Modal Footer -->	
		</div>
		<!-- Delete All -->
		
		<footer>
		  <div class="container">
			<div class="row">
			  <div class="span4">
				<h2>Contact</h2>
				<ul class="icons">
				  <li><i class="icon-envelope"></i> Team Email: <a href="mailto:2010-SOEN-SR-0@groups.live.com">2010-SOFTENG-SR-0</a></li>
				  <li><i class="icon-twitter"></i> Github: <a href="https://github.com/jemnuine" target="_blank">Repo</a></li>
				</ul>
			  </div>
			  <div class="span8">
				<h2>ScheduleBox</h2>
				<p>
				  Copyright &copy; 2013
				</p>
			  </div>
			</div>
		  </div>
		</footer>