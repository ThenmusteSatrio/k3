<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['voter'])){
		$voter_id = $_SESSION['voter'];
		$id_position = $_SESSION['id_positions'];
		$sql = "SELECT * FROM voters WHERE id = '$voter_id'";
		$query = $conn->query($sql);
		$voter = $query->fetch_assoc();

		// Memeriksa apakah sesi voter telah berakhir
		if(!$voter){
			unset($_SESSION['voter']);
			header('location: index.php');
			exit();
		}
	}
	else{
		header('location: index.php');
		exit();
	}
?>
