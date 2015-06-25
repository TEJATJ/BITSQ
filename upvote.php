<?php require('core/init.php');?>
<?php 
if(isLoggedIn())
{	$action=$_POST['action'];
	$user_id=$_SESSION['user_id'];
	$t_id=$_POST['topic'];
	$r_id=$_POST['reply'];
	$db=new Database;
	if(!empty($r_id))
	{
		$db->query("SELECT user_id FROM replies WHERE id=:id");
		$db->bind("id",$r_id);
		$s=$db->single();
		
	}
	else 
	{
		$db->query("SELECT user_id FROM topics WHERE id=:id");
		$db->bind("id",$t_id);
		$s=$db->single();
		
	}
	Switch($action)
	{
		case "upvote":
		{$db->query("SELECT COUNT(*) as count FROM upvotes WHERE u_id=:u_id AND t_id=:t_id AND r_id=:r_id ");
		$db->bind("u_id",$user_id);
	$db->bind("r_id",$r_id);
	$db->bind("t_id",$t_id);$result=$db->single();
	if($result->count==0)
	$db->query("INSERT INTO upvotes VALUES ('',:t_id,:r_id,:u_id,:v_f,'1',:date)");
else $db->query("UPDATE upvotes SET vote='1',last_activity=:date WHERE u_id=:u_id AND t_id=:t_id AND r_id=:r_id AND v_for=:v_f");
$db->bind("u_id",$user_id);
	$db->bind("r_id",$r_id);
	$db->bind("t_id",$t_id);
	$db->bind("v_f",$s->user_id);
	$db->bind("date",date("Y-m-d H:i:s"));
	if($db->execute()){
		if($r_id!=0)
		add_notification($user_id,"upvoted for an answer to the question",$t_id,$r_id,followers_id($user_id));
		else if($_id==0)
			add_notification($user_id,"upvoted for a question",$t_id,$r_id,followers_id($user_id));
	}
	}
	
		
		break;case "downvote";
	{
		$db->query("UPDATE upvotes SET vote='0',last_activity=:date WHERE u_id=:u_id AND t_id=:t_id AND r_id=:r_id");
$db->bind("u_id",$user_id);
	$db->bind("r_id",$r_id);
	$db->bind("t_id",$t_id);
	$db->bind("date",date("Y-m-d H:i:s"));if($db->execute()){}
	}
	}

}else redirect("home.php");
?>