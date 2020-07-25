<?php
	//<!--/*==================>redirection<===========================*/-->
	function redirect_to($new_location){
		header("Location:". $new_location);
		exit;
	}

	function getSurvey($conn){
		$query = "SELECT * FROM `survey`";
		$stmt = $conn->query($query);
		if($stmt->rowCount() > 0){
			while ($row = $stmt->fetch()) {
				
				if($_SESSION['UserID'] != $row['takenBy'] && $row['Approved'] == 1){
					echo '
						<tr>
							<th scope="row">'.$row['ID'].'</th>
							<td>'.$row['UserID'].'</td>
							<td>'.$row['Name'].'</td>
							<td>'.$row['Created'].'</td>
							<td>'.$row['CachedTakenCount'].'</td>
							<td><a href="takeSurvey.php?SurveyID='.$row['ID'].'" class="btn btn-primary">Take Survey</a></td>
						</tr>
							
					';
				}else{
					echo '
						<tr>
							<th scope="row">'.$row['ID'].'</th>
							<td>'.$row['UserID'].'</td>
							<td>'.$row['Name'].'</td>
							<td>'.$row['Created'].'</td>
							<td>'.$row['CachedTakenCount'].'</td>
							<td><a href="takeSurvey.php?SurveyID='.$row['ID'].'" class="btn btn-danger disabled">User Survey Done</a></td>
						</tr>
							
					';
				}
			}
		}else{
			echo '
				<tr>
					<th scope="row">No Data found</th>
				</tr>
			';
		}
	}

	function getAdminSurvey($conn){
		$query = "SELECT * FROM `survey`";
		$stmt = $conn->query($query);
		if($stmt->rowCount() > 0){
			while ($row = $stmt->fetch()) {
				
				if($_SESSION['UserID'] != $row['takenBy'] && $row['Approved'] == 1){
					echo '
						<tr>
							<th scope="row">'.$row['ID'].'</th>
							<td>'.$row['UserID'].'</td>
							<td>'.$row['Name'].'</td>
							<td>'.$row['Created'].'</td>
							<td>'.$row['CachedTakenCount'].'</td>
							<td><a href="editSurvey.php?SurveyID='.$row['ID'].'" class="btn btn-warning">Edit</a></td>
							<td><a href="addOneQuestion.php?SurveyID='.$row['ID'].'" class="btn btn-success">Add Question</a></td>
							<td><a href="takeSurvey.php?SurveyID='.$row['ID'].'" class="btn btn-primary">Take Survey</a></td>
						</tr>
							
					';
				}else{
					echo '
						<tr>
							<th scope="row">'.$row['ID'].'</th>
							<td>'.$row['UserID'].'</td>
							<td>'.$row['Name'].'</td>
							<td>'.$row['Created'].'</td>
							<td>'.$row['CachedTakenCount'].'</td>
							<td><a href="editSurvey.php?SurveyID='.$row['ID'].'" class="btn btn-warning">Edit</a></td>
							<td><a href="addOneQuestion.php?SurveyID='.$row['ID'].'" class="btn btn-success">Add Question</a></td>
							<td><a href="takeSurvey.php?SurveyID='.$row['ID'].'" class="btn btn-danger disabled">User Survey Done</a></td>
						</tr>
							
					';
				}
			}
		}else{
			echo '
				<tr>
					<th scope="row">No Data found</th>
				</tr>
			';
		}
	}

	function getApprovalSurvey($conn){
		$query = "SELECT * FROM `survey` WHERE Approved = 0";
		$stmt = $conn->query($query);
		if($stmt->rowCount() > 0){
			while ($row = $stmt->fetch()) {
				
			echo '
				<tr>
					<th scope="row">'.$row['ID'].'</th>
					<td>'.$row['UserID'].'</td>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Created'].'</td>
					<td>'.$row['CachedTakenCount'].'</td>
					<td><a href="setApproved.php?SurveyID='.$row['ID'].'" class="btn btn-danger">Not Approved</a></td>
				</tr>
					
			';
	}
		}else{
			echo '
				<tr>
					<th scope="row">No Data found</th>
				</tr>
			';
		}
	}


	function getQueastion($conn,$SurveyID){

		$stmt = $conn->prepare("SELECT * FROM question WHERE SurveyID = ?");
		$stmt->execute([$SurveyID]);
		$count = 0;
		while ($row = $stmt->fetch()) {
			$count++;
		    echo '
				<div class="form-group">
					<label for="exampleInputEmail">Question '.$count.': '.$row['Question'].'</label>
					<input type="hidden" name="QuestionID[]" value="'.$row['ID'].'">
					<input type="text" class="form-control" name= "answer[]" id="exampleInputEmail" required>
				</div>
				
			';
		}
	}

	function setQuestion($conn,$SurveyID)
	{
		$stmt = $conn->prepare("SELECT * FROM question WHERE SurveyID = ?");
		$stmt->execute([$SurveyID]);
		$count = 0;
		while ($row = $stmt->fetch()) {
			$count++;
		    echo '
				<div class="form-group">
					<label for="exampleInputEmail">Question ID : '.$row['ID'].'</label>
					<input type="hidden" name="QuestionID[]" value="'.$row['ID'].'">
					<input type="text" class="form-control" name= "Question[]" value = "'.$row['Question'].'" id="exampleInputEmail" required>
				</div>
				
			';
		}
	}

?>
