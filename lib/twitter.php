<?php
function get_tweets($twitterhandle, $numtweets){
	
	//check if the tweets are in the cache
	$transient_tweets = get_transient('transient_tweets');
	
	if (!$transient_tweets === false) {
		
		$return_tweets = $transient_tweets;

	} else {
	
		$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
		
		// tokens created with neworldigital‎ twitter account
		$oauth_access_token = "124872410-0EovmAQuDWxhCeWJ7SnMq0zvED8zndLNorjgFHuq";
		$oauth_access_token_secret = "VHqELVKoGWxRUwgQAG43Vy4GVXGO0MzwZar6hYhA";
		$consumer_key = "4Q6etdcA3QOydBNSuMWL4g";
		$consumer_secret = "6jEGDr0u7ydbe5Fqs08N66ieJ7F1iBtxFAQjnv9u9g";
		
		$oauth = array(
				'screen_name' => $twitterhandle,
				'count' => $numtweets,
				'oauth_consumer_key' => $consumer_key,
				'oauth_nonce' => time(),
				'oauth_signature_method' => 'HMAC-SHA1',
				'oauth_token' => $oauth_access_token,
				'oauth_timestamp' => time(),
				'oauth_version' => '1.0'
				);
		
		$base_info = buildBaseString($url, 'GET', $oauth);
		$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;
		
		// Make Requests
		$header = array(buildAuthorizationHeader($oauth), 'Expect:');
		$options = array(
					CURLOPT_HTTPHEADER => $header,
					//CURLOPT_POSTFIELDS => $postfields,
					CURLOPT_HEADER => false,
					CURLOPT_URL => $url.'?screen_name='.$twitterhandle.'&count='.$numtweets, 
					CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false
					);
		
		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$json = curl_exec($feed);
		curl_close($feed);
		
		$tweets = json_decode($json, true);
		$formatted_tweets = array();
		
		if ($tweets) {
			foreach ($tweets as $tweet) {
				if (isset($tweet['retweeted_status'])){
					$rt_handle = strstr($tweet["text"],':',true);
					$text = $rt_handle.': '.$tweet['retweeted_status']['text'];
				} else {
					$text = $tweet["text"];
				}
				
				$text = make_links($text);
				
				$formatted_tweets[] = array(
					'date'=>date('d M',strtotime($tweet["created_at"])),
					'text'=>'<a href="https://twitter.com/'.$twitterhandle.'" target="_blank">@'.$twitterhandle.'</a>: '.$text
				);
			}
		}
		
		$return_tweets = $formatted_tweets;
		
		//store tweet data in cache
		set_transient('transient_tweets', $return_tweets, 60 * 10); //expires after 10 mins
		
	}
	
	return $return_tweets;
}

function make_links($text){
	$text = preg_replace('/(\b(www\.|http\:\/\/)\S+\b)/', "<a target='_blank' href='$1'>$1</a>", $text);
	$text = preg_replace('/\#(\w+)/', "<a target='_blank' href='https://twitter.com/search?q=%23$1&src=hash'>#$1</a>", $text);
	$text = preg_replace('/\@(\w+)/', "<a target='_blank' href='https://twitter.com/$1'>@$1</a>", $text);
	return $text;
}
	
function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

?>