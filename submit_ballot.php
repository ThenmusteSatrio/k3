<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['vote'])){
		if(count($_POST) <= 1){
			$_SESSION['error'][] = 'Pilih setidaknya satu kandidat';
		}
		else{
			$_SESSION['post'] = $_POST;
			$sql = "SELECT * FROM positions";
			$query = $conn->query($sql);
			$error = false;
			$sql_array = array();
			while($row = $query->fetch_assoc()){
				$position = slugify($row['description']);
				$pos_id = $row['id'];
				if(isset($_POST[$position])){
					if($row['max_vote'] > 1){
						$selected_candidates = $_POST[$position];
						if(count($selected_candidates) > $row['max_vote']){
							$error = true;
							$_SESSION['error'][] = 'Anda hanya dapat memilih '.$row['max_vote'].' kandidat untuk '.$row['description'];
						}
						else{
							foreach($selected_candidates as $candidate_id){
								$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('".$voter['id']."', '$candidate_id', '$pos_id')";
							}
						}
					}
					else{
						$candidate_id = $_POST[$position];
						$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('".$voter['id']."', '$candidate_id', '$pos_id')";
					}
				}
			}

			if(!$error){
				foreach($sql_array as $sql_row){
					$conn->query($sql_row);
				}

				unset($_SESSION['post']);
				$_SESSION['success'] = 'Voting Telah Berhasil Dilakukan';
			}
		}
	}
	else{
		$_SESSION['error'][] = 'Pilih terlebih dahulu kandidat untuk memilih';
	}

	header('location: home.php');
?>
