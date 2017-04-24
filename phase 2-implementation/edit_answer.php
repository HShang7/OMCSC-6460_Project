<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>
<?php require_once("lib/validation_functions.php"); ?>


<?php
      
  // Process the form for answer part
  
  $answer = find_answer_by_answerID($_GET["questionID"],$_GET["answerID"]);
  $questionID = $answer["questionID"];
  $answerID = $answer["answerID"];
  
 
	
  if (!$answer) {
    // answer ID was missing or invalid or 
    // answer couldn't be found in database
    redirect_to("edit_question.php");
	
  }
 ?>
  
<?php
   if (isset($_POST['submit'])) {
   // validations
	  $required_fields = array("text", "questionID","answerID");
	  validate_presences($required_fields);
	  
	  $fields_with_max_lengths = array("text" => 600);
	  validate_max_lengths($fields_with_max_lengths);
  

    
    // Perform Update

    $questionID = $answer["questionID"];
	$answerID = $answer["answerID"];
	
    $enteredText = mysqli_real_escape_string($db, $_POST['text']);
	$enteredAnswerID = mysqli_real_escape_string($db, $_POST['answerID']);
	
	$enteredQuestionID = mysqli_real_escape_string($db, $_POST['questionID']);
	
	$query = "UPDATE answer SET text='" .$enteredText. "', questionID ='" .$enteredQuestionID. "', answerID ='" .$enteredAnwserID. " ' WHERE questionID='" .$questionID. "' AND answerID='" .$answerID. "'";
	
    
	$result = mysqli_query($db, $query);

    if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "answer updated.";
      redirect_to("edit_question.php");
    } else {
      // Failure
      $_SESSION["message"] = "answer update failed.";
	  redirect_to("edit_question.php");
    }
  
  }
 
  
?>


<?php include("lib/header.php"); ?>

<title>Edit Answer </title>
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
	 <?php include("lib/menu.php"); ?>
    
	 <div class="center_content">
            <div class="text_box">
				<h2>Edit Answer: <?php echo htmlentities($answer["answerID"]); ?></h2>
				<form action="edit_answer.php?answerID=<?php echo urlencode($answer["answerID"]);?>&questionID=<?php echo urlencode($answer["questionID"]);?>" method="post" enctype="multipart/form-data">
				  <p>answerID:
					<input type="text" name="answerID" value="<?php echo htmlentities($answer["answerID"]); ?>" />
				  </p>
				  <br />
				  <p>questionID:
					<input type="text" name="questionID" value="<?php echo htmlentities($answer["questionID"]); ?>" />
				  </p>
				  <br />
				  <p>Text:
					<input type="text" name="text" value="<?php echo htmlentities($answer["text"]); ?>" />
				  </p>
				  </p>
				  				  <br />
				  <input type="submit" name="submit" value="Update answer" />
				  <br />
				  </p>
				  <br />
				  <a href="edit_question.php">Cancel</a>
				  <br />
				  
				</form>
				
			  </div>
			
		</div>
		 <?php include("lib/footer.php"); ?> 
	</div>
 
<body>