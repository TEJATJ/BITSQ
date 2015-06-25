<head>
	<!-- templatemo 418 form pack -->
    <!-- 
    Form Pack
    http://www.templatemo.com/preview/templatemo_418_form_pack 
    -->
	<title>BIT~Q Login</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URI;?>templates/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo BASE_URI;?>templates/css/bootstrap.css" rel="stylesheet" type="text/css">
	
	
	<link href="<?php echo BASE_URI;?>templates/css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="" style="background:#4d1001;">
	<div class="container">
		<div class="col-md-12">
			<h1 class="margin-bottom-15"><img src="<?php echo BASE_URI;?>background1.jpg" width="50%" style="padding-right:20px"></h1>
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="login.php" method="post">	
				<div style="text-align:center !important;"><?php displayMessage();?></div>
		        <div class="form-group">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="username" class="control-label fa-label"><i class="fa fa-user fa-4x"></i></label>
		            	<input type="text" class="form-control" name="username" id="username" placeholder="Username">
		            </div>		            	            
		          </div>              
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-lock fa-2x"></i></label>
		            	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
		            </div>
		          </div>
		        </div>
		        
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		          		<input type="submit" name="do_login" value="Log in" class="btn btn-info">
		          		<a href="javascript:;" data-toggle="modal" data-target="#templatemo_modal" class="text-right pull-right">Forgot password?</a>
		          	</div>
		          </div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<div class="col-md-12">
		        		<label>Queries: </label>
		        		<div class="inline-block" style="margin-left:20px">
		        			<span ><i class="fa fa-user"></i>&nbsp; AKHIL REDDY</span>,
							<span ><i class="fa fa-email"></i>&nbsp;2013A7PS152P</span>,
		        			<span ><i class="fa fa-home"></i>&nbsp; VK 174</span>,
			        		<span ><i class="fa fa-phone"></i>&nbsp;7728835792</span>
			        		
		        		</div>		        		
		        	</div>
		        </div>
		      </form>
		      <div class="text-center">
		      	<a href="register.php" class="templatemo-create-new">Register<i class="fa fa-arrow-circle-o-right"></i></a>	
		      </div>
		</div>
	</div>
	<!--modal-->
	<div class="modal fade" id="templatemo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Forgot your password?</h4>
	      </div>
	      <form class="form-horizontal" id="do_forgot" action="home.php" method="post">
	      <div class="modal-body">
	      	
	      		<p id="f_status" style="text-align:center"></p>
	      		
	      		<div class="form-group">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="f_email" class="control-label fa-label"><i class="fa fa-user fa-4x"></i></label>
		            	<input type="text" class="form-control" name="f_email" id="f_email" placeholder="Enter your BITS-mail id">
		            </div>		            	            
		          </div>              
		        </div>
	      		
	      		
	      	
	      </div>
	      <div class="modal-footer" style="margin-top:10px;">
	      		<button  name="do_forgot" value="yes" type="submit" class="btn btn-warning">Submit</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
</body>

</html>
</script>
<script type="text/javascript" src="<?php echo BASE_URI;?>/templates/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URI;?>/templates/js/bootstrap.min.js"></script>
<script>
$("#do_forgot").on('submit',(function(e) {
e.preventDefault();
//$("#message").empty();
//$('#loading').show();
$.ajax({
url: "forgotPassword.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData($(this)[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,
beforeSend:function(){$("#f_status").html("<img src='loading_map.gif'> Sending email...Please wait.")},        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{

$("#f_status").html(data);

}
});
}));
</script>
