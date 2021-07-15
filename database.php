<?php 
	$ip = "localhost"; 
	$user = "root";  
	$password = "";
	$db = "etic_canykav"; 
	
	//bağlantı
	try{
		$db = new PDO("mysql:host=$ip;dbname=$db",$user,$password);
		$db->exec("SET CHARSET UTF8");
	}catch(PDOException $e){
		echo ("Veritabanı Hatası");
	}
?>