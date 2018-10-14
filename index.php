<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>

<?php include('server.php'); 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$edit_state = true;
		$rec = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
		$record = mysqli_fetch_array($rec);
		$name = $record['name'];
		$surname = $record['surname'];
		$image = $record['image'];
		$user_type = $record['user_type'];
		$id = $record['id'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Telegram User</h2>
	</div>
	<div class="content">
		<!-- уведомление -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- зарегистрированная информация пользователя -->
		<div class="profile_info">
			<img src="images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong>
						<?php echo $_SESSION['user']['username']; ?>
					</strong>

					<small>
						<i  style="color: #888;">
							(<?php echo
							//Возвращает строку string , в которой первый символ переведен в верхний регистр, если этот символ буквенный
							 ucfirst($_SESSION['user']['user_type']); ?>)
						</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>
				<?php endif ?>
			</div>
		</div>
	

	
	<table>
		<thead>
			<tr class="input-group">
				<th>ID</th>
				<th>Name</th>
				<th>Surname</th>
				<th>Role</th>
				<th>Avatar</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>	
		<tbody>
			<?php while ($row = mysqli_fetch_array($results)){ ?>
			<tr>
				<td><?php echo $row['id'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['surname'] ?></td>
				<td><?php echo $row['user_type'] ?></td>
				<td class=img"><?php echo "<img src='images/".$row['image']."'>" ?></td>
				<td>
					<a class="edit_btn" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
				</td>
				<td>
					<a class="del_btn" href="server.php?del=<?php echo $row['id']; ?>">Delete</a>
				</td>
				<!--<td>
					<a class="page_btn" href="server.php?page=<?php echo $row['id']; ?>">Page</a>
				</td>-->
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<form method="post" action="server.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Surname</label>
			<input type="text" name="surname" value="<?php echo $surname; ?>">
		</div>
		<div >
			<label>Role</label>
			<br>
			<select name ="user_type" value="<?php echo $user_type; ?>">
				<option>User</option>
			</select>
			<br>
			<strong >You can choose only user</strong>
			<br>
			<br>
		</div>
		<div>
			<!--<label>Download avatar</label>-->
			<input type="file" name="image" value="<?php echo $image; ?>">
		</div>
		<div class="input-group">
			<?php if ($edit_state == false): ?>
				<button class="btn" type="submit" name="save">Save</button>
			<?php else: ?>
				<button class="btn" type="submit" name="update">Update</button>
			<?php endif ?>
			
		</div>
	</form>
	</div>	
</body>
</html>