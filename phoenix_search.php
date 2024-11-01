<?php
	if (!isset($_GET["id"])) {
		die("sb");
	}
	else {
		$id = $_GET["id"];
	}
?>
/**
 * Code from http://isouth.org.
 * But I don't konw who is the author...
 *
 * @Editor: zckevin
 * @Website: http://zckev.in
 */
function twitterCallback2(twitters) {
	var statusHTML = [];
	for (var i=0; i<twitters.statuses.length; i++){
		var username = twitters.statuses[i].user.screen_name;
		var status = twitters.statuses[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
		return '<a href="'+url+'" rel="external nofollow" style="font-weight:normal">'+url+'</a>';
		}).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
		return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'" title="'+reply.substring(1)+'" rel="external nofollow" style="font-weight:normal">'+reply.substring(1)+'</a>';
		});
		statusHTML.push('<li><span>'+status+'</span> <a style="font-size:85%" href="http://twitter.com/'+username+'/status/'+twitters.statuses[i].id_str+'" rel="external nofollow"></a><span style="font-size:85%;font-style:italic;">'+relative_time(twitters.statuses[i].created_at)+'</span></li>');
	}
	$("#<?php echo $id; ?>").append("<ul>"+statusHTML.join('')+"</ul>");
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'an hour ago';
  } else if(delta < (24*60*60)) {
    return (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}