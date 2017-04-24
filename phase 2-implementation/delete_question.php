<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
  $question = find_question_by_id($_GET["id"]);
  
  
  if (!$question) {
    // question was missing or invalid or 
    // couldn't be found in database
    redirect_to("manage_question.php");
	
  }
    $questionID = $question["questionID"];

    //$query = 'DELETE FROM `question` WHERE stuID = \'$questionID\' LIMIT 1';
	$query = "DELETE FROM question WHERE questionID = {$questionID} LIMIT 1";
    $result = mysqli_query($db, $query);
   
	if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "question deleted.";
      redirect_to("manage_question.php");
    } else {
      // Failure
      $_SESSION["message"] = "question deletion failed.";
	  redirect_to("manage_question.php");
    }
		

  
?>
