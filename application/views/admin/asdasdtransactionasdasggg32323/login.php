 

<?php $model = new OperationModel(); ?> 



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo WEBSITE;?></title>
 
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo BASE_PATH; ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo BASE_PATH; ?>assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout" style="background-color:#f6f3f3;">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
							 <img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" alt="" style="width:100%;"> 
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
							  <form method="post" onsubmit="return checkform();">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
									    
									     <?php  get_message(); ?>
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

										
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="loginId" id="loginId" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password"  name="pass" id="pass"  class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<!--<input type="checkbox" class="ace" />-->
															<!--<span class="lbl"> Remember Me</span>-->
														</label>
	<div class="toolbar clearfix" style="    background: #f7f7f7;     border-top: 2px solid #f7f7f7;">
										 
												<a href="#" data-target="#forgot-box"  >
												 
												
														<button type="button" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button></a>
										 
											
											</div>
													</div>

													<div class="space-4"></div>
												</fieldset>
										
 

											<div class="space-6"></div>

										 
										</div><!-- /.widget-main -->

									 
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Security QNA
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your security instructions
											</p>

											 
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select  class="form-control"  id="key"  name="key" required>
															<option value="">Select question</option>
															<option value="What was your first pet’s name?">What was your first pet’s name?</option>
															<option value="What’s the name of the city where you were born?">What’s the name of the city where you were born?</option>
															<option value="What was your childhood nickname?">What was your childhood nickname?</option>
															<option value="What’s the name of the city where your parents met?">What’s the name of the city where your parents met?</option>
															<option value="What’s the first name of your oldest cousin?">What’s the first name of your oldest cousin?</option>
															<option value="What’s the name of the first school you attended?">What’s the name of the first school you attended?</option>
														    </select>
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block clearfix">
													<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Answer" required  id="answer" name ="answer" />
															<i class="ace-icon fa fa-key"></i>
														</span>	
													</label>
													<div class="clearfix">
													    <input type="hidden" name ="submitMemberLogin" value="1">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Submit !</span>
														</button>
													</div>
												</fieldset>
										 
										</div><!-- /.widget-main -->

									 
									</div><!-- /.widget-body -->
									<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												
												<i class="ace-icon fa fa-arrow-left"></i> Back to login
											</a>
										</div>
								</div><!-- /.forgot-box -->
	</form>
								 
							</div> 

						 
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>

	 
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo BASE_PATH; ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
		
		
		function checkform() { 
            
                
                
            //   alert('ddd');  
		    var loginId = document.getElementById("loginId").value;
		    var pass = document.getElementById("pass").value;
		    var key = document.getElementById("key").value;
		    var answer = document.getElementById("answer").value;
		    if(loginId != '' && pass != '' &&  key != '' && answer != ''  ){
		    return true;   
		    }
		    else
		    {
		     return false;   
		    }
		     }
		
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	</body>
</html>

