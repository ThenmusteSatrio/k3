<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM admin WHERE username = '$username'";
		$query = $conn->query($sql);

			$row = $query->fetch_assoc();
			$password == $row['password'];
			$_SESSION['admin'] = $row['id'];
	header('location: index.php');
	}
?>