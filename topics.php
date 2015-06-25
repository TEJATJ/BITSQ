<?php require('core/init.php');?>

<?php

$topic=new Topic;

 $template=new Template("templates/topics.php");
 $category=isset($_GET['category']) ? $_GET['category'] : null;
 $user_id=isset($_GET['user']) ? $_GET['user'] : null;
 if(isset($_GET['category'])&&!empty($_GET['category']))
 {
 $template->topics=$topic->getTopicsByCategory($category);
 $template->title='Posts in "'.$topic->getCategoryName($category)->name.'"';
 }else if(isset($_GET['user'])&&!empty($_GET['user']))
 {$template->topics=$topic->getPostsByUserId($user_id);
 $template->title='Posts by "'.$topic->userName($user_id)->username.'"';
 }
 else 
 $template->topics=$topic->getAllTopics();
 $template->totUsers=totUsers();
 $template->totTopics=topicsCount("all");
 $template->totCategories=totCategories();
 if(isLoggedIn())
 {
 $template->user_id=$_SESSION['user_id'];
 $template->username=$_SESSION['username'];
 $template->email=$_SESSION['email'];
 $template->avatar=$_SESSION['avatar'];
 $template->last_activity=$_SESSION['last_activity'];
 }else redirect("home.php");

echo $template;
?>