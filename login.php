<?
$connect = mysql_connect("localhost", "root", "");
if (empty($connect)) echo ":(";
else echo ":)";

$name = $_POST['name'];
$password = $_POST['password'];
$button= $_POST['submit'];

$message = "Если у вас нет аккаунта зарегистрируйтесь по ссылке ниже ";
 

if ($button){ 
    $count = file_get_contents('count.txt'); 
    $count++; 
    file_put_contents('count.txt',$count);
}
else {
	$count = file_get_contents('count.txt'); 
}
echo $count;

if ($button){

	mysql_select_db("table", $connect);
	$result = mysql_query("SELECT password AS _password FROM form WHERE Name='".$name."' ") or die(mysql_error());
	$count2 = mysql_query("SELECT count(*) FROM form WHERE name='".$name."'") or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$row2 = mysql_fetch_row($count2);
	echo $row['_password'];
	
	


//$count = mysql_query("SELECT count(*) FROM form WHERE name='".$name."'") or die(mysql_error());
//$row2 = mysql_fetch_row($count);


	if ($row2[0]==1){
		if ($row['_password'] != $password) {
			$message = "Вы ввели неправильный пароль! Попробуйте еще!";
			if ($count == 3){
				$message = "Вы исчерпали все попытки!";
				file_put_contents('count.txt',0);
			}
		}
		else{
			$message = "Вы вошли в систему! ";
		}
		}
	else{
		$message = "Такого пользователя не существует!";
		file_put_contents('count.txt',0);
		}
	
}



?>
<html>
<head>
<meta charset = "UTF-8">
		<link type = "text/css" rel = "stylesheet" href = "style.css" />
		<script type="text/javascript" src="prototype.js"></script>
		
 </head>

<body>

<h1>Вход в систему</h1>
	<fieldset>
	<form method="POST" action="" >
	<h2><p><label>Имя пользователя:</label></h2>
		<input type="text" name="name" id="name" pattern="^[a-zA-Z]+$" required /></p>
	<h2><p><label>Пароль:</label></h2>
		<input type="password" name="password" id="password" pattern="^[a-zA-Z]+$" required /></p>
		
	<input type="submit"  name="submit" value="Войти" > 
	
	<h3><?php echo $message; ?></h3>
	</form>
<a href="index.php">Регистрация</a></h3>

</fieldset>



</body>
</html>