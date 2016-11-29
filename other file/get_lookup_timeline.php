<?php
error_reporting(0);
ini_set("memory_limit","1028M");
set_time_limit(0);

require_once('twitteroauth.php');
// require_once('C:/xampp/htdocs/localphp/connection.php');
require_once('token_twitter.php');
					   
$content = $connection->get('account/rate_limit_status');

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}

function makeSafeString($unsafe)
		{
			// Remove any detected tags
			$safe_ver1	= strip_tags($unsafe);
			// Replace any special characters in HTML friendly versions
			$safe_ver2	= htmlspecialchars($safe_ver1);
			// Escape quote signs
			$safe_ver3	= addslashes($safe_ver2);
			// Throw all away except letters, numbers, @, -, _, $, &, :, comma, space and '.'
			$safe_ver4	= preg_replace("/[^a-zA-Z0-9&$@+_:.-\s\,]/", "", $safe_ver3);
			// Return a safe String
			return $safe_ver4;
		}

function pecah_replace ($date)
{
	$exp = explode(" ",$date);
	$result= $exp[5]."-".$exp[1]."-".$exp[2]." ".$exp[3];
	$search = array ('/Jan/','/Feb/','/Mar/','/Apr/','/May/','/Jun/','/Jul/','/Aug/','/Sep/','/Oct/','/Nov/','/Dec/');
	$replace = array ('01','02','03','04','05','06','07','08','09','10','11','12');
	$mysql_date= preg_replace($search,$replace,$result);
	return $mysql_date;
}

 $conn = mysqli_connect("localhost","root","") or die("cant connect host");
 mysqli_select_db("getdatatwitter",$conn);
$var['user_awal'] = (isset($argv[1])==1)?$argv[1]:'aa';
$user_awal = $var['user_awal'];
// $var['user_akhir'] = (isset($argv[2])==1)?$argv[2]:'bb';
// $user_akhir = $var['user_akhir'];

$Nexcursor = "SELECT MAX(id) AS nilai FROM data_twitter_timelinefreeport where brand = 'Freeport'";
mysqli_query($sonn, $Nexcursor) or die(mysqli_error());
$qryTampil=mysqli_query($sonn, $Nexcursor);
while ($dataTampil=mysqli_fetch_array($qryTampil))

$x = $dataTampil['nilai'] + 0;
echo $x;

 $i=0;
 $j=1;
 #$x=100000; #42
 #$x = $dataTampil['x'] + 1;
 $z=1; #1
 
 c:

//Pengambilan data dari tabel
while($i<$j){
$ambil['a']="SELECT user_name FROM `timeline_user_freeport` where brand = 'Freeport' ORDER BY id limit $x,$z ";
#$ambil['a']="SELECT id_str FROM `lookup_simpati` WHERE mo = '$user_awal' AND followers_count >= 35 limit 10000,$z ";
echo $ambil['a'];
$hasil['b']= mysqli_query ($sonn, $ambil['a']);
	$ret = "freeport";
	while($r = mysqli_fetch_array ($hasil['b']))
	{
		$ret .= ($ret=="") ? $r['user_name']: ",".$r['user_name'];
	}
	
	 #echo $ret;
  
 #$lookup = "https://api.twitter.com/1.1/users/lookup.json?user_id=$ret";
 $lookup = "https://api.twitter.com/1.1/statuses/user_timeline.json?include_rts=false&include_entities=true&screen_name=IDFreeport&count=1&page=1";

 echo $lookup;
 #$input = object_to_array($connection->get($lookup));
 #echo $input;
 #print_r($input);
 $data = (array)$connection->get($lookup);
 print_r($data);
 
 echo "\n count: ".sizeof($input)."\n ";
 $abis = sizeof($input);
 if( $abis == 2) {
     $x=$x+$z;
	 
    goto c;
	}

  if( $abis == 1) {
    # $x=$x+$z;
	 
    break;
	} 
 echo $i;
foreach($input as $v)
{

	$var['id_str'] = $v['user']['id_str'];
	$var['id_msg'] = $v['id_str'];
	$var['created_at'] = pecah_replace($v['created_at']);
	$var['screen_name'] = $v['user']['screen_name'];
	$var['name'] = $v['user']['name'];
	$var['favorite_count'] = $v['favorite_count'];
	$var['followers_count'] = $v['user']['followers_count'];
	$var['aplication'] = makeSafeString($v['source']);
	$var['retweet_count'] = $v['retweet_count'];
	$var['text'] = $v['text'];


	$sql['q'] = "INSERT IGNORE INTO data_twitter_timelinefreeport VALUES ('IDFreeport','".$var['id_str']."','".$var['created_at']."','".mysqli_real_escape_string($var['screen_name'])."','".mysqli_real_escape_string($var['name'])."','".$var['favorite_count']."','".$var['followers_count']."','".($var['aplication'])."','".mysqli_real_escape_string($var['retweet_count'])."','".mysqli_real_escape_string($var['text'])."',NOW(),'".$var['id_msg']."',$x)" ;
	mysqli_query($sonn, $sql['q']) or die(mysqli_error());
	 // echo $sql['q']."<hr>";
	
 }
 $x=$x+$z;
 if(empty($ret)){
	$i++;}
 
} 
?>


