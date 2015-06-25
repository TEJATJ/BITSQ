<?php 
require("core/init.php");

if(isLoggedIn())
{
	Switch($_POST['selec']){
		case "Following":
		{
	$a=following_id($_SESSION['user_id']);
$user_id=$_SESSION['user_id'];
	foreach($a as $follower):
	if(!empty(getUserDetails($follower->f_id))): 
	$userDetails=getUserDetails(($follower->f_id));
	echo '<div style="margin-top:1px;"><img style="padding-right:5px;" src="'.BASE_URI.'templates/avatars/'.$userDetails->avatar.'" width="50px" height="50px"><a href="topics.php?user='.urlencode($follower->f_id).'">'.$userDetails->name.'<span class="hidden-xs">, '.$userDetails->about.'</span></a>
	<a href="#" id="follow-'.$userDetails->id.'" class="upvotes upvoteborder pull-right" onclick="follow('.$userDetails->id.',';if(following($user_id,$userDetails->id)) echo "'unfollow'";else echo "'follow'";echo ');" style="padding:5px;text-decoration:none;margin-top:6px;">
				<span class="followuser-'.$userDetails->id.'">';if(following($user_id,$userDetails->id)) echo 'Unfollow';else echo 'Follow';echo '</span></a>
	<div>';
	echo '<hr>';
	endif;
		endforeach;}
	break;
	case "Followers":{
	$a=followers_id($_SESSION['user_id']);
$user_id=$_SESSION['user_id'];
	foreach($a as $follower):
	if(!empty(getUserDetails($follower->u_id))): 
	$userDetails=getUserDetails(($follower->u_id));
	echo '<div style="margin-top:1px;"><img style="padding-right:5px;" src="'.BASE_URI.'templates/avatars/'.$userDetails->avatar.'" width="50px" height="50px"><a href="topics.php?user='.$userDetails->id.'">'.$userDetails->name.'<span class="hidden-xs">, '.$userDetails->about.'</a>
	<a href="#" id="follow-'.$userDetails->id.'" class="upvotes upvoteborder pull-right" onclick="follow('.$userDetails->id.',';if(following($user_id,$userDetails->id)) echo "'unfollow'";else echo "'follow'";echo ');" style="padding:5px;text-decoration:none;margin-top:6px;">
				<span class="followuser-'.$userDetails->id.'">';if(following($user_id,$userDetails->id)) echo 'Unfollow';else echo 'Follow';echo '</span></a>
	<div>';
	echo '<hr>';
	endif;
	endforeach;}
}}
else {}
?>