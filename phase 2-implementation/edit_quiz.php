<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>
<?php require_once("lib/validation_functions.php"); ?>


<?php
      
   $quiz = find_quiz_by_id($_GET["id"]);
  
  if (!$quiz) {
    // quiz ID was missing or invalid or 
    // quiz couldn't be found in database
    redirect_to("manage_quiz.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("courseID", "score","title");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("title" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
    
    // Perform Update

    $quizID = $quiz["quizID"];
	
    $enteredCourseID = mysqli_real_escape_string($db, $_POST['courseID']);
	$enteredScore = mysqli_real_escape_string($db, $_POST['score']);
	$enteredTitle = mysqli_real_escape_string($db, $_POST['title']);
	
	
	$query = "UPDATE quiz SET courseID='" .$enteredCourseID. "', score ='" .$enteredScore. "', title ='" .$enteredTitle. "' WHERE quizID='" .$quizID. "'";
	
    
	$result = mysqli_query($db, $query);

    if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "quiz updated.";
      redirect_to("manage_quiz.php");
    } else {
      // Failure
      $_SESSION["message"] = "quiz update failed.";
	  redirect_to("manage_quiz.php");
    }
  
  }

?>

<?php include("lib/header.php"); ?>
<title>Edit Quiz </title>
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
				<h2>Edit Quiz: <?php echo htmlentities($quiz["quizID"]); ?></h2>
				<form action="edit_quiz.php?id=<?php echo urlencode($quiz["quizID"]); ?>" method="post" enctype="multipart/form-data">
				  <p>CourseID:
					<input type="text" name="courseID" value="<?php echo htmlentities($quiz["courseID"]); ?>" />
				  </p>
				  <br />
				  <p>Score:
					<input type="text" name="score" value="0" />
				  </p>
				  <br />
				  <p>Title:
					<input type="text" name="title" value="<?php echo htmlentities($quiz["title"]); ?>" />
				  </p>
				  <br />
				  
				  <br />
				  <input type="submit" name="submit" value="Update Quiz" />
				  <br />
				  <br />
				  <a href="manage_quiz.php">Cancel</a>
				  <br />
				  
				</form>
				
			  </div>
			
		</div>
		 <?php include("lib/footer.php"); ?> 
	</div>
 
<body>