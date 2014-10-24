<?php

echo 'login!';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<!--font-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
</head>
<body class="log-in">
	<h1>Log in</h1>
	<form method="post" action="">
	<fieldset>
		<label for='email'>Email</label>
		<input type="text" name="email" id="email">

		<label for='password'>Password</label>
		<input type="text" name="password" id="password">

		<button type="submit" value="Log In">Log In</button>
	</fieldset>
	</form>
</body>
</html>
