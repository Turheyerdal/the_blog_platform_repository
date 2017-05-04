<?php

/*
CLIENT ID	2ac68f96ae5b4232bb71e029928b22b0
CLIENT SECRET	619cbce978fb4f0b9811a06582c8ef4e
WEBSITE URL	http://www.localhost
REDIRECT URI	http://www.localhost http://localhost/auth.php
SUPPORT EMAIL	webfunforte@gmail.com
*/
$pass = htmlspecialchars($_POST['password']);
$login = htmlspecialchars($_POST['login']);

$pass_md5_str = strrev(md5($pass));





$link = mysqli_connect('localhost', 'root', 'vertrigo') or die('Unable to connect our db: ' . mysqli_error());
mysqli_select_db($link,'notes') or die('Unable to use our db: ');
mysqli_query($link,"SET NAMES 'utf8'"); 
mysqli_query($link,"SET CHARACTER SET 'utf8'");
mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci'");



$query ="SELECT * FROM users WHERE login='{$login}'";
	$result = mysqli_query($link,$query) or die(mysqli_error($link)); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysqli_fetch_array($link,$result);
    if (!empty($myrow['login']))
    {
    //если пользователя с введенным логином не существует
    echo("<a href='login.html'>Данный пользователь уже существует попробуйте зарегаца еще раз</a>");
	mysqli_close($link);
    }else{
			$sql = "INSERT INTO users(id,login, password) VALUES (NULL,'". $login ."','". $pass_md5_str. "')";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	mysqli_close($link);
	header("Location:login.html");

	}




  
	

?>