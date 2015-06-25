$(document).ready(function()
{
	
	
	$('body').hide();
	
	$("#notification-box").hide();
	$('#addCategory').hide();
	
	$('#loader-image').show();
	$('#loader-image').html("<img src='loading_map.gif' />");
	$( "body").fadeIn(500,function(){$('#loader-image').html("");});
	$('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 40
    });
	
	//$("#notification-box").load("loadNotifications.php #load");
	$(".passwordchange").hide();
	$('#search').keydown(function (e){
    /*if(e.keyCode == 13){
        document.forms["searchResult"].submit();
    }*/
	
});
v=1;


	
$('#topicscroll').scroll(function() {
	
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	  $('#loader-image').html("<img src='loading_map.gif' />");
       $.get(getCurentFileName()+"?page="+v,function(data){
	var posts = $(data).find('.topics-pane');	
$('#topicscroll').append(posts);});
   v++;
   $('#loader-image').html("");}
});

$("#winner").load("stats.php");
  setInterval(function (){$("#winner").load("stats.php");},2000);
});
function getCurentFileName(){
    var pagePathName= window.location.pathname;
    return pagePathName.substring(pagePathName.lastIndexOf("/") + 1);
}
function getFollowers(selected)
{//console.log(selected);
	$("#followersListBody").html("");
	$("#ftitle").html(selected);
	$.ajax({
		url:"follow_followers.php",
		data:"selec="+selected+"",
		type:"POST",
		success:function(data)
		{ 
			
				$("#followersListBody").html(data);
				
				
			
		}
		
		
		
	});
	
}
function notificationHide(id)
{
$.ajax({
	url:'loadNotifications.php',
	data:"hide=yes&id="+id,
	type:"POST",
	success:function(data)
	{
		$('#not-'+id+'').hide();
	}
	
});
}	
function notificationRead(id)
{
$.ajax({
	url:'loadNotifications.php',
	data:"seen=yes&id="+id,
	type:"POST",
	success:function(data)
	{
		$('#not-'+id+'').css('background','#F4F2F2');
		$('#notclk-'+id+'').hide();
	}
	
});
}	
function toggleNotifications(action)
{
	switch(action)
	{
		case 'show':
		
		$("#notification-box").fadeIn(500);	
		$("#notiLink").attr("onclick","toggleNotifications('hide');");
		$("#notification-box").load("loadNotifications.php #load");
		setInterval(function(){$("#notification-box").load("loadNotifications.php #load");},2000);
		$("#notiLink").attr("class","active");
		$("#nolink").attr("class","");
		$('#body-area').click(function(){toggleNotifications('hide');});
		$.ajax({
			url: 'loadNotifications.php',
			data: 'unset='+"yes",
			type:"POST"
		});
		break;
		case 'hide':
		$("#notiLink").attr("onclick","toggleNotifications('show');");
		$("#notification-box").fadeOut(500);
		$("#nolink").attr("class","active");
		$("#notiLink").attr("class","");
	}
}
  setInterval(function notification()
{
	$('#notinumberbadge').load("loadNotifications.php #number");
	$('#notinumberbadge2').load("loadNotifications.php #number");
} ,1000);
   
function follow(user,action)
{c= parseInt($("input[name='following_count']").val());

	$.ajax({
		url: 'follow.php',
		data: "fid="+user,
		type: "POST",
		beforeSend: function(){
		$('#loader-image').html("<img src='loading_map.gif' />");
	},success: function(data)
	{
		
		switch(action)
		{
			case "follow":
			{c=c+1;
				$(".followuser-"+user).html("Unfollow");
			$("#follow-"+user).attr('onclick','follow('+user+',"unfollow");');
			$("input[name='following_count']").val(c);
			$("#followingc").html(c);}
				break;
				case "unfollow":
				{c=c-1;
					$(".followuser-"+user).html("Follow");
				$("#follow-"+user).attr('onclick','follow('+user+',"follow");');
				$("input[name='following_count']").val(c);
				$("#followingc").html(c);}
				break;
		}
		$('#loader-image').html("");
	}
	});
}
function togglePass(action)
{
	switch(action){
		case "show":
			$("#changePass").attr("onclick","togglePass('hide');");
			$(".passwordchange").show();
			break;
		case "hide":
			$("#changePass").attr("onclick","togglePass('show');");
			$("input[name='old_pass']").val("");
			$("input[name='newPass']").val("");
			$("input[name='newRePass']").val("");
			$(".passwordchange").hide();
	break;}
}
function toggleAddCategory(state)
	{
		switch(state)
		{
			case "show":
			$('#addCategory').show();
			$('#defaultCat').hide();
			$("#addCatButton").attr("onclick","toggleAddCategory('hide');");
			$("#addCatButton").html('Back');
			
			break;
			case "hide":
			$('#addCategory').hide();
			$('#defaultCat').show();
			$("#addCatButton").attr("onclick","toggleAddCategory('show');");
			$("#addCatButton").html('Add Category');
		}
		
	}
