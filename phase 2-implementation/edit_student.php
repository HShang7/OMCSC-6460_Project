<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>
<?php require_once("lib/validation_functions.php"); ?>


<?php
      
   $student = find_student_by_id($_GET["id"]);
  
  if (!$student) {
    // student ID was missing or invalid or 
    // student couldn't be found in database
    redirect_to("manage_student.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("user_name", "password","first_name","last_name");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("user_name" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
    
    // Perform Update

    $stuID = $student["stuID"];
	
    $enteredUser_name = mysqli_real_escape_string($db, $_POST['user_name']);
	$enteredPassword = mysqli_real_escape_string($db, $_POST['password']);
	$enteredFirst_name = mysqli_real_escape_string($db, $_POST['first_name']);
	$enteredLast_name = mysqli_real_escape_string($db, $_POST['last_name']);
	
	$query = "UPDATE student SET user_name='" . $enteredUser_name . "', password ='" . $enteredPassword . "', first_name ='" . $enteredFirst_name . " ', last_name ='" . $enteredLast_name . "' WHERE stuID='" . $stuID . "'";
	
    
	$result = mysqli_query($db, $query);

    if ($result && mysqli_affected_rows($db) == 1 ) {
      // Success
      $_SESSION["message"] = "student updated.";
      redirect_to("manage_student.php");
    } else {
      // Failure
      $_SESSION["message"] = "student update failed.";
	  redirect_to("manage_student.php");
    }
  
  }

?>

<?php include("lib/header.php"); ?>
<title>Edit Student </title>
</head>
<body>
    <div id="main_container">
        <div id="header">
            <div class="logo">
                <img src= "../image/gtonline_logo.gif" style="opacity:1.0;background-color:E9E5E2;" border="0" alt="", height = "100px", width = "900px", title="GT Online Logo"/>
            </div>
        </div>
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
	 <div class="center_content">
            <div class="text_box">
				<h2>Edit Student: <?php echo htmlentities($student["user_name"]); ?></h2>
				<form action="edit_student.php?id=<?php echo urlencode($student["stuID"]); ?>" method="post" enctype="multipart/form-data">
				  <p>Student ID:
					<input type="text" name="stuID" value="<?php echo htmlentities($student["stuID"]); ?>" />
				  </p>
				  <br />
				  <p>Password:
					<input type="text" name="password" value="1" />
				  </p>
				  <br />
				  <p>First Name:
					<input type="text" name="first_name" value="<?php echo htmlentities($student["first_name"]); ?>" />
				  </p>
				  <br />
				  <p>Last Name:
					<input type="text" name="last_name" value="<?php echo htmlentities($student["last_name"]); ?>" />
				  </p>
				  <br />
				  <input type="submit" name="submit" value="Edit student" />
				  <br />
				  <br />
				  <a href="manage_student.php">Cancel</a>
				  <br />
				  
				</form>
				
			  </div>
			
		</div>
		 <?php include("lib/footer.php"); ?> 
	</div>
 
<body>