
<?php 
 include('lib/common.php');
 
 //include ('lib/functions.php');

 //if (!isset($_SESSION['user_name'])) {
//	header('Location: login.php');
//	exit();
//}

if($showQueries){
  array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
}

if (isset($_POST['submit'])) {
  // Process the form
	if( $_SERVER['REQUEST_METHOD'] == 'POST') {

		$enteredUserName = mysqli_real_escape_string($db, $_POST['userName']);
		$enteredPassword = mysqli_real_escape_string($db, $_POST['password']);
		$enteredFirstName = mysqli_real_escape_string($db, $_POST['firstName']);
		$enteredLastName = mysqli_real_escape_string($db, $_POST['lastName']);

		if (empty($enteredUserName)) {
				array_push($error_msg,  "Please enter a username.");
		}

		if (empty($enteredPassword)) {
				array_push($error_msg,  "Please enter a password.");
		}
		
		if (empty($enteredFirstName)) {
				array_push($error_msg,  "Please enter a first name.");
		}

		if (empty($enteredLastName)){
				array_push($error_msg,  "Please enter a last name.");
		}
		if ( !empty($enteredUserName) && !empty($enteredPassword) &&!empty($enteredFirstName) && !empty($enteredLastName) )
    
	// Perform Create
    $query = "INSERT INTO Student (user_name, password, first_name, last_name) " .
				 "VALUES ('$enteredUserName', '$enteredPassword', '$enteredFirstName', '$enteredLastName')";
	
	$result = mysqli_query($db, $query);
    //$queryID = mysqli_query($db, $query);
	
	if (mysqli_affected_rows($db) > 0) {
			if($showQueries){
					array_push($query_msg,  $query);
					array_push($query_msg, "Student created ");
				}
		} else{
					array_push($error_msg, "Student creation failed" );
		}
		header(REFRESH_TIME . 'url=manage_student.php');	
   
	}
}

?>


<?php include("lib/header.php"); ?>
<title>Add New Student </title>
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
				
				
                <form action="new_student.php" method="post" enctype="multipart/form-data">
                    <div class="title">New Student</div>
                    <div class="login_form_row">
                        <label class="login_label">Username:</label>
                        <input type="text" name="userName" value="" class="login_input"/>
                    </div>
                    <div class="login_form_row">
                        <label class="login_label">Password:</label>
                        <input type="password" name="password" value="" class="login_input"/>
                    </div>
					
					<div class="login_form_row">
                        <label class="login_label">First Name:</label>
                        <input type="text" name="firstName" value="" class="login_input"/>
                    </div>
					
					<div class="login_form_row">
                        <label class="login_label">Last Name:</label>
                        <input type="text" name="lastName" value="" class="login_input"/>
                    </div>
					<br />
                    </p>
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
						<input type="submit" name="submit" value="Create Student" />
					<br />
						<a href="manage_student.php">Cancel</a>
                    <form/>
					
                </div>
					
                <?php include("lib/error.php"); ?>

                
            </div>

          <div class="clear"></div> 
        </div>
    </body>
</html>