<?php 


$hostname   = 'localhost';
$username   = 'root';
$password   = '';
$myDatabase = 'datatwitter';

$username1 = $_GET['screen_name'];
try {
    $conn = new PDO('mysql:host=localhost;dbname='.$myDatabase, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

    $stmt = $conn->prepare("SELECT * from get_list_followers where official = $username1");
    

    $stmt->execute();

	$filelocation = 'download/';
	$filename     = 'data following-'.date('Y-m-d H.i.s').'.csv';
	$file_export  =  $filelocation . $filename;

    $data = fopen($file_export, 'w');

    $csv_fields = array();

	$csv_fields[] = 'official';
	$csv_fields[] = 'created_at';
	$csv_fields[] = 'id_str';
	$csv_fields[] = 'screen_name';
	$csv_fields[] = 'name';
	$csv_fields[] = 'followers_count';
	$csv_fields[] = 'friend_count';
	$csv_fields[] = 'status_count';
	$csv_fields[] = 'location';
	$csv_fields[] = 'description';
	$csv_fields[] = 'datenow';
	$csv_fields[] = 'cursor';
	

	fputcsv($data, $csv_fields);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($data, $row);
    }

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>