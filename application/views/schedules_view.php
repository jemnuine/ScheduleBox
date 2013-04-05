<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
			<title>ScheduleBox</title>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/metro.css">
			<meta content="width=device-width, initial-scale=1.0" name="viewport">
			<link href="<?php echo base_url();?>styles/bootstrap-responsive.css" rel="stylesheet">
		    <link href="<?php echo base_url();?>styles/docs.css" rel="stylesheet">
		    <link href="<?php echo base_url();?>styles/tribal-bootstrap.css" rel="stylesheet">
		    <link href="<?php echo base_url();?>styles/tribal-timetable.css" rel="stylesheet">

		    <script type="text/javascript" async="" src="<?php echo base_url();?>scripts/ga.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/jquery-latest.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.ba-resize.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-tooltip.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap-collapse.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/tribal.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/tribal-shared.js"></script>
		    <script type="text/javascript" src="<?php echo base_url();?>scripts/tribal-timetable.js"></script>
	</head>
	<body onload="clock();">
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
		
			<h1>Timetable Planner</h1>
			<!--<h2 id="time"></h2>-->
			
			<p>ScheduleBox provides you a simple interface for quick location of the things that you need.</p>
		</div>
		<!-- Welcome -->


		<!-- Container Fluid -->
		<div class="container">
			<div class="row-fluid">
				<div class="span9">
					<button id="addbutton" class="btn btn-success" type="button"><i class="icon-plus icon-white"></i> New</button>
					<button id="selectbutton" class="btn btn-warning" type="button"><i class="icon-filter icon-white"></i> Select Curriculum</button>
					<button class="btn btn-primary pull-right" type="button" onClick="window.print()"><i class="icon-print icon-white"></i> Print Page</button>
					<b class="pull-right">&nbsp;</b>
					
					<b class="pull-right">&nbsp;</b>
					<button class="delall btn btn-danger pull-right" type="button"><i class="icon-remove icon-white"></i> Delete All</button>
					<p>&nbsp;</p>
					<div class=" bread" align="center">All Schedules</div>
					
					<div class="timetable" data-days="6" data-hours="13">
			            <ul class="tt-events">
			                
			                <?php if(isset($records)) : foreach($records as $row) : ?>
			                	<a style="color: #fff; cursor: pointer;">
								<li class="<?php
									echo 'tt-event ';

									$rand += 1;
									if($rand == 1) echo 'btn-primary';
									if($rand == 2) echo 'btn-info';
									if($rand == 3) echo 'btn-success';
									if($rand == 4) echo 'btn-warning';
									if($rand == 5) {
										echo 'btn-danger';
											$rand = 0;
										}

								?>"


								data-id="<?php echo $row->schedule_id;?>" data-day="<?php 
										if($row->day == 'Mon') echo 1;
										if($row->day == 'Tue') echo 2;
										if($row->day == 'Wed') echo 3;
										if($row->day == 'Thu') echo 4;
										if($row->day == 'Fri') echo 5;
										if($row->day == 'Sat') echo 6;
									?>"


									data-start="<?php
									
										# strip the seconds
										$time = preg_replace('/:[0-9]{2}$/','',$row->start_time);

										# split hour and minutes
										$time_parts = explode(":",$time);

										$s = ($time_parts[0] + $time_parts[1] / 60) - 7;
										echo $s;

									?>" 

									data-duration="<?php

										$time = preg_replace('/:[0-9]{2}$/','',$row->start_time);

										$time_parts = explode(":",$time);

										$s = ($time_parts[0] + $time_parts[1] / 60) - 7;

										$time = preg_replace('/:[0-9]{2}$/','',$row->end_time);

										$time_parts = explode(":",$time);

										$e = ($time_parts[0] + $time_parts[1] / 60) - 7;
										
										echo $e - $s;
									?>" 

									rel="tooltip" unselectable="on" 

									data-original-title="



									">
			                    <?php echo $row->subject_name;?><br>
			                    Prof. <?php echo $row->instructor_name;?><br>
			                    <?php echo $row->course_code;?> <?php echo $row->year_level;?>-<?php echo $row->section_number;?><br>
			                    <?php echo $row->room_name;?> <?php echo $row->start_time;?> - <?php echo $row->end_time;?><br>
			                    </li></a>

								<?php endforeach;?>
							<?php endif; ?>


			                
			            
			            </ul>
			            <div class="tt-times">
			                <div class="tt-time" data-time="0">
			                    7:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="1">
			                    8:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="2">
			                    9:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="3">
			                    10:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="4">
			                    11:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="5">
			                    12:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    1:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    2:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    3:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    4:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    5:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    6:00<span class="hidden-phone"></span></div>
			                <div class="tt-time" data-time="6">
			                    7:00<span class="hidden-phone"></span></div>
			                
			                
			                
			            </div>
			            <div class="tt-days">
			                <div class="tt-day" data-day="0">
			                    M<span class="hidden-phone">on</span></div>
			                <div class="tt-day" data-day="1">
			                    T<span class="hidden-phone">ue</span></div>
			                <div class="tt-day" data-day="2">
			                    W<span class="hidden-phone">ed</span></div>
			                <div class="tt-day" data-day="3">
			                    T<span class="hidden-phone">hu</span></div>
			                <div class="tt-day" data-day="4">
			                    F<span class="hidden-phone">ri</span></div>
			                <div class="tt-day" data-day="4">
			                    S<span class="hidden-phone">at</span></div>
			                <div class="tt-day" data-day="4">
			                    S<span class="hidden-phone">un</span></div>
			            </div>
			        </div>

				</div>

				<div class="span3">
					<div class="sideb">
						<div class="bread">
							<i class="icon-check icon-white"></i> Manage Entries
						</div>
						<div class="well">
					        <ul class="nav nav-list">
					          <li><a href="<?php echo base_url();?>index.php/semester">Semester</a></li>
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

		<!-- Add Course Modal -->
		<div id="modalAddSchedule" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Add New Schedule </h3>
			</div>
			<!-- Modal Header -->
			<?php if(!is_null($add_schedule_error_msg)) echo $add_schedule_error_msg;?>  
			<br/>
			<form action='<?php echo base_url();?>index.php/schedules/add_schedule' method='post' name='register'>
				<!-- Modal Content -->
				<table cellpadding="0" align=center>
					<tr>
						<td>Subject: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addSubject' id='addSubject'>
								<?php if(isset($subject_record)) : foreach($subject_record as $row) : ?>
								<option value="<?php echo $row->subject_code;?>"><?php echo $row->subject_code;?></option>
								<?php endforeach;?>
								<?php endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Instructor: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addInstructor' id='addInstructor'>
								<?php if(isset($instructor_record)) : foreach($instructor_record as $row) : ?>
								<option value="<?php echo $row->instructor_name;?>"><?php echo $row->instructor_name;?></option>
								<?php endforeach;?>
								<?php endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Curriculum Year: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addYear' id='addYear'>
								<?php if(isset($curriculum_record)) : foreach($curriculum_record as $row) : ?>
								<option value="<?php echo $row->curriculum_year;?>"><?php echo $row->curriculum_year;?></option>
								<?php endforeach;?>
								<?php endif; ?>
							</select>
						</td>
						
					</tr>

					<tr>
						<td>Semester: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addSemester' id='addSemester'>
								<?php if(isset($semester_record)) : foreach($semester_record as $row) : ?>
								<option value="<?php echo $row->semester;?>"><?php echo $row->semester;?></option>
								<?php endforeach;?>
								<?php endif; ?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Course: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addCourse' id='addCourse'>
								<?php if(isset($course_record)) : foreach($course_record as $row) : ?>
								<option value="<?php echo $row->course_code;?>"><?php echo $row->course_code;?></option>
								<?php endforeach;?>
								<?php endif; ?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Year Level: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addLevel' id='addLevel' class="input-mini">
								<?php if(isset($level_record)) : foreach($level_record as $row) : ?>
								<option value="<?php echo $row->year_level;?>"><?php echo $row->year_level; ?></option>
								<?php endforeach; ?>
								<?php endif; ?>
							</select>
							&nbsp;&nbsp;&nbsp;Section:
							<select name='addSection' id='addSection'  class="input-mini">
								<?php if(isset($section_record)) : foreach($section_record as $row) : ?>
								<option value="<?php echo $row->section_number;?>"><?php echo $row->section_number; ?></option>
								<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</td>
						
					</tr>

					<tr>

						<td>Room: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addRoom' id='addRoom'  class="input-small">
								<?php if(isset($room_record)) : foreach($room_record as $row) : ?>
								<option value="<?php echo $row->room_name;?>"><?php echo $row->room_name; ?></option>
								<?php endforeach; ?>
								<?php endif; ?>
							</select>
							&nbsp;&nbsp;&nbsp;Day: 
							<select name='addDay' id='addDay' class="input-small">
								<option value="Mon">Mon</option>
								<option value="Tue">Tue</option>
								<option value="Wed">Wed</option>
								<option value="Thu">Thu</option>
								<option value="Fri">Fri</option>
								<option value="Sat">Sat</option>	
							</select>
						</td>
					</tr>

					<tr>
						<td>Class Starts: </td>
						<td>&nbsp;</td>
						<td>
							<select name='addStart' id='addStart' class="input-medium">
								<option value="7:00">7:00 am</option>
								<option value="7:30">7:30 am</option>
								<option value="8:00">8:00 am</option>
								<option value="8:30">8:30 am</option>
								<option value="9:00">9:00 am</option>
								<option value="9:30">9:30 am</option>
								<option value="10:00">10:00 am</option>
								<option value="10:30">10:30 am</option>
								<option value="11:00">11:00 am</option>
								<option value="11:30">11:30 am</option>
								<option value="12:00">12:00 pm</option>
								<option value="12:30">12:30 pm</option>
								<option value="13:00">1:00 pm</option>
								<option value="13:30">1:30 pm</option>
								<option value="14:00">2:00 pm</option>
								<option value="14:30">2:30 pm</option>
								<option value="15:00">3:00 pm</option>
								<option value="15:30">3:30 pm</option>
								<option value="16:00">4:00 pm</option>
								<option value="16:30">4:30 pm</option>
								<option value="17:00">5:00 pm</option>
								<option value="17:30">5:30 pm</option>
								<option value="18:00">6:00 pm</option>
								<option value="18:30">6:30 pm</option>
								<option value="19:00">7:00 pm</option>	
							</select>
						</td>
						
					</tr>
					<tr>
						<td>
							Ends At:
						</td>
						<td>&nbsp;</td>
						<td>

							<select name='addEnd' id='addEnd' class="input-medium">
								<option value="7:00">7:00 am</option>
								<option value="7:30">7:30 am</option>
								<option value="8:00">8:00 am</option>
								<option value="8:30">8:30 am</option>
								<option value="9:00">9:00 am</option>
								<option value="9:30">9:30 am</option>
								<option value="10:00">10:00 am</option>
								<option value="10:30">10:30 am</option>
								<option value="11:00">11:00 am</option>
								<option value="11:30">11:30 am</option>
								<option value="12:00">12:00 pm</option>
								<option value="12:30">12:30 pm</option>
								<option value="13:00">1:00 pm</option>
								<option value="13:30">1:30 pm</option>
								<option value="14:00">2:00 pm</option>
								<option value="14:30">2:30 pm</option>
								<option value="15:00">3:00 pm</option>
								<option value="15:30">3:30 pm</option>
								<option value="16:00">4:00 pm</option>
								<option value="16:30">4:30 pm</option>
								<option value="17:00">5:00 pm</option>
								<option value="17:30">5:30 pm</option>
								<option value="18:00">6:00 pm</option>
								<option value="18:30">6:30 pm</option>
								<option value="19:00">7:00 pm</option>	
							</select>
						</td>
					</tr>
					
										
					<tr>
						<td>
							<?php if(!isset($course_record)) echo '<b style="font-size:10px">* No Course Records yet! To add, <a href="' . base_url() . 'index.php/departments">Click Here</a></b>'; ?>
						</td>
						
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
		<!-- Add Course Modal -->

		<!-- Edit Course Modal -->
		<div id="modalEditSchedule" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Course </h3>
			</div>
			<!-- Modal Header -->
			<?php if(!is_null($add_schedule_error_msg)) echo $add_schedule_error_msg;?>  
			<br/>
			<form action='<?php echo base_url();?>index.php/schedules/list_edit_schedule' method='post' name='register'>
				<!-- Modal Content -->
				

				<table cellpadding="0" align=center>
					<tr>
						<td>Course Code: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='editCode' id='editCode' size='25' /></td>
					</tr>
					<tr>
						<td>Course Description: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='editDesc' id='editDesc' size='25' /></td>
					</tr>
					<tr>
						<td>Department: </td>
						<td>&nbsp;</td>
						<td>
							<select name='editDeptDesc' id='editDeptDesc'>
								<?php if(isset($record)) : foreach($record as $row) : ?>
								<option value="<?php echo $row->department_desc;?>"><?php echo $row->department_desc;?></option>
								<?php endforeach;?>
							</select>
							<?php endif;?>
						</td>
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
		<!-- Edit Course Modal -->

		<!-- Delete Course Modal -->
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
		<!-- Delete Course Modal -->

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
				  <li><i class="icon-github"></i> Github: <a href="https://github.com/jemnuine" target="_blank">Repo</a></li>
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

