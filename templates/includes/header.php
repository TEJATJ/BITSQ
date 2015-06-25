<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" >
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The answer to an increasing concern- A reduced gap in student-institute interaction. A better platform to ask and just the right audience to answer!
A perfect way to a more closely knit BITSian community, Campus connect proudly presents, BITS Q- an idea implemented!">
		<link href="<?php echo BASE_URI;?>templates/css/font-awesome.min.css" rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo BASE_URI;?>logo-back.png"  style="background:#A20"/>	
		<title> BITS-Q</title>
		<link  href="<?php echo BASE_URI;?>templates/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo BASE_URI;?>templates/css/custom.css" rel="stylesheet">
			
		<!--<link rel="stylesheet" type="text/css" href="<?php //echo BASE_URI;?>templates/includes/master-editor/lib/css/prettify.css"></link>
		<link rel="stylesheet" type="text/css" href="<?php //echo BASE_URI;?>templates/includes/master-editor/src/bootstrap-wysihtml5.css"></link>-->
		
		
		
	
	</head>
	
	

	<body>
	
	<div id="loader-image" ></div>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
				
      <button type="button" style="background:#333" onclick="toggleNotifications('hide');" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
		<span id="notinumberbadge" class="badge" style="background:#A20;position:absolute;top:-10px;right:-13px"><?php $b=notify_number();if($b==0) echo '0';else echo $b;?></span>
      </button>
					<li class="dropdown visible-xs pull-right">
						<button class="btn dropdown-toggle" style="margin-top:8px;margin-right:5px;background:#333;color:white" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></button></a>
						<ul class="dropdown-menu" role="menu">
						<li><a href="#" data-toggle="modal" data-target="#editPerInfo">Personal Info</a></li>
						<li><a href="topics.php?user=<?php echo urlFormat($user_id);?>">My Topics
						<span class="badge pull-right"><?php echo getUserTopicCount($user_id,'topic');?></span></a></li>
						<li><a href="#">Answered<span class="badge pull-right"><?php echo getUserTopicCount($user_id,'replies');?></span></a></li>
						<li><a href="#" onclick='getFollowers("Following");' data-toggle="modal" data-target="#followersListModal">Following<input type="hidden" name="following_count" value="<?php echo follow_no("following",$user_id);?>"><span id="following" class="badge pull-right"><?php echo follow_no("following",$user_id);?></span></a></li>
						<li><a href="#" onclick='getFollowers("Followers");' data-toggle="modal" data-target="#followersListModal">Followers<input type="hidden" name="followers_count" value="<?php echo follow_no("followers",$user_id);?>"><span id="followers" class="badge pull-right"><?php echo follow_no("followers",$user_id);?></span></a></li>
						</ul>
						</li>
					<a class="navbar-brand" href="<?php echo BASE_URI;?>"><img src="<?php echo BASE_URI;?>background1.jpg" height="40px" width="100px" style="margin-top:-13px;"></a>
					
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form class="navbar-form navbar-left" role="search" name="searchResult" action="searchResult.php" method="POST">
								<input id="search" name="search" type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" style="width:350px;color:black;" spellcheck="false" placeholder="Search Topics By Name, User, Mail or Category">
					</form>	
					
					<ul  class="nav navbar-nav navbar-right">
					
						<li><a id="nolink" href="index.php" class="<?php if(curPage()=="index.php") echo 'active';?>"><span class="icon-bar"><i class="fa fa-home"></i></span>Home</a></li>
						<li><a id="notiLink"  onclick="toggleNotifications('show');" style="color:#888888;cursor:pointer"><i class="fa fa-bell"></i>Notifications<span id="notinumberbadge2" class="badge" style="background:#A20;"><?php $b=notify_number();if($b==0) echo '0';else echo $b;?></span></a></li>
						<li><a href="<?php if(!isLoggedIn()) echo '#';else echo 'logout.php?do_logout=yes';?>" 
						<?php if(!isLoggedIn()) echo 'data-toggle="modal" data-target="#Login"';?>><i class="fa fa-power-off" style="padding-right:5px;"></i><?php if(isLoggedIn()) echo 'Logout';else echo 'Login';?></a></li>					
						<li id="menutab" style=""><a href="#" style="cursor:pointer" data-toggle="modal" data-target="#askModal"><i class="fa fa-comment-o" style="padding-right:5px;"></i>Add Question</a></li>
						
					</ul>
					
				</div>				
				</div>
			</div>
			<div id="notification-box">
			<!---<a href="loadNotifications.php" style="margin-left:120px;">See All</a>--></div>
			<div id="body-area">
		<?php if(isLoggedIn()): ?><div id="followersListModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
	    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="ftitle"></span></h4>
      </div>
	  <div class="modal-body" id="followersListBody">
    
	
	  </div>
    </div>
  </div>  
