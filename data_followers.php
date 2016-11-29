<?php
$hostname   = 'localhost';
$username   = 'root';
$password   = '';
$myDatabase = 'datatwitter';

//$username1 = $_GET['screen_name'];
$username1 = "firmanmaulana3";
try {
    $conn = new PDO('mysql:host=localhost;dbname='.$myDatabase, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

    $stmt = $conn->prepare("SELECT * from get_list_followers where official = '$username1'");
    

    $stmt->execute();

    $no = 1;
	while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['official'].'</td>
			<td>'.$data['created_at'].'</td>
			<td>'.$data['id_str'].'</td>
			<td>'.$data['screen_name'].'</td>
			<td>'.$data['name'].'</td>
			<td>'.$data['followers_count'].'</td>
			<td>'.$data['friend_count'].'</td>
			<td>'.$data['status_count'].'</td>
			<td>'.$data['location'].'</td>
			<td>'.$data['description'].'</td>
			<td>'.$data['datenow'].'</td>
			<td>'.$data['cursor'].'</td>
		</tr>
		';
		$no++;
	}


} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>