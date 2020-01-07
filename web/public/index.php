<?php
require 'TwistOAuth-master/build/TwistOAuth.phar';
require "config.php";

$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

// 自分のタイムラインを取得
$home_params = ['count' => '10'];
$home        = $connection->get('statuses/home_timeline', $home_params);

var_dump($home);