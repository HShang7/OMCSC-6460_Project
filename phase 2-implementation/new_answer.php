
<?php 
 include('lib/common.php');
 include ('lib/session.php');
 $questionID = $_SESSION['newQID'];
 //include ('lib/functions.php');
/*
 if (!isset($_SESSION['user_name'])) {
	header('Location: login.php');
	exit();
}
*/
if($showQueries){
  array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
}

  $questionID = $_SESSION['newQID'];
if (isset($_POST['submit'])) {
  // Process the form
	if( $_SERVER['REQUEST_METHOD'] == 'POST') {

		$enteredAnswerText = mysqli_real_escape_string($db, $_POST['answerText']);
		//$enteredQuestionID = mysqli_real_escape_string($db, $_POST['questionID']);
		$enteredAnswerID = mysqli_real_escape_string($db, $_POST['answerID']);
		
		if (empty($enteredAnswerText)) {
				array_push($error_msg,  "Please enter a answer.");
		}

		//if (empty($enteredQuestionID)) {
				//array_push($error_msg,  "Please enter a questionID.");
		//}
		
		if (empty($enteredAnswerID)) {
				array_push($error_msg,  "Please enter the answerID.");
		}

		
		if ( !empty($enteredAnswerText) &&!empty($enteredAnswerID) )
    
	// Perform Create
    $query = "INSERT INTO Answer(text, questionID, answerID)
				 VALUES ('" .$enteredAnswerText. "', '" .$questionID. "', '" .$enteredAnswerID. "')";
	
	$result = mysqli_query($db, $query);
    //$queryID = mysqli_query($db, $query);
	
	if (mysqli_affected_rows($db) > 0) {
			if($showQueries){
					array_push($query_msg,  $query);
					array_push($query_msg, "Answer created ");
				}
		} else{
					array_push($error_msg, "answer creation failed" );
		}
		header(REFRESH_TIME . 'url=edit_question.php');	
   
	}
}

?>


<?php include("lib/header.php"); ?>
<title>Add New Answer </title>
</head>
<body>
    <div id="main_container">
        <div id="header">
            <div class="logo">
                <img src= "../image/gtonline_logo.gif" style="opacity:1.0;background-color:E9E5E2;" border="0" alt="", height = "100px", width = "820px", title="GT Online Logo"/>
            </div>
        </div>
		
			   
        <div class="center_content">
            <div class="text_box">
				
				
                <form action="new_answer.php" method="post" enctype="multipart/form-data">
                    <div class="title">New Answer</div>
                    <div class="login_form_row">
                        <label class="login_label">New Answer:</label>
                        <input type="text" name="answerText" value="" class="query_msg"/>
                    </div>
					
                    
					
					<div class="login_form_row">
                        <label class="login_label">AnswerID:</label>
                        <input type="text" name="answerID" value="" class="login_input"/>
                    </div>
					</p>
										
                    <form/>
					</p>
					<br />
					<br />
					<?php  if (isset($_POST['submit']))     
																					
									
									echo "<font color='red'>Answer Created!</font>";?>
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					
					<br />
					<input type="submit" name="submit" value="Create Answer" />
					<br />	
					<br />
						<a href="edit_question.php">Cancel</a>
									
                </div>
				<br />
					
                <?php include("lib/error.php"); ?>			    
               <?php include("lib/footer.php"); ?> 	 
            </div>
						

          <div class="clear"></div> 
		  
        </div>
		
    </body>
</html>