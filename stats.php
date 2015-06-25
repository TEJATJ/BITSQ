<?php 
require("core/init.php");
if(isLoggedIn())
{
	if($result=stats()):
?>
<div class="topics-pane" style="margin-left:0px;">
<div class="title">	
<div class="content">
   <div class="info" style="@media (max-width:766px){margin-left:20px;}"><br><br>
   <img class="hidden-xs" style="float:left;margin-left:20px" src="<?php echo avatar.$result->avatar?>">
   <a style="padding-left:20px;" class="user" href="topics.php?user=<?php echo urlFormat($result->id);?>"><?php echo $result->name.'<br>' ?></a>
   <a style="padding-left:20px;" class="user" href="topics.php?user=<?php echo urlFormat($result->id);?>"><?php echo $result->result.' Upvotes' ?></a>
		
   </div>
   </div>
   </div>
   </div>
<?php	endif;
}else redirect("home.php");
?>
