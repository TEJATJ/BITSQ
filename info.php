<?php
include("core/init.php"); 
?>
<?php 
if(isLoggedIn())
{
	
$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];	
$about=$_SESSION['details'];
$avatar=$_SESSION['avatar'];
$db=new Database;
	
	{if(isset($_POST['username'])&&!empty($_POST['username']))
		{$username=$_POST['username'];
			
			if(isset($_POST['about']))
				$about=$_POST['about'];
			
			if(isset($_POST['old_pass'])&&!empty($_POST['old_pass']))
			{
				if(!empty($_POST['old_pass']))
				{	
					$db->query("SELECT * FROM users WHERE id=:id AND password=:pass");
					$db->bind("id",$user_id);
					
					$db->bind("pass",md5(md5($_POST['old_pass'])));
					if($db->rowCount()==1)
					{	
						if(!empty($_POST['newPass'])&&!empty($_POST['newRePass'])&&md5($_POST['newPass'])==md5($_POST['newRePass']))
						{$user_name=$_POST['username'];
							$db->query("UPDATE users SET username=:username,about=:about,password=:pass WHERE id=:user_id");
							$db->bind("username",$username);							
							$db->bind("about",$_POST['about']);							
							$db->bind("pass",md5(md5($_POST['newPass'])));
							$db->bind("user_id",$user_id);
							if($db->execute())
							{$_SESSION['username']=mysql_real_escape_string($_POST['username']);
				$_SESSION['details']=mysql_real_escape_string($_POST['about']);$_SESSION['user_id']=$user_id;
				
				echo '<div class="al alert alert-success" style="text-align:center">Successfully Updated Info</div><script>reload();</script>';}
								
							else echo '<div class="al alert alert-danger" style="text-align:center">Choose a different Username</div>';
						}else echo '<div class="al alert alert-danger" style="text-align:center">Passwords empty/mismatch</div>';
					}else echo '<div class="al alert alert-danger" style="text-align:center">Passwords empty/mismatch</div>';
				} 
				
			}else  {
			$user_name=$_POST['username'];
			$db->query("UPDATE users SET username=:username,about=:about WHERE id=:user_id");
							$db->bind("username",$username);							
							$db->bind("about",$_POST['about']);
							$db->bind("user_id",$user_id);
					
			if($db->execute())
			{/*$_SESSION['username']=mysql_real_escape_string($_POST['username']);
				$_SESSION['details']=mysql_real_escape_string($_POST['about']);*/
				
				echo '<div class="al alert alert-success" style="text-align:center">Successfully Updated Info</div><script>reload();</script>';}
				else echo '<div class="al alert alert-danger" style="text-align:center">Choose a different Username</div>';
				
				}
				
		}
	else echo '<div class="al alert alert-warning" style="text-align:center">Enter all the required fields</div>';
	}	
	
	
	
}
else 
{
	redirect("index.php","","warning");
}

?>
