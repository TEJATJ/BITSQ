<?php require('core/init.php');?>
<?php
if(isLoggedIn())
{	
$topic=new Topic;

$template=new Template("templates/searchResult.php");
$topic_id=isset($_POST['search']) ? $_POST['search'] :null;
//$template->topicSel=$topic->getTopicBySearch($topic_id);

redirect("topic.php?topic=".urlFormat($topic->getTopicBySearch($topic_id)->id));
}else redirect("home.php");
?>