<?php 
class User
{private $user;
public function register($data)
{
$db=new Database;
$db->query("INSERT INTO users (name,email,avatar,username,password,about,last_activity) VALUES (:name,:email,:avatar,:username,:password,:about,:last)");
$db->bind(":name",$data['name']);
$db->bind(":email",$data['email']);
$db->bind(":avatar",$data['avatar']);
$db->bind(":password",$data['password']);
$db->bind(":username",$data['username']);
$db->bind(":about",$data['about']);
$db->bind(":last",$data['last_activity']);
if($db->execute())
{
return true;}
else return false;
}
public function uploadAvatar($new)
{
if(!empty($_FILES['avatar']['name'])){$allowedExts =array("gif","jpeg","jpg","png","JPEG","PNG","GIF","JPG");
$temp=explode (".",$_FILES["avatar"]["name"]);
$extension= end($temp);
if((($_FILES["avatar"]["type"]=="image/gif")
		||($_FILES["avatar"]["type"]=="image/jpeg")
		||($_FILES["avatar"]["type"]=="image/jpg")
		||($_FILES["avatar"]["type"]=="image/pjpeg")
		||($_FILES["avatar"]["type"]=="image/x-png")
		||($_FILES["avatar"]["type"]=="image/png")
		)
		&&(in_array($extension,$allowedExts))) {
		if($_FILES["avatar"]["error"]>0)
		{
			echo $_FILES['avatar']['error'];
		}
		else
		{if(file_exists("templates/avatars/".$new.'.'.$extension))
		{ echo "Couldn\'t upload profile pic.";return false;}
		else
		{if(move_uploaded_file($_FILES["avatar"]["tmp_name"],"templates/avatars/".$new.'.'.$extension))
		return true;}}
		}else 
		{
		 echo 'Invalid file type';
		 return false;}}
		
		}
public function validateUser($data)
{if($data['password']==$data['password2'])
{
if(!fieldExists("users","email",$data['email']))
{if(substr($data['email'],-25)=="@pilani.bits-pilani.ac.in"){if(!fieldExists("users","username",$data['username']))
{return true;
}else echo 'Username already taken. Please choose a different one.';
}else echo 'Use your BITS mail only';}
else echo 'Email already registered. Please choose a different one.';
}
else {echo 'Password mismatch.';}
}
public function doLogin($username,$password)
{$db=new Database;
$db->query("SELECT id,username,email,avatar,about,last_activity,status FROM users WHERE username=:username AND password=:pass");
$db->bind(":username",$username);
$db->bind(":pass",$password);
$user=$db->single();

if($db->rowCount()>0)
{if($user->status==1) 
{
$this->user=$user;
if(!($this->setUserSession()))
redirect("index.php","values not set","error");
}else 
redirect("index.php","Please confirm your mail.","warning");
return true;

}
else return false;

}
private function setUserSession()
{session_start();
$_SESSION['user_id']=$this->user->id;
 $_SESSION['username']=$this->user->username;
$_SESSION['email']=$this->user->email;
$_SESSION['avatar']=$this->user->avatar;
$_SESSION['details']=$this->user->about;
$_SESSION['last_activity']=$this->user->last_activity;
if(!empty($_SESSION['user_id'])&&!empty($_SESSION['username']))
{return true;}else return false;}

public function createTopic($data)
{$db=new Database;
$db->query('INSERT INTO topics (category_id,user_id,title,body,last_activity) VALUES (:category_id,:user_id,:title,:body,:last_activity)');
$db->bind(":category_id",$data['category_id']);
$db->bind(":user_id",$data['user_id']);
$db->bind(":title",$data['title']);
$db->bind(":body",$data['body']);
$db->bind(":last_activity",$data['last_activity']);
if($db->execute())
{return true;}
else return false;}

public function reply($data)
{$db=new Database;
$db->query("INSERT INTO replies (topic_id,user_id,body) VALUES (:topic_id,:user_id,:body)");
$db->bind(":topic_id",$data['topic_id']);
$db->bind(":user_id",$data['user_id']);
$db->bind(":body",$data['body']);
if($db->execute())
return true;
else return false;}
public function verifyToken($token,$mail)
{
$db=new Database;
$db->query("SELECT * FROM users WHERE email=:email");
$db->bind("email",$mail);
$result=$db->single();
if(md5("ournextpresAkhil@".$result->name.$result->password.$result->email."ournextpresAkhil@")==$token)
{
$db->query("UPDATE users set status='1' WHERE email=:email");
$db->bind("email",$mail);
$db->execute();
return true;}else return false;	
}

}

?>
