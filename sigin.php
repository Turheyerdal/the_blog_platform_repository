<?php


$pass = htmlspecialchars($_POST['log_pass']);
$login = htmlspecialchars($_POST['log_login']);
$pass_md5_str = strrev(md5($pass));

$link = mysql_connect('localhost', 'root', 'vertrigo') or die('Unable to connect our db: ' . mysql_error());
mysql_select_db('notes') or die('Unable to use our db: ');
mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");

	$query ="SELECT * FROM users WHERE login='{$login}'";
	$result = mysql_query($query) or die(mysql_error()); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['login']))
    {
    //если пользователя с введенным логином не существует
    echo("<a href='login.html'>Неверно введены логин или пароль</a>");
	mysql_close();
    }
    else {
    //если существует, то сверяем пароли
    if ($myrow['password']==$pass_md5_str){
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    session_start();
	//echo ($myrow['login']); 
	//exit();
	$login_name = $myrow['login'];
	$_SESSION['login'] = $login_name; 
    #header("Location:main.php");
    header("location: main.php" . "?login=" . $login_name);
	mysql_close();
    }else{
		echo("<a href='login.html'>Неверно введены логин или пароль</a>");
	}
	}
	

?>