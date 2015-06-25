<?php require("core/init.php");
if(isset($_GET['do_logout'])&&$_GET['do_logout']=='yes')
{session_start();$u_id=$_SESSION['user_id'];
if(session_destroy())
{session_start();
$db=new Database;
/*$db->query("UPDATE notifications SET seen='1' WHERE u_id=:u_id ");
			$db->bind("u_id",$u_id);
			$db->execute();*/
redirect("home.php","Successfully Loggedout.","success");}
}//else redirect("index.php");
?>