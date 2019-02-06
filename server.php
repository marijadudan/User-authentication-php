<?php 
	$username = "";
	$email = "";
	$errors = array();
	$password_1 = "";
	$password_2 = "";
	//database connection
	$db = mysqli_connect('localhost', 'root', '', 'registration');

	//register button
	if (isset($_POST['register'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	}

	// check if form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "Password does not match.");
	}
	// no errors, save user to database
	if (count ($errors) == 0) {
		$password = md5($password_1); // encrypt pass before storing to database
		$sql = "INSERT INTO users (username, email, password) 
				VALUES ('$username', '$email', '$password')";
		mysqli_query($db,$sql);
	}


