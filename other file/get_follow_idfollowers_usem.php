<?php
set_time_limit(0);

// include the twitteroauth library
require_once('twitteroauth.php');
// require_once('C:/xampp/htdocs/localphp/connection.php');
// token 
require_once('token_twitter.php');

try {
 $db = new PDO('mysql:host=localhost;ports=3360;dbname=getdatatwitter', 'root','') or die("cant connect");
 $db->exec("SET CHARACTER SET utf8"); 

$cursor = -1;
//$cursor = "1345815139387226845";

//$var['sc'] = (isset($argv[1])==1)?$argv[1]:'313354313';
//$sc = $var['sc'];
$sc = "arif13011995";

$bk=5000;
while($cursor != 0){
	if($cursor != 0)
		$loc = 'friends/ids.json?cursor='.$cursor.'&screen_name='.$sc.'&count='.$bk;
		//$loc = 'followers/ids.json?cursor='.$cursor.'&user_id='.$sc.'&count='.$bk;
	else
		break;
	// echo "\n".$loc."\n";
	$data = (array)$connection->get($loc);
	// $data = $connection->get($loc);
    // print_r($data);
	echo $sc;
	echo "\n count: ".sizeof($data['ids'])."\n ";
	//print_r($data);

	foreach($data ['ids'] as  $naruto){

	 $sql = "INSERT IGNORE INTO data_twitter_idfol_usem VALUES
			(
			 '".$sc."'
			, '".$naruto."'
			, '".$cursor."'
			)";
			$masuk = $db->exec($sql);
			print_r($sql);
			$jml+=1;
		 }
	
	echo "\r\n";
	$cursor = $data['next_cursor_str'];
	echo $cursor;
	}
}
catch(PDOException $e) {
  echo $e->getMessage();
}

// If data added ($count not false) displays the number of rows added
if($masuk != false) echo 'Number of rows added: '. $jml;
?>