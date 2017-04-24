<?php

//ini_set('display_errors', '0');
//error_reporting(E_ALL);
ini_set('display_errors', '1');
//error_reporting(E_ALL);

error_reporting(0);
include('lib/common.php');
include ('lib/session.php');
//include ('lib/validation_functions.php');






?>




<?php		
		$username = $_SESSION['user_name'];	
		$student = find_student_by_username($username);
		$stuID = $student['stuID'];
		//$keyID = $_SESSION['keyID'];
		//$courseID = $_SESSION['courseID']
?>
<?php
if (isset($_POST['submit'])) {
  // Process the form for self-assessment part
  
  // validations
  //$required_fields = array("courseID", "quizID")
  //validate_presences($required_fields);
  
      
  // Perform creation of self-assessment

   	$enteredCourseID_quiz = mysqli_real_escape_string($db, $_POST['courseID']);
	$enteredQuizID = mysqli_real_escape_string($db, $_POST['quizID']);
	
	//SESSION_START();
	$_SESSION['stuID'] = $stuID;
	$_SESSION['quizID'] = $enteredQuizID;
	$_SESSION['courseID_quiz'] = $enteredCourseID_quiz;
	// if student taken self-assessment, delete those questions in self-assessment from quiz questions
	
		//$query = "select * from question q join Quiz qz on qz.quizID = q.quizID join course c on qz.courseID = c.courseID where qz.courseID ='" .$enteredCourseID_quiz. "' and q.quizID ='" .$enteredQuizID. "' and q.questionID not in (select questionID from question q join keyconcept k on k.keyID = q.keyID join course c on k.courseID = c.courseID where k.courseID ='" .$courseID. "' and q.keyID ='" .$keyID. "') order by q.questionID limit 20";
	$query = "select * from question q join Quiz qz on qz.quizID = q.quizID join course c on qz.courseID = c.courseID where qz.courseID ='" .$enteredCourseID_quiz. "' and q.quizID ='" .$enteredQuizID. "' and q.questionID not in (select questionID from usageLog where stuID = '" .$stuID. "' ) order by q.questionID limit 20";
	
	    
	$result = mysqli_query($db,$query);
	$length = mysqli_num_rows($result);
	
	while($row = mysqli_fetch_assoc($result))
	{    
		
		// Perform Create self-assessment
		$qArray[] = $row ;
		
		
	}
	
	//store parameters of quiz
	
	$_SESSION['question_quiz'] = $qArray;
	$_SESSION['length'] = $length;
	
    
 }	
?>
		
 
<?php include("lib/header.php"); ?>

<title>Take quiz </title>		
	</head>
	
	<body>
        <div id="main_container">
		    <?php include("lib/menu_stu.php"); ?>
			            
			<div class="center_content">
				<div class="center_left">
					 <!--<?php echo message(); ?> -->	
						<h4>Welcome : <?php if(!empty($_SESSION['user_name'])){echo $_SESSION['user_name'];}?>!</h4>
						</p>	
						<div class="subtitle">Select your quiz</div>   
						<form action="take_quiz.php" method="post" enctype="multipart/form-data">
							
												
							<div class="login_form_row">
								</p>
								<label class="login_label">Course ID:</label>
								<input type="text" name="courseID" value="1" class="login_input"/>
								</p>
							</div>
							<br />
					        <br />
							<br />
					        <br />
							<div class="login_form_row">
								<label class="login_label">quizID:</label>
								<input type="text" name="quizID" value="1" class="login_input"/>
							</div>
						    <br />
					        <br />
							<br />
					        <br />
							  <input type="submit" name="submit" value="Select" />
							  <br />
							  <?php  if (isset($_POST['submit']))    
							         echo "<font color='red'>Quiz Selected !</font>"; ?>
							
							<br />
					        <br />
							<a href="stu_take_quiz.php">Take Quiz</a>
						
							
					   <form/>
						
					</div>					
         
                    
	    <div class="clear"></div> 
	    </div>	
		<?php include("lib/footer.php"); ?> 
		</div>	
		
	</body>
</html>
   


