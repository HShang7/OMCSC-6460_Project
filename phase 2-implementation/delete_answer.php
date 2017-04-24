<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
  $answer = find_answer_by_answerID($_GET["questionID"],$_GET["answerID"]);
  
  
  if (!$answer) {
    // answer was missing or invalid or 
    // couldn't be found in database
    redirect_to("edit_question.php");
	
  }
    $questionID = $answer["questionID"];
	$answerID = $answer["answerID"];

    //$query = 'DELETE FROM `question` WHERE stuID = \'$questionID\' LIMIT 1';
	$query = "DELETE FROM answer WHERE questionID = '" .$questionID. "' AND answerID = '" .$answerID. "'";
    $result = mysqli_query($db, $query);
   
	if (mysqli_affected_rows($db) == 1  ) {
      // Success
      $_SESSION["message"] = "answer deleted.";
      redirect_to("edit_question.php");
    } else {
      // Failure
      $_SESSION["message"] = "answer deletion failed.";
	  redirect_to("edit_question.php");
    }
		

  
?>
