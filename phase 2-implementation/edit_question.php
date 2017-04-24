<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>
<?php require_once("lib/validation_functions.php"); ?>


<?php
      
   $question = find_question_by_id($_GET["id"]);
   $answer_set =  find_all_answer($_GET["id"]);
   
  
  if (!$question) {
    // question ID was missing or invalid or 
    // question couldn't be found in database
    redirect_to("manage_question.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form for question part
  
  // validations
  $required_fields = array("questionText", "quizID","answer","keyID");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("questionText" => 30);
  validate_max_lengths($fields_with_max_lengths);


    
    // Perform Update

    $questionID = $question["questionID"];
	
    $enteredQuestionText = mysqli_real_escape_string($db, $_POST['questionText']);
	$enteredquizID = mysqli_real_escape_string($db, $_POST['quizID']);
	$enteredAnwser = mysqli_real_escape_string($db, $_POST['answer']);
	$enteredKeyID = mysqli_real_escape_string($db, $_POST['keyID']);
	
	$query = "UPDATE question SET questionText='" . $enteredQuestionText . "', quizID ='" . $enteredquizID . "', answer ='" . $enteredAnwser . " ', keyID ='" . $enteredKeyID . "' WHERE questionID='" . $questionID . "'";
	
    
	$result = mysqli_query($db, $query);

    if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "question updated.";
      redirect_to("manage_question.php");
    } else {
      // Failure
      $_SESSION["message"] = "question update failed.";
	  redirect_to("manage_question.php");
    }
  
  
 
  }

?>

<?php include("lib/header.php"); ?>
<title>Edit Question </title>
</head>
<body>
    <div id="main_container">
        <div id="header">
            <div class="logo">
                <img src= "../image/gtonline_logo.gif" style="opacity:1.0;background-color:E9E5E2;" border="0" alt="", height = "100px", width = "820px", title="GT Online Logo"/>
            </div>
        </div>
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
	 <div class="center_content">
            <div class="text_box">
				<h2>Edit Question <?php echo htmlentities($question["questionID"]); ?>:</h2>
				 <form action="edit_question.php?id=<?php echo urlencode($question["questionID"]); ?>" method="post" enctype="multipart/form-data">
				   <p>
					<input type="text" name="questionText" value="<?php echo htmlentities($question["questionText"]); ?>" class = "question_box"/>
				  </p>
				  								
											<table>															
											
											<?php while($answer = mysqli_fetch_assoc($answer_set)) { ?>
											
											  <tr>
											    <td><?php echo htmlentities($answer["answerID"]); ?></td>
												<td><?php echo htmlentities($answer["text"]); ?></td>
												<td><a href="edit_answer.php?answerID=<?php echo urlencode($answer["answerID"]);?>&questionID=<?php echo urlencode($question["questionID"]);?>" >Edit</a></td>
												<td><a href="delete_answer.php?answerID=<?php echo urlencode($answer["answerID"]);?>&questionID=<?php echo urlencode($question["questionID"]);?>" onclick="return confirm('Are you sure?');">Delete</a></td>
																																							   
											<?php } ?>
										   </table>								
												<a href="new_answer.php?questionID =<?php echo urlencode($question["questionID"])?>">Add answer to question</a>
										   
				
					
					  </p>
					  <br />
					  <p>key Concept ID:
						<input type="text" name="keyID" value="<?php echo htmlentities($question["keyID"]); ?>" />
					  </p>
					   <br />
					  <p>quiz ID:
					   <br />
						<input type="text" name="quizID" value="" />
					 </p>
					 <br />
					 <p>Correct Answer:
					 <input type="text" name="answer" value="<?php echo htmlentities($question["answer"]); ?>" />
				     </p>
					  <br />
					 					
							<input type="submit" name="submit" value="Update Question" />		
					
				<form>
				<br/>
				<br/>
						<?php  if (isset($_POST['submit']))     
																						
									echo "<font color='red'>Question Updated!</font>";?>
				<br />			 
					  <br />
					  <a href="manage_question.php">Cancel</a>
					  <br />
			  </div>
			  
			
		</div>
		 <?php include("lib/footer.php"); ?> 
	</div>
 
<body>
</html>