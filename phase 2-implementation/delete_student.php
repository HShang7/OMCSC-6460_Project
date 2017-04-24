<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
  $student = find_student_by_id($_GET["id"]);
  
  
  if (!$student) {
    // student was missing or invalid or 
    // couldn't be found in database
    redirect_to("manage_student.php");
	
  }
    $studentID = $student["stuID"];

    //$query = 'DELETE FROM `student` WHERE stuID = \'$studentID\' LIMIT 1';
	$query = "DELETE FROM student WHERE stuID = {$studentID} LIMIT 1";
    $result = mysqli_query($db, $query);
   
	if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "Student deleted.";
      redirect_to("manage_student.php");
    } else {
      // Failure
      $_SESSION["message"] = "Student deletion failed.";
	  redirect_to("manage_student.php");
    }
		

  /*if (empty($student)) {
	array_push($error_msg,  "No student selected");
	header('Location: login.php');
	exit();
  }
	// student username was missing or invalid or 
    // couldn't be found in database
  
  
  $username = $student["user_name"];
  $query = 'DELETE FROM `student` WHERE user_name = \'$username\' LIMIT 1';
  $result = mysqli_query($db, $query);
  include('lib/show_queries.php');
  if ($result && mysqli_affected_rows($db) == 1) {
    // Success
	array_push($query_msg, "Student deleted. ");
    header(REFRESH_TIME . 'url=manage_student.php');
    
  } else {
    // Failure
    array_push($error_msg,  "Student deletion failed");
    header(REFRESH_TIME . 'url=manage_student.php');
  }
  */
?>
