
<!DOCTYPE html>
<head>
	<!-- templatemo 418 form pack -->
    <!-- 
    Form Pack
    http://www.templatemo.com/preview/templatemo_418_form_pack 
    -->
	<title>Create Account</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URI;?>templates/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URI;?>templates/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URI;?>templates/css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="" style="background-color:#4d1001">
	<h1 class="margin-bottom-15"><img src="<?php echo BASE_URI;?>background1.jpg" style="width:300px"></h1>
	<p style="text-align:center;color:white;" id="message"><?php if(!empty($error)) echo $error;else echo '<br>';?></p>
	<div class="container" style="">
		<div class="col-md-12">			
			<form class="form-horizontal templatemo-create-account templatemo-container" role="form" id="do_register" enctype="multipart/form-data" action="register.php" method="post">
				<div class="form-inner">
					<div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">First Name</label>
			            <input type="text" class="form-control" name="name" id="first_name" placeholder="" required>		            		            		            
			          </div>  
			          <div class="col-md-6">		          	
			            <label for="last_name" class="control-label">About you</label>
			            <input type="text" class="form-control" name="about" id="last_name" placeholder="" required>		            		            		            
			          </div>             
			        </div>
			        <div class="form-group">
			          <div class="col-md-12">		          	
			            <label for="username" class="control-label">BITS Mail ID</label>
			            <input type="email" class="form-control" id="email" name="email" value=""  placeholder="" required>		            		            		            
			          </div>              
			        </div>			
			        <div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="username" class="control-label">Username</label>
			            <input type="text" class="form-control" id="username" name="username"  placeholder="" required>		            		            		            
			          </div>
			          <div class="col-md-6 templatemo-radio-group">
			          	<label class="radio-inline">
		          			 Profile Pic <input type="file" name="avatar" style="padding-left:100px;margin-top:-20px;">
		          		</label>
						
			          </div>             
			        </div>
			        <div class="form-group">
			          <div class="col-md-6">
			            <label for="password" class="control-label">Password</label>
			            <input type="password" class="form-control" name="password" id="password" placeholder="" required>
			          </div>
			          <div class="col-md-6">
			            <label for="password" class="control-label">Confirm Password</label>
			            <input type="password" class="form-control" name="re_password" id="password_confirm" placeholder="" required>
			          </div>
			        </div>
			        <div class="form-group">
			          <div class="col-md-12">
			            <label><input type="checkbox" required>I agree to the <a href="javascript:;" data-toggle="modal" data-target="#templatemo_modal_terms">Terms of Service</a> and <a href="javascript:;" data-toggle="modal" data-target="#templatemo_modal">Privacy Policy.</a></label>
			          </div>
			        </div>
			        <div class="form-group">
			          <div class="col-md-12">
					<input name="do_register" value="yes" type="hidden">
			            <Button  type="submit" name="do_register"   class="btn btn-info">Create account</button>
			            <a href="home.php" class="pull-right">Login</a>
			          </div>
			        </div>	
				</div>				    	
		      </form>		      
		</div>
	</div>
	<div class="modal fade" id="templatemo_modal_terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Terms of Service</h4>
	      </div>
	      <div class="modal-body" style="text-align:justify;">
	

By registering on this site, you agree:<br>

1. That you take complete responsibility of data you are sharing.<br> 
2. That under any conditions,you will not blame the administrator for any harm or loss to your system or any personal data involving you. You may complain to the adminstrator if you think above
conditions meet and if found guilty, that user will be restricted from the further usage of this service;<br>
3. That the administrator reserves every right of restricting the user for violation of rules; <br> 
4. That terms and conditions and rules can be amended at any time.
</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="templatemo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Privacy Statement</h4>
	      </div>
	      <div class="modal-body">
	      	<p> This site collects many kinds of information in order to operate effectively and provide you the best products, services and experiences we can.

We collect information when you register, sign in and use our sites and services. We also may get information from other sources.

We collect this information in a variety of ways, including from web forms, technologies like cookies, web logging and software on your computer or other device. </p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="<?php echo BASE_URI;?>/templates/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URI;?>/templates/js/bootstrap.min.js"></script>
	<script>
	
$("#do_register").on('submit',(function(e) {
e.preventDefault();
//$("#message").empty();
//$('#loading').show();
$.ajax({
url: "validateNewUser.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData($(this)[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,
beforeSend:function(){$("#message").html("<img src='loading_map.gif'> Sending email...Please donot refresh the page.")},        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{

$("#message").html(data);

}
});
}));

		</script>
</body>
</html>
