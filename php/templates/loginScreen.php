<html>
	<head>

	</head>
	<body>
		<div class="forms">
			<form id="loginForm" method="POST" action="php/scripts/login.php">
				<h3> Login </h3>
				<label>Username:<input type="text" name="uname"></label>
				<label>Password:<input type="password" name="pword"></label>
				<input type="submit" value='Login'>
			</form>
			<form id="registerForm" method='POST' action="php/scripts/register.php">
				<h3> Register </h3>
				<label>Username:<input type="text" name="uname"></label>
				<label>Password:<input type="password" name="pword"></label>
				<input type="submit" value='Register'>
			</form>
		</div>
	</body>
</html>