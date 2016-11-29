<?php
/**
* connet twiiter
*/
session_start();
if(!isset($_SESSION['api'])){
    header('Location:login.php');
  
}
class mediawave_connect_twitter{
	
	/**
	* connet twitter
	*/
	public function get_token($id){
		$api1 = $_SESSION['api'];
		$api_secret1 = $_SESSION['api_secret'];
		$token1 = $_SESSION['token'];
		$token_secret1 = $_SESSION['token_secret'];
		$data = array(
		//1=>array('".$api1."','".$api_secret1."','".$token1."','".$token_secret1."')
		1=>array('A6VhPPMebEmFHfGzqvaHgFtIc', 'Vcm6rpidTdIuOXmb34YvpP7s2hcgIXp6AJ4LfIYpjcfUq0Ug0N', '763036670367141888-zjo07jidD9gWIsaawT9dycuvrRigBfL', 'WAtDvcjNQN3k9YPQx622UgY4yO22qsDfGrEv09iAwKP8D'),
		);
		return $data[$id];
	}
	
	/**
	* object to array
	*/
	public function object_to_array($data){
			if (is_array($data) || is_object($data)){
				$result = array();
				foreach ($data as $key => $value)
				{
					$result[$key] = $this->object_to_array($value);
				}
				return $result;
			}
			return $data;
	}


	/**
	* connet twiiter
	*/
	public function get_connection(){
		
		#random token
		$id = rand (1,1);
		$data = $this->get_token($id);
		
		$loc = 'application/rate_limit_status.json?resources=help,users,search,statuses';
		//echo $id." ".$loc."\r\n";
		
		#token1
		$CONSUMER_KEY 		    = $data[0];
		$CONSUMER_SECRET 		= $data[1];
		$access_token        	= $data[2];
		$access_token_secret 	= $data[3];

		$ret['connection'] = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token,$access_token_secret);
		$limit = $this->object_to_array($ret['connection']->get($loc));
		$ret['remaining'] = (isset($limit['resources']['search']['/search/tweets']['remaining']) == 1) ? $limit['resources']['search']['/search/tweets']['remaining'] : 0;
		echo "Sisa Token: ".$ret['remaining']."\r\n";

		return $ret;
	}	
}
$class_token = new mediawave_connect_twitter();
$ret = $class_token->get_connection();
$connection = $ret['connection'];
$remaining = $ret['remaining'];

?>