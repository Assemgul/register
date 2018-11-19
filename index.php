<?
$connect = mysql_connect("localhost", "root", "");
if (empty($connect)) echo ":(";
else echo ":)";

$name = $_POST['name'];
$password = $_POST['password'];
$button= $_POST['submit'];

$message = "Если у вас уже есть аккаунт пройдите по ссылке ниже ";

mysql_select_db("table", $connect);
$count = mysql_query("SELECT count(*) FROM form WHERE name='".$name."'") or die(mysql_error());
$row = mysql_fetch_row($count);
 
if ($button){
	if ($row[0]==0){
	mysql_select_db("table", $connect);
	$result = mysql_query("INSERT INTO form (name, password) VALUES ('".$name."', '".$password."');") or die(mysql_error());
	$message = "Аккаунт успешно создан! Вы можете войти воспользовавшись формой входа нажав на ссылку ниже ";
	}
	else{
		$message = "Аккаунт с таким именем уже существует!";
	}
}



?>
<html>
<head>
<meta charset = "UTF-8">
		<link type = "text/css" rel = "stylesheet" href = "style.css" />
 </head>

<body>
<h1>Регистрация</h1>
	<fieldset>
	<form method="POST" action="" >
	<h2><p><label>Имя пользователя:</label></h2>
		<input type="text" name="name" id="name" pattern="^[a-zA-Z]+$" required /></p>
	<h2><p><label>Пароль:</label></h2>
		<input type="password" name="password" id="password" pattern="[a-zA-Z]+$}" required /></p>
		
	<input type="submit"  name="submit" value="Зарегистрироваться" > 
	
	<h3><?php echo $message; ?></h3>
	</form>
<a href="login.php"> Войти в систему</a></h3></fieldset>
</body>
</html>