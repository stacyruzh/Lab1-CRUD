<?php  
	//session_start();
	//24 min
	//initialize vars
	$name = "";
	$surname = "";
	$id = 0;
	$edit_state = false;
	$image = "";
	$msg = "";
	$user_type = "";

	//соединение к бд
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	//если нажали кнопку сохранить
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$user_type = $_POST['user_type'];
		$image = $_FILES['image']['name'];

		$target = "images/".basename($image);

		mysqli_query($db, "INSERT INTO info (name, surname, user_type, image) VALUES ('$name', '$surname', '$user_type', '$image')");

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
	  		$msg = "Image uploaded successfully";
	  	}else{
	  		$msg = "Failed to upload image";
	  	}


		$_SESSION['success'] = "Surname saved"; 
		header('location: index.php'); //перенаправлени на нач стр после вставки
	}

	//обновление
	if (isset($_POST['update'])){
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$id = $_POST['id'];
		$user_type = $_POST['user_type'];
		$image = $_FILES['image']['name'];
		
		$target = "images/".basename($image);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
	  		$msg = "Image uploaded successfully";
	  	}else{
	  		$msg = "Failed to upload image";
	  	}
		
		mysqli_query($db, "UPDATE info SET name='$name', surname='$surname', user_type = '$user_type', image = '$image' WHERE id=$id");
		
		$_SESSION['success'] = "Surname updated!"; 
		header('location: index.php');
	}

	//удаление данных

	if (isset($_GET['del'])) {
		$id = $_GET['del'];

		$res=mysqli_query($db, "SELECT * FROM info WHERE id=$id");
		$row=mysqli_fetch_array($res);
		unlink("images/$row[image]"); //удаление картинки из папки 

		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['success'] = "Surname deleted!"; 
		header('location: index.php');
		
	}

	//извлечать данные
	$results = mysqli_query($db, "SELECT * FROM info");

?>