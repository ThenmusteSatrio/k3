<?php
	
	include 'includes/session.php';
	include 'includes/slugify.php';

	$output = array('error'=>false,'list'=>'');

	$sql = "SELECT * FROM positions";
	$query = $conn->query($sql);

	while($row = $query->fetch_assoc()){
		$position = slugify($row['description']);
		$pos_id = $row['id'];
		if(isset($_POST[$position])){
			if($row['max_vote'] > 1){
				$selected_candidates = $_POST[$position];
				if(count($selected_candidates) > $row['max_vote']){
					$output['error'] = true;
					$output['message'][] = '<li>You can only choose '.$row['max_vote'].' candidates for '.$row['description'].'</li>';
				}
				else{
					foreach($selected_candidates as $candidate_id){
						$sql = "SELECT * FROM candidates WHERE id = '$candidate_id'";
						$cmquery = $conn->query($sql);
						$cmrow = $cmquery->fetch_assoc();
						$output['list'] .= "
							<div class='row votelist'>
		                      	<span class='col-sm-4'><span class='pull-right'><b>".$row['description']." :</b></span></span> 
		                      	<span class='col-sm-8'>".$cmrow['firstname']." ".$cmrow['lastname']."</span>
		                    </div>
						";
					}
				}
			}
			else{
				$candidate_id = $_POST[$position];
				$sql = "SELECT * FROM candidates WHERE id = '$candidate_id'";
				$csquery = $conn->query($sql);
				$csrow = $csquery->fetch_assoc();
				$output['list'] .= "
					<div class='row votelist'>
                      	<span class='col-sm-4'><span class='pull-right'><b>".$row['description']." :</b></span></span> 
                      	<span class='col-sm-8'>".$csrow['firstname']." ".$csrow['lastname']."</span>
                    </div>
				";
			}
		}
	}

	echo json_encode($output);

?>
