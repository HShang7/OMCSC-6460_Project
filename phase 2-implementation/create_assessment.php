<?php

//ini_set('display_errors', '0');
//error_reporting(E_ALL);
ini_set('display_errors', '1');
//error_reporting(E_ALL);

error_reporting(0);
include('lib/common.php');
//include('lib/functions.php');
include ('lib/session.php');
include ('lib/validation_functions.php');




if (!isset($_SESSION['user_name'])) {
	header('Location: login.php');
	exit();
}

?>




<?php		
		$username = $_SESSION['user_name'];	
		$student = find_student_by_username($username);
		$stuID = $student['stuID'];
		
?>
<?php
if (isset($_POST['submit'])) {
  // Process the form for self-assessment part
  
  // validations
  //$required_fields = array("courseID", "keyID")
  //validate_presences($required_fields);
  
      
  // Perform creation of self-assessment

   	$enteredCourseID = mysqli_real_escape_string($db, $_POST['courseID']);
	$enteredKeyID = mysqli_real_escape_string($db, $_POST['keyID']);
	
	//SESSION_START();
	$_SESSION['stuID'] = $stuID;
	$_SESSION['keyID'] = $enteredKeyID;
	$_SESSION['courseID'] = $enteredCourseID;
	$query = "select * from question q join keyconcept k on k.keyID = q.keyID join course c on k.courseID = c.courseID where k.courseID ='" .$enteredCourseID. "' and q.keyID ='" .$enteredKeyID. "'  order by q.questionID limit 5";
	    
	$qResult = mysqli_query($db,$query);
	$length = mysqli_num_rows($qResult);
	//$row = mysqli_fetch_array($qResult);
	
	//$qArray = array();
	//for ( $i = 0; $i<$length; $i++ )
	while($row = mysqli_fetch_assoc($qResult))
	{    
		
		// Perform Create self-assessment
		$qArray[] = $row ;
		$questionID = $row['questionID'];
		$sql= "insert into UsageLog (stuID, questionID) values ( '" .$stuID. "', '" .$questionID. "')";
		
	    $result = mysqli_query($db, $sql);
	}
	
	//store number of questions
	//$query1 = "select count(*) from question q join keyconcept k on k.keyID = q.keyID and k.courseID = '" . $enteredCourseID . "' where q.keyID ='" . $enteredKeyID . "'  order by q.questionID limit 10";
	//$result = mysqli_query($db, $query1);
	//$length =  mysqli_fetch_assoc($result)['count'];
	$_SESSION['questions'] = $qArray;
	$_SESSION['length'] = $length;
	
    
 }	
?>
		
 
<?php include("lib/header.php"); ?>

<title>Create self-assessment </title>		
	</head>
	
	<body>
        <div id="main_container">
		    <?php include("lib/menu_stu.php"); ?>
			            
			<div class="center_content">
				<div class="center_left">
					 <?php echo message(); ?>	
						<h4>Welcome : <?php if(!empty($_SESSION['user_name'])){echo $_SESSION['user_name'];}?>!</h4>
						</p>	
						<div class="subtitle">Create Self-assessment by Key concept</div>   
						<form action="create_assessment.php" method="post" enctype="multipart/form-data">
							
												
							<div class="login_form_row">
								</p>
								<label class="login_label">Course ID:</label>
								<input type="text" name="courseID" value="" class="login_input"/>
								</p>
							</div>
							<br />
					        <br />
							<br />
					        <br />
							<div class="login_form_row">
								<label class="login_label">Key Concept ID:</label>
								<input type="text" name="keyID" value="" class="login_input"/>
							</div>
						    <br />
					        <br />
							<br />
					        <br />
							  <input type="submit" name="submit" value="Create self-assessment" />
							
							<br />
					        <br />
							<a href="new_self-assessment.php">Take Self-Assessment</a>
						
							
					   <form/>
						<br/>
						<br/>
						<?php  if (isset($_POST['submit']))     
																						
										
										echo "<font color='red'>Assessment Created!</font>";?>
					</div>					
         
                    
	    <div class="clear"></div> 
	    </div>	
		<?php include("lib/footer.php"); ?> 
		</div>	
		
	</body>
</html>
   


