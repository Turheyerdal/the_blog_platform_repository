<?php

session_start();
if(isset ($_SESSION['login'])){

$author = $_SESSION['login'];
$status = 'ready';	
}
$timestump = time();
$content = ($_POST['content']);
$date = date('jS \of F Y');
$title = ($_POST['title']);

$link = mysqli_connect('localhost', 'root', 'vertrigo') or die('Unable to connect our db: ' . mysqli_error());
mysqli_select_db($link,'notes') or die('Unable to use our db: ');
mysqli_query($link,"SET NAMES 'utf8'"); 
mysqli_query($link,"SET CHARACTER SET 'utf8'");
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci'");

$final_title = mysqli_real_escape_string($link,$title);
$final_content = mysqli_real_escape_string($link,$content);




$sql = "INSERT INTO post_information(id,author,title,content,date,timestamp,status) VALUES (NULL,'{$author}','{$final_title}','{$final_content}','{$date}','{$timestump}','{$status}')";
	mysqli_query($link,$sql) or die(mysqli_error());
	mysqli_close($link);
header("Location:main.php")




?>