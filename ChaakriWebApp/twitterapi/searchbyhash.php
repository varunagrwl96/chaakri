<?php

function replace($string){
	$string = str_replace('â€¦', '', $string);
	return $string;
}


require "autoload.php";
use Abraham\TwitterOAuth\TwitterOauth;

define('CONSUMER_KEY', '1zQpvq99QnZqCsxcWn1BFG3U1');
define('CONSUMER_SECRET', 'XatslNBFMYQC2RpR8MIwt8L9mXS2gUYiyei5JhA7en3IEvQ67y');
define('ACCESS_TOKEN', '905969089-xpoyx12kekf5Nx8XULw4xBL2cB3kbBY9Ro14EDjJ');
define('ACCESS_TOKEN_SECRET', 'lfCsS81HQA9zUJwubs8JGZN3qkBAtkJ3sCzdrLNjO2dZT');
 
$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
 
$query = array(
  "q" => "#virat"
);
 
$results = $toa->get('search/tweets', $query);
 
foreach ($results->statuses as $result) {
  echo $result->user->screen_name . ": " . replace($result->text) .'<br>';
}

?>