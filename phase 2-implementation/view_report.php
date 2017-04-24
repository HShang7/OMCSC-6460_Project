
<?php 
 
 error_reporting(0);
 include('lib/common.php');
 

 if (!isset($_SESSION['user_name'])) {
	header('Location: login.php');
	exit();
}
//if($showQueries){
  //array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
//}

if (isset($_POST['submit'])) {
  // Process the form
	if( $_SERVER['REQUEST_METHOD'] == 'POST') {

		$enteredCourseID = mysqli_real_escape_string($db, $_POST['courseID']);
		$enteredQuizID = mysqli_real_escape_string($db, $_POST['quizID']);
		$enteredStuID = mysqli_real_escape_string($db, $_POST['stuID']);
		//$enteredScore = mysqli_real_escape_string($db, $_POST['score']);
		//session_start();
		$_SESSION["courseID_resultCheck"] = $enteredCourseID;
		
		$_SESSION["quizID_resultCheck"] = $enteredQuizID;
		$_SESSION["stuID_resultCheck"] = $enteredStuID;
		
		if (empty($enteredCourseID)) {
				array_push($error_msg,  "Please enter a courseID.");
		}

		if (empty($enteredQuizID)) {
				array_push($error_msg,  "Please enter a QuizID.");
		}
		
		if (empty($enteredStuID)) {
				array_push($error_msg,  "Please enter a Student ID.");
		}
		
	   
	}
}

?>


<?php include("lib/header.php"); ?>
<title>View Quiz Result</title>
</head>
<body>
    <div id="main_container">
        
		<?php include("lib/menu_stu.php"); ?>	   
        <div class="center_content">
            <div class="text_box">
			
				<form action="view_report.php" method="post" enctype="multipart/form-data">
                    <div class="title">View Result</div>
                    				
                    <div class="login_form_row">
					</p>
                        <label class="login_label">quiz ID:</label>
                        <input type="text" name="quizID" value="1" class="login_input"/>
						
                    </div>
					</p>
					<div class="login_form_row">
                        <label class="login_label">Course ID:</label>
                        <input type="text" name="courseID" value="1" class="login_input"/>
					<div class="login_form_row">
					</p>
                        <label class="login_label">Student ID:</label>
                        <input type="text" name="stuID" value="1" class="login_input"/>
                    </div>
					</p>
					<br />
					<br />
					<br />
					<input type="submit" name="submit" value=" Select Quiz" />
					<br />
					<br />
					
					<a href="check_result.php">View Quiz Report</a>
					 <form/>
					 
					<br/>
										<br/>
										<?php  if (isset($_POST['submit']))        
										
										echo "<font color='red'>Quiz Selected!</font>";?>
										
					<br/>
					<br/>	
						
					
													
                </div>
				<br />
				
				
                   
                
            </div>
							

          <div class="clear"></div> 
		  
        </div>
    </body>
</html>