function createTopic()
{	$('#result').html('');
	id=$("input[name='question']").val();
	category=$("select[name='category']").val();
	newCat=$("input[name='newCat']").val();
	body=$("textarea[name='body']").val();
	console.log('question='+id+'&category='+category+'&newCat='+newCat+'&body='+body+'&do_create="yes"');
	$.ajax({
	url: "create.php",
	data:'question='+id+'&category='+category+'&newCat='+newCat+'&body='+body+'&do_create="yes"',
	type: "POST",
	beforeSend: function(){
		$('#loader-image').html("<img src='loading_map.gif' />");
	},
	success: function(data){
		$('#result').html(data);
		
}
});
}
function reload()
{
	$( "body").fadeOut( 
           function(){
              location.reload(true);
              $(document).ready( function(){$("body").fadeIn();}); 
           });
}

function editPersonal()
{
	
	username=$("input[name='username']").val();
	about=$("input[name='about']").val();
	oldpass=$("input[name='old_pass']").val();
	newpass=$("input[name='newPass']").val();
	newrepass=$("input[name='newRePass']").val();
	avatar=$("input[name='avatar']").val();
	console.log(username+','+about+'')
	$.ajax({
		url: 'info.php',
		data: 'username='+username+'&about='+about+'&old_pass='+oldpass+'&newPass='+newpass+'&newRePass='+newrepass+'&avatar='+avatar+'',
		type: "POST",
		beforeSend:function(){
		$('#loader-image').html("<img src='loading_map.gif' />");
	},success:function(data){
		$('#resultPer').html(data);
		$('#loader-image').html("");
	}
	});
	
	
}
function addLikes(id,action,topic) {
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-'+id+' #rating').val((index+1));
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
	url: "upvote.php",
	data:'reply='+id+'&action='+action+'&topic='+topic,
	type: "POST",
	beforeSend: function(){
		$('#loader-image').html("<img src='loading_map.gif' />");
	},
	success: function(data){
	var upvote = parseInt($('#upvotesCount-'+id).val());
	switch(action) {
		case "upvote":
		upvote = upvote+1;
		$('#upvote-'+id+' .d').html('<a id="link" onclick="addLikes('+id+',\'downvote\','+topic+')" class="upvotes upvoteborder"><span class="result"></span></a>');		
		break;
		case "downvote":
		$('#upvote-'+id+' .d').html('<a id="link" onclick="addLikes('+id+',\'upvote\','+topic+')" class="upvotes upvoteborder"><span class="result"></span></a>');
		upvote = upvote-1;
		break;
	}
	$('#upvotesCount-'+id).val(upvote);
	$('#replyUpCount-'+id).html(''+upvote+'');
	if(upvote>0) {if(action=="upvote") s="Upvoted";else s="Upvote"
		$('#upvote-'+id+' #link .result').html(s+' | '+upvote);
	} else {
		$('#upvote-'+id+' .result').html('Upvote | '+upvote);
		
	} $('#loader-image').html('');
	}
	});
}
function addLikesTopic(id,action,topic) {
	
	$.ajax({
	url: "upvote.php",
	data:'reply='+id+'&action='+action+'&topic='+topic,
	type: "POST",
	beforeSend: function(){
		$('#loader-image').html("<img src='loading_map.gif' />");
	},
	success: function(data){
	var upvote = parseInt($('#upvotesCountTopic-'+topic).val());
	
	switch(action) {
		case "upvote":
		upvote = upvote+1;
		$('#upvoteTopic-'+topic+' .dTopic').html('<a id="linkTopic" onclick="addLikesTopic(0,\'downvote\','+topic+')" class="upvotes upvoteborder"><span class="resultTopic"></span></a>');		
		break;
		case "downvote":
		$('#upvoteTopic-'+topic+' .dTopic').html('<a id="linkTopic" onclick="addLikesTopic(0,\'upvote\','+topic+')" class="upvotes upvoteborder"><span class="resultTopic"></span></a>');
		upvote = upvote-1;
		break;
	}
	$('#upvotesCountTopic-'+topic).val(upvote);
	$('#topicCount-'+topic).html(''+upvote+'');
	if(upvote>0) {if(action=="upvote") s="Upvoted";else s="Upvote"
		$('#upvoteTopic-'+topic+' #linkTopic .resultTopic').html(s+' | '+upvote);
	} else {
		$('#upvoteTopic-'+topic+' .resultTopic').html('Upvote | '+upvote);
	} $('#loader-image').html('');
	}
	});
}
function report(type,topic,reply) {
	confirm('You cannot undo it!');
	$.ajax({
	url: "report.php",
	data:'reply='+reply+'&topic='+topic+'&type='+type,
	type: "POST",
	beforeSend: function(){
		$('#loader-image').html("<img src='loading_map.gif' />");
	},
	success: function(data){
		switch(type)
		{
			case "topic":			
			$('#downvoteTopic-'+topic+'').html('<a id="downvote"  class="upvotes">Reported</a>');
			$('#upvoteTopic-'+topic+' .dTopic').html('');			
		 break;
	case "reply":
			if(reply!=0)	
			{$('#downvoteReply-'+reply+'').html('<a id="downvote"  class="upvotes">Reported</a>');		
			$('#upvote-'+reply+' .d').html('');}
		}
	
	 $('#loader-image').html('');
	}
	});
}
