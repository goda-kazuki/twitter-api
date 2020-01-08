<?php
require 'TwistOAuth-master/build/TwistOAuth.phar';
require "config.php";

$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

// 自分のタイムラインを取得
$home_params = ['count' => '10'];
$tweets      = $connection->get('statuses/home_timeline', $home_params);

foreach ($tweets as $tweet)
{
	$isAlone = is_null($tweet->in_reply_to_user_id_str);

	// リプライではない かつ　リツイートでない場合
	if ($isAlone && ! isset($tweet->retweeted_status))
	{
		$params   = ["id" => $tweet->id_str];
		$favorite = $connection->post("favorites/create.json", $params);
		echo "<p style='color: red'>ひとりごと</p>";
	}
}