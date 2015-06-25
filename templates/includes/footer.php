</div>
	<div class="col-md-3">
	<div class="block">
	<div class="row">
			
			<div class="col-lg-12 col-md-2 col-xs-6">
					<div class="right-pane ">
					<p style="float:left;padding:10px;font-weight:bold">Users:<?php echo $totUsers;?></p>
					<p style="float:right;padding:10px;font-weight:bold">Topics:<?php echo $totTopics;?></p>
					<!---<img class="" src="<?php //echo BASE_URI.'images/'?>winner.jpg" width="10px"/>-->
					<p id="winner" style=""></p>
					</div>
			</div>
<div class="col-lg-6 col-md-2 col-xs-12 hidden-xs" style="margin-left:-5px !important">
			<div class="fb-page" data-href="https://www.facebook.com/BitsPilaniCampusConnect"  data-hide-cover="false" 
			data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore">
			<blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">BITS Q</a></blockquote></div></div>
			</div>			
			<div class="col-lg-12 col-md-2 col-xs-6">		
							<div class="block">
							<h3 style="text-align:center">Tags</h3>
							<?php if(!empty(getCategories())) :?>
							<div class="categoryScroll" style="height:200px;">
							<div class="list-group">
							
							<a class="list-group-item <?php if(!isset($_GET['category'])) echo ' '.is_active(null);?>" href="index.php">All Categories<span class="badge pull-right"><?php echo topicsCount("all");?></span></a>
							<?php foreach(getCategories() as $category):?>							
							<a class="list-group-item <?php if(isset($_GET['category']))  echo ' '.is_active($category->id);?>" href="topics.php?category=<?php echo urlFormat($category->id);?>"><?php echo strtolower($category->name);?><span class="badge pull-right"><?php echo topicsCount($category->id);?></span></a>
							<?php endforeach;?>
							</div>
							</div>
							<?php endif;?>
							</div>
			</div>			
	</div>					
	
	</div>
	</div>
	</div>
	
	</div>
	</body>
	
	<script src="<?php echo BASE_URI;?>templates/js/jquery.min.js"></script>
	<script src="<?php echo BASE_URI;?>templates/js/bootstrap.min.js"></script>
	
	<script src="<?php echo BASE_URI;?>templates/js/typeahead.min.js"></script>
	<script src="<?php echo BASE_URI;?>templates/js/upvote.js"></script>	
	<script src="<?php echo BASE_URI;?>templates/includes/ckeditor/ckeditor.js" rel="javascript"></script>
	
	<!--<script src="<?php //echo BASE_URI;?>templates/js/nicEdit.js"></script>-->
	<script src="<?php echo BASE_URI;?>templates/js/jquery.slimscroll.min.js"></script>
	<!---<script src="<?php //echo BASE_URI;?>templates/includes/master-editor/lib/js/wysihtml5-0.3.0.js"></script>-->
	<script src="<?php echo BASE_URI;?>templates/includes/master-editor/lib/js/prettify.js"></script>
	<!---<script src="<?php //echo BASE_URI;?>templates/includes/master-editor/src/bootstrap-wysihtml5.js"></script>
	<script>
	$('.textarea1').wysihtml5();
</script>-->

<script type="text/javascript" charset="utf-8">
	$(prettyPrint);
</script>
	<script>
	$('#topicscroll').slimScroll({
      railVisible: true,
      railColor: '0a86f9',
	  height: ((screen.height)),
  });    </script>
	<script>     $('.categoryScroll').slimScroll({
      railVisible: true,
      railColor: '0a86f9',
	  height: '200px;'
  });
	$('.tt-dropdown-menu').slimScroll({
      railVisible: true,
      railColor: '0a86f9',
	  height: '400px',
  });
  </script>
	 
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1613058615575370";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
    
	</html>
	