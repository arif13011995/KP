<?php
set_time_limit(0);

// include the twitteroauth library
require_once('twitteroauth.php');

require_once('token_twitter.php');
   
$ret = 'detik';
		 $lookup = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=kaskus";
    $data = (array)$connection->get($lookup);
	echo "<pre>";
     print_r($data);



// CREATE TABLE `data_twitter_timeline` (
  // `official` varchar(100) NOT NULL DEFAULT '',
  // `created_at` varchar(100) DEFAULT NULL,
  // `id_str` varchar(100) NOT NULL,
  // `screen_name` varchar(100) DEFAULT NULL,
  // `name` varchar(200) DEFAULT NULL,
  // `followers_count` int(11) DEFAULT NULL,
  // `friend_count` int(11) DEFAULT NULL,
  // `status_count` int(11) DEFAULT NULL,
  // `location` varchar(250) DEFAULT NULL,
  // `descripption` varchar(250) DEFAULT NULL,
  // PRIMARY KEY (`official`,`id_str`)
// ) ENGINE=MyISAM DEFAULT CHARSET=latin1

?>