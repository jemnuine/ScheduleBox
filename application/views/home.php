<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<!-- Navigation Bar -->
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand yow" href="<?php echo base_url(); ?>" style="margin-left:15px"><img  src="<?php echo base_url();?>img/logo.png" height="50px" style="margin-right:10px">ScheduleBox</a>

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

		

		

		<!-- Modal -->
		<div id="modalLogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h3 id="myModalLabel">Login</h3>
			</div>
			<!-- Modal Header -->

			<?php echo form_open('site/validate_credentials'); ?>

			<!-- Modal Content -->
			<table cellpadding="0" align=center>
				<tr>
					<td>Username: </td>
					<td>&nbsp;</td>
					<td><?php echo form_input('username'); ?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td>&nbsp;</td>
					<td><?php echo form_password('password'); ?></td>
				</tr>
			</table>

			<!-- Modal Footer -->
			<div class="modal-footer">				
				<?php
					echo anchor('reg.php', 'Sign-up for free', array('class'=>'btn btn-info'));
					echo anchor('home/do_logout', 'Logout', array('class'=>'btn btn-primary'));
				?>
			</div>
			<!-- Modal Footer -->
		</div>
		<!-- Modal -->

		<!-- Welcome -->
		<div class="hero-unit">
		
			<h1>Welcome <?php echo $current_user; ?>!</h1>
			<!--<h2 id="time"></h2>-->
			<p>ScheduleBox provides you a simple interface for quick location of the things that you need.</p>
			
		</div>
		<!-- Welcome -->
		
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					
					<p><br><br><br><br><br><h2 style="text-align:center;"><img src="<?php echo base_url();?>/img/logo.png" class="icon-spin" > The Dashboard is Coming Very Soon..</h2></p>
					
				</div>

				<div class="span3">
					<div class="sideb">
						<div class="bread">
							<i class="icon-check icon-white"></i>Manage Entries
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