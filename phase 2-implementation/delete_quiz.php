<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
  $quiz = find_quiz_by_id($_GET["id"]);
  
  
  if (!$quiz) {
    // quiz was missing or invalid or 
    // couldn't be found in database
    redirect_to("manage_quiz.php");
	
  }
    $quizID = $quiz["quizID"];

    //$query = 'DELETE FROM `quiz` WHERE stuID = \'$quizID\' LIMIT 1';
	$query = "DELETE FROM quiz WHERE quizID = {$quizID} LIMIT 1";
    $result = mysqli_query($db, $query);
   
	if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "quiz deleted.";
      redirect_to("manage_quiz.php");
    } else {
      // Failure
      $_SESSION["message"] = "quiz deletion failed.";
	  redirect_to("manage_quiz.php");
    }
		

  
?>
