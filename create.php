<?php
require("core/init.php");
$topic=new Topic;
$user=new User;
if(isLoggedIn()): {
$template=new Template("templates/create.php");
if(isLoggedIn())
 {
 $template->user_id=$_SESSION['user_id'];
 $template->username=$_SESSION['username'];
 $template->email=$_SESSION['email'];
 $template->last_activity=$_SESSION['last_activity'];
 }
$template->categories=getCategories();
$template->title="Add a new question";
if(isset($_POST['do_create']))
{$data['title']=strip_tags($_POST['question'],'');
if(isset($_POST['newCat'])&&!empty($_POST['newCat']))
{$b="Added by:".$_SESSION['user_id'].",".$_SESSION['username'].",".$_SESSION['email'];
	$db=new Database;
	$db->query("INSERT INTO categories VALUES ('',:name,:description)");
	$db->bind(":name",strip_tags($_POST['newCat'],''));
	$db->bind(":description",$b);
	$db->execute();
	$db->query("SELECT id FROM categories ORDER BY id DESC LIMIT 1");
	$result=$db->single();
	$data['category_id']=($result->id);
}else 
 $data['category_id']=strip_tags($_POST['category'],'');
 $data['user_id']=$_SESSION['user_id'];
 $data['last_activity']=date("Y-m-d H:i:s");
 $data['body']=strip_tags($_POST['body'],'<iframe><br>');
 $required=array("title","category_id");
 if(requiredFields($required,$data))
 {if($user->createTopic($data))
	 {add_notification($_SESSION['user_id'],"asked a question",getlastid('topics'),0,followers_id($_SESSION['user_id']));
		 echo '<div class="al alert alert-success" style="text-align:center">Successfully posted your query</div>
	 <script>reload();</script>';}
else echo '<div class="al alert alert-danger" style="text-align:center">Couldn\'t Upload. Please try after some time </div>';
 }else echo '<div class="al alert alert-warning" style="text-align:center">Please fill all the required fields</div>';
}



echo $template;
}else : redirect("index.php");
endif;
?>