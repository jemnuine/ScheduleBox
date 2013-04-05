		<!-- Navigation Bar -->
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand yow" href="<?php echo base_url(); ?>" style="margin-left:15px"><img src="<?php echo base_url();?>img/logo.png" height="50px" style="margin-right:10px">ScheduleBox</a>

				<div class="pull-right"><a class="brand shoo" id="current"></a></div>
			</div>
		</div>
		<!-- Navigation Bar -->

		<!-- Welcome -->
		<div class="hero-unit">
		
			<h1>Think Less. Create Efficiently.</h1>
			<h2 id="time"></h2>
			<p>Welcome to the Online Class Schedule Creator. 
			Here you will find a listing of courses and availability for current and upcoming semesters. 
			The information is current as of the time you submit your update for course information. </p>
			<div style="text-align:center">
				<p><a class="btn btn-info btn-large" id="target2">Sign-Up Now. It's Free!</a>
				<a class="btn btn-large btn-primary" id="target">Manage Your Schedules</a></p>
			</div>
		</div>
		<!-- Welcome -->

		<div class="container">
		  <div class="marketing">
		      <h1>Built with.</h1>
		      <div class="row-fluid">
		          <div class="span4">
		            <img class="marketing-img" src="<?php echo base_url();?>img/bootstrap2.png">
		            <h2>Bootstrap.</h2>
		            <p>Sleek, intuitive, and powerful front-end framework for faster and easier web development.</p>
		          </div>
		          <div class="span4">
		            <img class="marketing-img" src="<?php echo base_url();?>img/codeigniter.png">
		            <h2>CodeIgniter.</h2>
		            <p>A Fully Baked PHP Framework CodeIgniter is a proven, agile & open PHP web application framework with a small footprint. It is powering the next generation of web apps.</p>
		          </div>
		          <div class="span4">
		            <img class="marketing-img" src="<?php echo base_url();?>img/fontawesome.png">
		            <h2>Font Awesome.</h2>
		            <p>The iconic font designed for use with Twitter Bootstrap.</p>
		          </div>
		      </div>
		      <hr class="soften">
		      <img src="<?php echo base_url();?>img/logo.png" class="icon-spin">
		      <h1>Features.</h1>
		          <p class="marketing-byline">SchedulesBox is an Online class schedule you will fall in love with.</p>
		      <div class="row-fluid"> 
		          <div class="span4">
		            <img class="marketing-img" src="<?php echo base_url();?>img/1.png">
		            <p>Create a complete class schedule.</p>
		          </div>
		          <div class="span4">
		            <img class="marketing-img" src="<?php echo base_url();?>img/2.png">
		            <p>Manage rooms efficiently.</p>
		          </div>
		          <div class="span4">
		            <img class="marketing-img" src="<?php echo base_url();?>img/3.png">
		            <p>Report generation (class schedule, faculty schedule, room schedule, etc).</p>
		          </div>
		      </div>
		      <footer>
				  <div class="container">
					<div class="row">
					  <div class="span6">
						<h2>Contact</h2>
						<ul class="icons">
						  <li><i class="icon-envelope"></i> Team Email: <a href="mailto:2010-SOEN-SR-0@groups.live.com">2010-SOFTENG-SR-0</a></li>
						  <li><i class="icon-github"></i> Github: <a href="https://github.com/jemnuine" target="_blank">Repo</a></li>
						</ul>
					  </div>
					  <div class="span6">
						<h2>ScheduleBox</h2>
						<p>
						  Copyright &copy; 2013
						</p>
					  </div>
					</div>
				  </div>
				</footer>


		  
		</div>

		<!-- Modal -->
		<div id="modalLogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Login </h3>
			</div>
			<!-- Modal Header -->
			<?php if(!is_null($error_msg)) echo $error_msg;?>  
			<br/>
			<form action='<?php echo base_url();?>index.php/verify_user' method='post' name='process'>

				<!-- Modal Content -->
				<table cellpadding="0" align=center>
					<tr>
						<td>Username: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='username' id='username' class='username' size='25'/></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td>&nbsp;</td>
						<td><input type='password' name='password' id='password' size='25' /></td>
					</tr>
				</table>

				<!-- Modal Footer -->
				<div class="modal-footer">		
					<table cellpadding="0" align=center>
						<tr>
							<td></td>
							<td width="250px"><input type="submit" value="OK" class="btn btn-success btn-large btn-block"/></td>
							<td></td>
						</tr>
					</table>
				</div>
				<!-- Modal Footer -->
			</form>
		</div>
		<!-- Modal -->

		<!-- Modal -->
		<div id="modalRegister" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
				<h3 id="myModalLabel">Register An Account </h3>
			</div>
			<!-- Modal Header -->
			<?php if(!is_null($reg_error_msg)) echo $reg_error_msg;?>  
			<br/>
			<form action='<?php echo base_url();?>index.php/register_user' method='post' name='register'>
				<!-- Modal Content -->
				<table cellpadding="0" align=center>
					<tr>
						<td>Display Name: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='regdisplayname' id='regdisplayname' size='25' /></td>
					</tr>
					<tr>
						<td>Username: </td>
						<td>&nbsp;</td>
						<td><input type='text' name='regusername' id='regusername' size='25' /></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td>&nbsp;</td>
						<td><input type='password' name='regpassword' id='regpassword' size='25' /></td>
					</tr>
					<tr>
						<td>Confirm Password: </td>
						<td>&nbsp;</td>
						<td><input type='password' name='regconfirm' id='regconfirm' size='25' /></td>
					</tr>
				</table>

				<!-- Modal Footer -->
				<div class="modal-footer">
					<table cellpadding="0" align=center>
						<tr>
							<td></td>
							<td width="300px"><input type="submit" value="Register" class="btn btn-warning btn-large btn-block"/></td>
							<td></td>
						</tr>
					</table>
				</div>
				<!-- Modal Footer -->
			</form>
		</div>
		<!-- Modal -->

