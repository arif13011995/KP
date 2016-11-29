<?php
    $hostname   = 'localhost';
    $username   = 'root';
    $password   = '';
    $myDatabase = 'datatwitter';

    //$username1 = $_GET['screen_name'];
    $username1 = $_GET['screen_name'];

    $conn = new PDO('mysql:host=localhost;dbname='.$myDatabase, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

    $result = $conn->prepare("SELECT * from get_list_followers where official = $username1");
    

    $result->execute();

    $file = fopen("php://output","w");

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Followers -.' . date("Y.m.d") . '.csv"');
    header('Pragma: no-cache');    
    header('Expires: 0');

    

    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        fputcsv($file,$row);
    }
    fclose($file);

    
?>