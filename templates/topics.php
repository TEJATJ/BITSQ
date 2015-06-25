<?php include("includes/header.php");?>
<div id="topicscroll" style="height:600px;padding:10px;">
<?php if(isset($_GET['user'])&&!empty($_GET['user'])):?>
<?php if(!empty(getUserDetails(($_GET['user'])))): $userDetails=getUserDetails(($_GET['user']));?>
	<div class="topics-pane">
		<div class="title">
			<div class="content">
				<div style="height:150px !important">
				<img class="" id="userInfoPic" src="<?php echo avatar.$userDetails->avatar;?>">	
				<div id="detailsInfo" style="margin-left:170px;font-weight:bold;"><br>
				<?php echo $userDetails->name;?><br>
				<?php echo $userDetails->about;?><br>
				<?php echo $userDetails->email;?><br><br>
				<?php if($userDetails->id!=$_SESSION['user_id']):?><a href="#" id="follow-<?php echo $userDetails->id;?>" class="upvotes upvoteborder" onclick="follow(<?php echo $userDetails->id;?>,<?php if(following($user_id,$userDetails->id)) echo "'unfollow'";else echo "'follow'";?>);" style="padding:5px;text-decoration:none;">
				<span class="followuser-<?php echo $userDetails->id;?>"><?php if(following($user_id,$userDetails->id)) echo 'Unfollow';else echo 'Follow';?></span></a><?php endif;?>
				</div>
				</div>	
			</div>
		</div>
	</div>
<?php else: echo '<p style="text-align:center">User not Found</p>';endif;endif;?>

<?php if($topics) : ?>
<?php foreach($topics as $topic) :?>

<div class="topics-pane">
		<div class="title">
			<div class="content">
			<h2><a href="topic.php?topic=<?php echo urlFormat($topic->id);?>"><?php echo $topic->title;?></a></h2>
			<div class="info">
			<img src="<?php echo avatar.$topic->avatar;?>" />
			<a class="user" href="topics.php?user=<?php echo urlFormat($topic->user_id);?>"><?php echo $topic->username;?></a>
			 Posted on <?php echo formatDate($topic->create_date);?><br>
			<a class="upvotes"><span id="topicCount-<?php echo $topic->id;?>"><?php $d=getUpVoteCountTopic($topic->id);echo $d->countot;?></span> Upvotes</a>
			<div class="content-body">
			<?php 
			{echo substr(strip_tags($topic->body,"<br>"),0,300).' ...<a href="topic.php?topic='.urlFormat($topic->id).'">More</a>';}?>
			</div>
			<div class="content-footer">
			<?php if(!reported($topic->id)): ?>
				<span id="upvoteTopic-<?php echo $topic->id;?>">
				<input type="hidden" id="upvotesCountTopic-<?php echo $topic->id;?>" Value=<?php $d=getUpVoteCountTopic($topic->id);if($d->countot==0) echo "0";else echo $d->countot;?> />
				<span class="dTopic"><a id="linkTopic" <?php if(upvoted($user_id,$topic->id,0)) echo 'onclick="addLikesTopic(0,\'downvote\','.$topic->id.');"';
				else  echo 'onclick="addLikesTopic(0,\'upvote\','.$topic->id.');"';?>  class="upvotes upvoteborder" >
				<span class="resultTopic"><?php if(upvoted($user_id,$topic->id,0)) echo 'Upvoted';else echo 'Upvote'; ?> | <?php $d=getUpVoteCountTopic($topic->id);echo $d->countot;?></span></a></span></span>
				<?php endif;?>
				<span id="downvoteTopic-<?php echo $topic->id;?>"><a id="downvote" <?php if(!reported($topic->id)) echo  'onclick="report(\'topic\','.$topic->id.',0);"';?> class="upvotes"><?php if(reported($topic->id)) echo 'Reported';else echo 'Report'?></a></span>
				<a id="answer" href="topic.php?topic=<?php echo urlFormat($topic->id);?>" class="upvotes">Answer</a>				
				<a class="upvotes" ><?php echo replyCount($topic->id);if(replyCount($topic->id)==1) echo ' Answer';else echo ' Answers';?> </a>
				
				
			</div>
			</div>
			</div>
		</div>	
	</div>
	<?php endforeach;?>
<?php else : echo '<div class="topics-pane">
		<div class="title">
			<div class="content" style="text-align:center;">No topics</div></div></div>'; endif;?>
	</div>
<?php include("includes/footer.php");?>