
<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=tutorialweb-export.xls");
 
// Tambahkan table

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
		
		echo $no; 
		echo $data['official'];
		echo $data['created_at'];
		echo $data['id_str'];
		echo $data['screen_name'];
		echo $data['name'];
		echo $data['followers_count'];
		echo $data['friend_count'];
		echo $data['status_count'];
		echo $data['location'];
		echo $data['description'];
		echo $data['datenow'];
		echo $data['cursor'];
		$no++;
	}


} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>
