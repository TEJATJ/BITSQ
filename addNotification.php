<?php 
require("core/init.php");
if(isLoggedIn())
{
		$db=new Database;
		$user1=$_SESSION['user_id'];
		$username=$_SESSION['username'];
		switch($type)
		{
			case "upvote":
			$str=" upvoted a topic "
			break;
			case "asked":
			$str=" asked ";
			break;
			case "answered":
			$str=" answered ";
		}
}
?>
