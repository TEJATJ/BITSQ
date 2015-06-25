<?php require('core/init.php');?>
<?php 
$topic=new Topic;
$user=new User;
$template=new Template("templates/topic.php");
$topic_id=isset($_GET['topic']) ? $_GET['topic'] :null;
$template->topicSel=$topic->getTopicById($topic_id);
$template->replies=$topic->getRepliesBytopic($topic_id);
$template->title=$topic->getTopicById($topic_id)->title;
$template->totUsers=totUsers();
$template->totTopics=topicsCount("all");
if(isLoggedIn())
 {
 $template->user_id=$_SESSION['user_id'];
 $template->username=$_SESSION['username'];
 $template->email=$_SESSION['email'];
 $template->last_activity=$_SESSION['last_activity'];
 $template->avatar=$_SESSION['avatar'];
 $template->details=$_SESSION['details'];
if(!empty($_POST['reply'])&&isset($_POST['reply'])&&$_POST['reply']!='<br>')
 {
 $data['topic_id']=$_GET['topic'];
 $data['user_id']=$_SESSION['user_id'];
 $data['body']=($_POST['reply']);
 $redirect="topic.php?topic=".urlFormat($_GET['topic']);
if($user->reply($data))
add_notification($_SESSION['user_id']," added an answer to a topic ",$_GET['topic'],$_POST['newAns'],followers_id($_SESSION['user_id']));
redirect($redirect); }	}else redirect("home.php");
 
echo $template;
?>