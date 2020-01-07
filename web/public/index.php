<?php
require 'TwistOAuth-master/build/TwistOAuth.phar';
require "config.php";

$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

// 自分のタイムラインを取得
$home_params = ['count' => '10'];
$tweets      = $connection->get('statuses/home_timeline', $home_params);

foreach ($tweets as $tweet)
{
	$image = $tweet->user->profile_image_url;
	echo "<img src={$image}>";

	$text = $tweet->text;
	echo "<div>{$text}</div>";

	$isAlone = ($tweet->in_reply_to_user_id_str === NULL) ? TRUE : FALSE;

	$tweet_id = $tweet->id_str;

	// メンションが無い場合のみファボする。
	if ($isAlone)
	{
		$params = ["id" => $tweet_id];
		// $favorite = $connection->post("favorites/create.json", $params);
		echo "<p>ひとりごと</p>";
	}
}