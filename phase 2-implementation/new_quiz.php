
<?php 
 include('lib/common.php');
 
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

		$enteredCourseID = mysqli_real_escape_string($db, $_POST['courseID']);
		$enteredTitle = mysqli_real_escape_string($db, $_POST['title']);
		//$enteredScore = mysqli_real_escape_string($db, $_POST['score']);
		
		if (empty($enteredCourseID)) {
				array_push($error_msg,  "Please enter a courseID.");
		}

		if (empty($enteredTitle)) {
				array_push($error_msg,  "Please enter a title.");
		}
		
			
		if ( !empty($enteredCourseID) && !empty($enteredTitle) )
    
	// Perform Create
    $query = "INSERT INTO Quiz(courseID, title)
				 VALUES ('" .$enteredCourseID. "', '" .$enteredTitle. "')";
	
	$result = mysqli_query($db, $query);
    //$queryID = mysqli_query($db, $query);
	
	if (mysqli_affected_rows($db) > 0) {
			if($showQueries){
					array_push($query_msg,  $query);
					array_push($query_msg, "Quiz created ");
				}
		} else{
					array_push($error_msg, "Quiz creation failed" );
		}
		header(REFRESH_TIME . 'url=manage_quiz.php');	
   
	}
}

?>


<?php include("lib/header.php"); ?>		    

<title>Add New Quiz </title>
</head>
<body>
    <div id="main_container">
        <div id="header">
            <div class="logo">
                <img src= "../image/gtonline_logo.gif" style="opacity:1.0;background-color:E9E5E2;" border="0" alt="", height = "100px", width = "820px", title="GT Online Logo"/>
            </div>
        </div>
		<?php include("lib/menu.php"); ?>
			   
        <div class="center_content">
            <div class="text_box">
				
				
                <form action="new_quiz.php" method="post" enctype="multipart/form-data">
                    <div class="title">New Quiz</div>
                    				
                    <div class="login_form_row">
						</p>
                        <label class="login_label">Title:</label>
                        <input type="quizID" name="title" value="" class="query_msg"/>
						</p>
                    </div>
					
					<div class="login_form_row">
                        <label class="login_label">Course ID:</label>
                        <input type="text" name="courseID" value="" class="login_input"/>
                    </div>
					</p>
					<br />
					<br />
					<br />
					<br />
					<br />
					<input type="submit" name="submit" value="Create Quiz" />
					</p>	
					<br />
					<br />
						<a href="manage_quiz.php">Cancel</a>
							
                    <form/>
					
								
                </div>
				<br />
				
                <?php include("lib/error.php"); ?>			    
                
            </div>
							

          <div class="clear"></div> 
		  
        </div>
    </body>
</html>