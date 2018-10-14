<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL - Create user</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
		background: #486a8d;
		}
		body{
			background: #b8b8bb;
		}
		button[name=register_btn] {
			background: #486a8d;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Telegram Admin+</h2>
	</div>
	
	<form method="post" action="create_user.php" class="content">

		<?php echo display_error(); ?>
		
		<div>
			<h2 align="center">Registration User</h2>
		</div>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> + Create user</button>
		</div>
	</form>
</body>
</html>