
<?php 
 include('lib/common.php');
 include ('lib/session.php');
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

if (isset($_POST['submit'])) {
  // Process the form
	if( $_SERVER['REQUEST_METHOD'] == 'POST') {

		$enteredQuestionText = mysqli_real_escape_string($db, $_POST['questionText']);
		$enteredQuizID = mysqli_real_escape_string($db, $_POST['quizID']);
		$enteredAnswer = mysqli_real_escape_string($db, $_POST['answer']);
		$enteredKeyID = mysqli_real_escape_string($db, $_POST['keyID']);

		if (empty($enteredQuestionText)) {
				array_push($error_msg,  "Please enter a question.");
		}

		if (empty($enteredQuizID)) {
				array_push($error_msg,  "Please enter a quizID.");
		}
		
		if (empty($enteredAnswer)) {
				array_push($error_msg,  "Please enter the answer.");
		}

		if (empty($enteredKeyID)){
				array_push($error_msg,  "Please enter a keyID.");
		}
		if ( !empty($enteredQuestionText) && !empty($enteredQuizID) &&!empty($enteredAnswer) && !empty($enteredKeyID) )
    
	// Perform Create
    $query = "INSERT INTO Question (questionText, quizID, answer, keyID)
				 VALUES ('" .$enteredQuestionText. "', '" .$enteredQuizID. "', '" .$enteredAnswer. "', '" .$enteredKeyID. "')";
	
	$result = mysqli_query($db, $query);
	
	if($result){
        $newQuestionID = mysqli_insert_id($db);
			//echo "New record created successfully. Last inserted item is: " . $newItemID;
		    }
	
	else{
		echo "Error: insert failed" ;
	    }
	
	$sql = "SELECT * FROM Question WHERE questionID = '" .$newQuestionID. "'";
	$result = mysqli_query($db,$sql);
	$newQID = mysqli_fetch_assoc($result)['questionID'];
	//SESSION_START();
	$_SESSION['newQID'] = $newQID;
   
	
	if (mysqli_affected_rows($db) > 0) {
			if($showQueries){
					array_push($query_msg,  $query);
					array_push($query_msg, "Question created ");
				}
		} else{
					array_push($error_msg, "question creation failed" );
		}
		header(REFRESH_TIME . 'url=new_answer.php');	
   
	}
}

?>


<?php include("lib/header.php"); ?>
<title>Add New Question </title>
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
				
				
                <form action="new_question.php" method="post" enctype="multipart/form-data">
                    <div class="title">New Question</div>
                    <div class="login_form_row">
                        <label class="login_label">Question:</label>
                        <input type="text" name="questionText" value="" class="query_msg"/>
                    </div>
					
                    <div class="login_form_row">
						</p>
                        <label class="login_label">QuizID:</label>
                        <input type="quizID" name="quizID" value="" class="login_input"/>
						</p>
                    </div>
					
					<div class="login_form_row">
                        <label class="login_label">Answer Key:</label>
                        <input type="text" name="answer" value="" class="login_input"/>
                    </div>
					</p>
					<div class="login_form_row">
                        <label class="login_label">keyID:</label>
                        <input type="text" name="keyID" value="" class="login_input"/>
                    </div>
					</p>
					<br />
					
                    </p>
						<input type="submit" name="submit" value="Create Question" />
					</p>
					
                <form/>
				<br />
				<br />
				
					<a href="new_answer.php">Add answer to question</a>
					
						
					<br />
					<br />
						<a href="manage_Question.php">Cancel</a>
				<br />
				<br />
				<?php  if (isset($_POST['submit']))     
																					
									
									echo "<font color='red'>Question Created!</font>";?>
					
                </div>
				
				
					
                <?php include("lib/error.php"); ?>

                
            </div>

          <div class="clear"></div> 
        </div>
    </body>
</html>