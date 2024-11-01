<?php
	/**
	 * Code from http://isouth.org.
	 * But I don't konw who is the author...
	 *
	 * @Editor: zckevin
	 * @Website: http://zckev.in
	 */
	
	if( !isset($_GET['screen_name'])){
		die("SB...");
	}
	if(isset($_GET['callback'])) {
		$callback = $_GET['callback'];
		unset($_GET['callback']);
	}
	
	$user_timeline = 'http://twitter.com/phoenix_search.phoenix?';
	$user_timeline .= "q=from:{$_GET['screen_name']}&format=phoenix&rpp={$_GET['count']}"; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $user_timeline);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);  
	if( 200 == curl_getinfo($ch, CURLINFO_HTTP_CODE) ){
		if(isset($callback)){
			header('content-type: application/x-javascript');
			echo $callback."(".$output.")";
		}
		else{
			echo $output;
		}
	}
	curl_close($ch);
?>