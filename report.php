<?php 
require("core/init.php");
if(isLoggedIn())
{$type=$_POST['type'];
$action=$_POST['action'];
$user_id=$_SESSION['user_id'];
$t_id=$_POST['topic'];
$r_id=$_POST['reply'];
$db=new Database;

	Switch($type)
{
	case "topic":
	{$db->query("SELECT COUNT(*) as count FROM reports WHERE u_id=:u_id AND t_id=:t_id AND r_id='0' ");
		$db->bind("u_id",$user_id);
	
	$db->bind("t_id",$t_id);$result=$db->single();
	if($result->count==0)
	$db->query("INSERT INTO reports VALUES ('',:t_id,0,:u_id,:date)");
	$db->bind("u_id",$user_id);
	$db->bind("t_id",$t_id);
	$db->bind("date",date("Y-m-d H:i:s"));
	if($db->execute()){}
	}
	break;
	case "reply":
	{
	$db->query("SELECT COUNT(*) as count FROM reports WHERE u_id=:u_id AND t_id=:t_id AND r_id=:r_id ");
	$db->bind("u_id",$user_id);	
	$db->bind("t_id",$t_id);
	$db->bind("r_id",$r_id);
	$result=$db->single();
	if($result->count==0)
	$db->query("INSERT INTO reports VALUES ('',:t_id,:r_id,:u_id,:date)");
	$db->bind("u_id",$user_id);
	$db->bind("r_id",$r_id);
	$db->bind("t_id",$t_id);
	$db->bind("date",date("Y-m-d H:i:s"));
	if($db->execute()){}
	}
}
}else redirect("home.php");
?>