</div>
<?php ?>
<div class="modal fade" id="askModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center;">Add a question</h4>
      </div>
      <div class="modal-body">
       <span style="width:90%"> <span id="result"></span>
	   <form role="form" method="POST" action="login.php">
								<div class="form-group ">
									<label>Question:</label>
									<input type="text" class="form-control " name="question" placeholder="Your Question" >
								</div>
								<div>
								<select class="form-control" id="defaultCat" name="category" style="float:left;width:150px !important;">
									<option value="">Select Category</option>
									<?php ?>
									<?php foreach(getCategories() as $category): ?>
									<option value="<?php echo $category->id;?>"><?php echo strtolower($category->name);?></option>
									<?php endforeach;?>
								</select>
								<input id="addCategory" type="text" name="newCat" class="form-control" style="margin-left:5px;width:280px !important;float:left">
								<button  id="addCatButton" type="button" onclick="toggleAddCategory('show');" class="upvotes answer" style="margin-left:5px;height:30px;float:left">New Category</button>
								</div><br><br>
								<div class="form-group">
									<label>Details</label>
									<textarea  class="form-control" name="body" placeholder="Enter Details. To add youtube videos, copy and paste the iframe of the video!"></textarea>
								</div>
								
							</form></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="createTopic();" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php endif;?>
	<div class="col-lg-12">
	<div class="row">
	<div class="col-md-2 hidden-xs" >
	<div class="block">
	<div class="left-panel">
	<div class="pro-pic">
	<img src="<?php echo BASE_URI;?>templates/avatars/<?php echo $avatar;?>" alt="profile pic" align="middle"/>
	<a href="#" class="name"><?php echo $username;?></a>
	</div>
	</div>
	
		<ul id="pro-info">
			<li><a href="#" data-toggle="modal" data-target="#editPerInfo">Personal Info</a></li>
			<li><a href="topics.php?user=<?php echo urlFormat($user_id);?>">My Topics</a>
			<span class="badge pull-right"><?php echo getUserTopicCount($user_id,'topic');?></span></li>
			<li>Answered<span class="badge pull-right"><?php echo getUserTopicCount($user_id,'replies');?></span></li>
			<li><a href="#" onclick='getFollowers("Following");' data-toggle="modal" data-target="#followersListModal">Following</a><input type="hidden" name="following_count" value="<?php echo follow_no("following",$user_id);?>"><span id="followingc" class="badge pull-right"><?php echo follow_no("following",$user_id);?></span></li>
			<li><a href="#" onclick='getFollowers("Followers");' data-toggle="modal" data-target="#followersListModal">Followers</a><input type="hidden" name="followers_count" value="<?php echo follow_no("followers",$user_id);?>"><span id="followers" class="badge pull-right"><?php echo follow_no("followers",$user_id);?></span></li>
		</ul>
		<hr>		
		<p style="text-align:center ;text-decoration:none;font-weight:bold">CampusConnect<br>
		Team</p>
		<p style="text-align:center ;text-decoration:none;font-weight:normal">Akhil Reddy<br>2013A7PS152P</p>		
		<p style="text-align:center ;text-decoration:none;font-weight:normal">Teja<br>2013A7PS034P</p>		
	</div>
		
	</div>
<div class="modal fade" id="editPerInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-align:center;">Edit Your Profile</h4>
      </div>
      <div class="modal-body">
	  <span id="resultPer"></span>
      <form role="form" name="editForm" method="POST" action="login.php" enctype="multipart/form-data">
								<div class="form-group ">
									<label>User Id</label>
									<input type="text" class="form-control " name="username" value="<?php echo $username;  ?>" placeholder="User Id" >
								</div>
								
								<div class="form-group">
									<label>Details</label>
									<input type="text" class="form-control " name="about" value="<?php echo $details;?>" placeholder="More Info" >
								</div>
								
									<div class="form-group "><br>
								<button type="button" id="changePass" onclick="togglePass('show');" class="upvotes answer">Change the password</button>
									</div>
								<span class="passwordchange">	<div class="form-group ">
									<label>Present Password</label>
									<input type="password" class="form-control " name="old_pass" value="" placeholder="present" >
								</div>
								<div class="form-group ">
									<label>New Password</label>
									<input type="password" class="form-control " name="newPass" value="" placeholder="new" >
								</div>
								<div class="form-group ">
									<label>Re-enter Password</label>
									<input type="password" class="form-control " name="newRePass" value="" placeholder="Re-Enter" >
								</div>
								</span>
							</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editPersonal();">Save changes</button>
      </div>
    </div>
  </div>
</div>

	<div class="col-md-7">
	
