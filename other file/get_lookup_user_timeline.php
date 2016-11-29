<?php
set_time_limit(0);

// include the twitteroauth library
require_once('C:/xampp/htdocs/twitteroauth/twitteroauth.php');
// require_once('C:/xampp/htdocs/localphp/connection.php');
require_once('C:/xampp/htdocs/localphp/token2.php');

try {
 $db = new PDO('mysql:host=localhost;ports=3360;dbname=local', 'root','') or die("cant connect");
 $db->exec("SET CHARACTER SET utf8"); 
	
function str_pecah_date_publish($b)
{
		$b = explode(" ",$b);
		$m = array("Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08","Sep"=>"09","Oct"=>"10","Nov"=>"11","Dec"=>"12");
		
		$c['y'] = $b[5];
		$c['m'] = $m[$b[1]];
		$c['d'] = $b[2];
		$c['h'] = explode(':',$b[3]);
		$date = date("Y-m-d H:i:s",strtotime("".$c['m']."/".$c['d']."/".$c['y']." ".$b[3]." + 7 hour"));
		$date = explode(' ',$date);
		$return = array('d'=>$date[0],'t'=>$date[1]);
		return $return;
}
function get_content($URL){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_URL, $URL);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
}

#object to array
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

// connect
$mongo['class'] = new Mongo( "localhost", 27017);

// select a database

$mongo['db'] = $mongo['class']->usem;



echo "<pre>\n";

// $foll bidadariarrijal,ikrimah_1982,Rahman131123,Gembala_Onta,abuaqilla6,abunaufalaqil2,hasyim_06,prophetcontinu5,ahryieztyea,abu_ayyubi78,kenariroler,rijal_kasep,lujain31108571,ahmadFa02466975,AbiyyF,ansharuttawhid,JoeViliank,dakwahyuuk,AnsarIndo,UltrasMuslim1,bacan1453,abu_ayyubi1,abubay_06,____abu_khalida85b9fc3b8d148,anong_akwan,SWR33_,i_Fath02,VIaqsha,daeng_puteri_,1436_bilal,manjanik_news,antithogut_2,___bukey03,terrorist_0_,BlackAnts7,laskar00001,al_indonesi
// viliank2015,EndaSuh90683216,Ukhti_Daeng,Tauhid_1982,Maulanaa_14,Khoiru_Ummah06,fattah_fatoni4,anginm16,hijraland,15tighfar,maulanarf12,AbdillaahAbu,daulahislam11,AbiyyF,ihin_Jihad,abuaqilla6,Khoiru_Ummah05,bacan1453,BlackAnts7,dakwahyuuk,___Abu_khalid,AbuBakarBaasyir,kenariroler,lujain31108571,manjanik_news,rijal_kasep,SWR33_,Ultrasmuslim1,VIaqsha,bocahingusantea,BajuJuwal,danny_kartika

$foll = "Ultrasmuslim1,VIaqsha,bocahingusantea,BajuJuwal,danny_kartika";
$account = explode(',',$foll);

foreach($account as $sname) 
{
	#echo $sname."\r\n";
	$table = "capt_usem1427des15";
	#$table = "capt_akun";
	// select table
	$mongo['collection']= $mongo['db']->$table;

	$k=0;
	$i=1;
	$j=1;
	
	while($j<=12 )
	{
		if($k!=$j){
			$k=$j;
			$a=0;
		}
		
		$url = "statuses/user_timeline.json?include_rts=false&include_entities=true&screen_name=".$sname."&count=200&page=".$j."";
		echo "\n".$sname."\r\n";
		echo "\n page=".$j."\r\n";
		// echo "\n page=".$url."\r\n";
		$data = $connection->get($url);
		#echo "\n".$data."\r\n";
		
		if(!empty($data))
		{
			$input = object_to_array($data);
			if(isset($input['error'])==1 ){
				print_r($input);
				break;
			}
		    else if($input){
				foreach($input as $data)
				{
					$data['datetime'] = str_pecah_date_publish($data['created_at']);
					$data['text'] = mb_strtolower($data['text'],'UTF-8');
					echo $i."\t";
					// $mongo['collection']->insert(array("page"=>$j,"data"=>$data));	
					   $sql = "INSERT IGNORE INTO local.data_twitter_lookup_mention_freport  VALUES
							(
							 '".$sc."'
							, '".$data->datetime."'
							, '".$data->id_str."'
							, '".$data->user->screen_name."'
							, '".mysql_escape_string($data->user->name)."'
							, '".$data->user->followers_count."'
							, '".$data->user->friends_count."'
							, '".$data->user->statuses_count."'
							, '".mysql_escape_string($data->user->location)."'
							, '".mysql_escape_string($data->user->description)."'
							);";
							$var['id_str'] = $data[data]['user']['id_str'];
							$var['created_at'] = pecah_replace($data[data]['created_at']);
							$var['screen_name'] = $data[data]['user']['screen_name'];
							$var['name'] = $data[data]['user']['name'];
							$var['message'] = $data[data]['text'];
							$var['favorite_count'] = $data[data]['favorite_count'];
							$var['aplication'] = makeSafeString($data[data]['source']);
							$var['retweet_count'] = $data[data]['retweet_count'];
							$var['id_msg'] = $data[data]['id_str'];
							$var['followers_count'] = $data[data]['user']['followers_count'];
						
							$masuk = $db->exec($sql);
							
							print_r($sql);
					$i++;
				}
				$j++;
				$a++;
			}
			if($input==array())
				$a++;
		}
		echo " a = ".$a."\r\n";
		if($a==0)
			break;
	}	
}

}
	// }
catch(PDOException $e) {
  echo $e->getMessage();
}

?>