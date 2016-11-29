<?php

set_time_limit(0);

// include the twitteroauth library
require_once('twitteroauth.php');
// require_once('C:/xampp/htdocs/localphp/connection.php');
require_once('token_twitter.php');
//work
try {
 $db = new PDO('mysql:host=localhost;ports=3360;dbname=datatwitter', 'root','') or die("cant connect");
 $db->exec("SET CHARACTER SET utf8"); 
    function format_date($b)
		{
			#Mon Sep 24 04:36:00 +0000 2012
			$b = explode(" ",$b);
			$m = array("Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08","Sep"=>"09","Oct"=>"10","Nov"=>"11","Dec"=>"12");
			$ret = $b[5]."-".$m[$b[1]]."-".$b[2]." ".$b[3];
			#echo $ret."\r\n";

		return $ret;
		}
 $sc= '720nov16';
$ret = '
sukatanyaj,abuayyubi1,IsMutiara,sukatanyaj,abuayyubi1
';

##

// while ($ret != ''){
	if ($ret != '')
		 $lookup =  '/users/lookup.json?screen_name='.$ret;
//		 else
  //     break;
	   
	$data = (array)$connection->get($lookup);
    

     // print_r($data);
	foreach($data as  $bebas){
	$bebas->datetime = format_date($bebas->created_at);
	// print_r($bebas->user->screen_name);
	  $sql = "INSERT IGNORE INTO  get_lookup_user VALUES
			(
			 '".$sc."'
			, '".$bebas->created_at."'
			, '".$bebas->id_str."'
			, '".$bebas->screen_name."'
			, '".$bebas->name."'
			, '".$bebas->followers_count."'
			, '".$bebas->friends_count."'
			, '".$bebas->statuses_count."'
			, '".$bebas->location."'
			, '".$bebas->description."'
			,now()
 
			)";
		
			$masuk = $db->exec($sql);
			
			print_r($sql);
		 }
	}
// }
catch(PDOException $e) {
  echo $e->getMessage();
}

?>