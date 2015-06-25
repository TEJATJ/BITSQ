<?php 
include ("core/init.php");
if(isLoggedIn())
{
	$db=new Database;
	$action=$_POST['action'];
	$u_id=$_SESSION['user_id'];
	$f_id=$_POST['fid'];
	
			$db->query("SELECT id,val FROM followers WHERE u_id=:u_id AND f_id=:f_id ");
			$db->bind("u_id",$u_id);
			$db->bind("f_id",$f_id);
			$result=$db->single();			
			if(!empty($result))
			{
				if(($result->val)==0)
				{$db->query("UPDATE followers SET val='1' WHERE u_id=:u_id AND f_id=:f_id");
				$db->bind("u_id",$u_id);
				$db->bind("f_id",$f_id);
				$db->execute();
				/*if($u_id!=$f_id)
					add_notification($u_id,"is following".getUserDetails($f_id)->name.'',getUserDetails($f_id)->id,0,followers_id($_SESSION['user_id']));*/}else 
				{
					$db->query("UPDATE followers SET val='0' WHERE u_id=:u_id AND f_id=:f_id");
				$db->bind("u_id",$u_id);
				$db->bind("f_id",$f_id);
				$db->execute();
				
				}
			}
			else
			{
				$db->query("INSERT INTO followers VALUES ('',:u_id,:f_id,'1',:date)");
				$db->bind("u_id",$u_id);
				$db->bind("f_id",$f_id);
				$db->bind("date",date("Y-m-d H:i:s"));
				$db->execute();
				/*if($u_id!=$f_id) add_notification($u_id,"is following ".getUserDetails($f_id)->name,getUserDetails($f_id)->id,0,followers_id($_SESSION['user_id']));*/
			}
		
	
}else redirect("home.php");
?>