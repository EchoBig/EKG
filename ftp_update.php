<?php

include_once('connect_himpro.php'); // Connect to server Himpro

$objScan = scandir("ftp://username:password@192.168.xx.xx/ekg/*.pdf"); //Set username and paassword FTP Account

if (count($objScan) > 0) { // Check file If Empty
	foreach ($objScan as $value) {

	    $hn 	= explode('_', $value);

		$name 	= date("Ymdhi").'-'.$hn[1];

		// Insert Into Himpro 
		$data 	= [$hn[1],1,$name];
		$sql 	= "INSERT INTO pb_ekg (hn,visit,filename,create_at) VALUES(?,?,?,CURRENT_TIMESTAMP)";
		$stmt 	= $dbcon->prepare($sql);
		$result = $stmt->execute($data);
		
		if ($result) {
		    rename('ftp://username:password@192.168.xx.xx/ekg/'.$value,'ftp://username:password@192.168.xx.xx/ekg/updated/'.$name);
		}
		else{
			echo "Error!! cannot update EKG";
		}

	}
}


?>