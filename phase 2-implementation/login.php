<?php
/* connect to database */	
//php -S localhost:8000
$connect = mysqli_connect("localhost:8888", "gtuser", "gtuser123");
mysqli_select_db($connect,"cs6460_sp17_project") or die( "Unable to select database");

include('lib/common.php');
include ('lib/session.php');


//if($showQueries){
//  array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
//}

//*reference -- revised based upon cs6400 course materials-gtOnline example *

if (isset($_POST['action'])){
	
	switch($_POST['action']) {
    case 'Educator login': 
   

		$enteredName = mysqli_real_escape_string($db, $_POST['userName']);
		$enteredPassword = mysqli_real_escape_string($db, $_POST['passWord']);

		if (empty($enteredName)) {
				array_push($error_msg,  "Please enter an educator username.");
		}

		if (empty($enteredPassword)) {
				array_push($error_msg,  "Please enter a password.");
		}
		
		if ( !empty($enteredName) && !empty($enteredPassword) )   { 

			$query = "SELECT * FROM Educator WHERE user_name='$enteredName'";
			
			$result = mysqli_query($db, $query);
			//include('lib/show_queries.php');
			$count = mysqli_num_rows($result); 
			
			if (!empty($result) && ($count > 0) ) {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$storedPassword = $row['password']; 
				$educator_name = $row['user_name'];
				$options = [
					'cost' => 8,
				];
				$storedHash = password_hash($storedPassword, PASSWORD_BCRYPT, $options); 
				$enteredHash = password_hash($enteredPassword, PASSWORD_BCRYPT, $options); 
				
				if($showQueries){
					array_push($query_msg, "Plaintext entered password: ". $enteredPassword);
					array_push($query_msg, "Entered Hash:". $enteredHash);
					array_push($query_msg, "Stored Hash:  ". $storedHash . NEWLINE);
				}
				if (password_verify($enteredPassword, $storedHash) ) {
					
					array_push($query_msg, "Password is Valid! ");
					$_SESSION['educator_name'] = $educator_name;
					array_push($query_msg, "logging in... ");
					header(REFRESH_TIME . 'url=manage_student.php');		
					
				} else {
					array_push($error_msg, "Login failed: " . $enteredEmail . NEWLINE);
					array_push($error_msg, "To demo enter: ". NEWLINE . "michael@bluthco.com". NEWLINE ."michael123");
				}
				
			} else {
					array_push($error_msg, "The username entered does not exist: " . $enteredName);
				}
		}

    break;
    case 'Student login':
		$enteredName = mysqli_real_escape_string($db, $_POST['user_name']);
		$enteredPassword = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($enteredName)) {
				array_push($error_msg,  "Please enter a student username.");
		}

		if (empty($enteredPassword)) {
				array_push($error_msg,  "Please enter a password.");
		}
		
		if ( !empty($enteredName) && !empty($enteredPassword) )   { 

			$query = "SELECT * FROM Student WHERE user_name='$enteredName'";
			
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');
			$count = mysqli_num_rows($result); 
			
			if (!empty($result) && ($count > 0) ) {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$storedPassword = $row['password']; 
				
				$options = [
					'cost' => 8,
				];
				$storedHash = password_hash($storedPassword, PASSWORD_BCRYPT, $options); 
				$enteredHash = password_hash($enteredPassword, PASSWORD_BCRYPT, $options); 
				
				if($showQueries){
					array_push($query_msg, "Plaintext entered password: ". $enteredPassword);
					array_push($query_msg, "Entered Hash:". $enteredHash);
					array_push($query_msg, "Stored Hash:  ". $storedHash . NEWLINE);
				}
				if (password_verify($enteredPassword, $storedHash) ) {
					
					array_push($query_msg, "Password is Valid! ");
					$_SESSION['user_name'] = $enteredName;
					array_push($query_msg, "logging in... ");
					header(REFRESH_TIME . 'url=view_keyconcept.php');		
					
				} else {
					array_push($error_msg, "Login failed: " . $enteredEmail . NEWLINE);
					array_push($error_msg, "To demo enter: ". NEWLINE . "michael@bluthco.com". NEWLINE ."michael123");
				}
				
			} else {
					array_push($error_msg, "The username entered does not exist: " . $enteredEmail);
				}
		}

	    
    break;
	}
}
?>

<?php include("lib/header.php"); ?>
<title>User Login</title>
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
				
				<form action="login.php" method="post" enctype="multipart/form-data">
                
                    <div class="title">Login as Educator</div>
                    <div class="login_form_row">
					    <label class="login_label">Username:</label>
                        <input type="text" name="userName" value="" class="login_input"/>
					</div>
										
                    <div class="login_form_row">
                        <label class="login_label">Password:</label>
					    <input type="password" name="passWord" value="" class="login_input"/>
					</div>
					<br/>
					<br/>
					<br/>
					<br/>
					 <input type="submit" name="action" alt= "Action" value="Educator login">
					<form/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
				    <br/>
				    <br/>
				   
					<form action="login.php" method="post" enctype="multipart/form-data">
                    <div class="title">Login as Student</div>
                    <div class="login_form_row">
					    <label class="login_label">Username:</label>
                        <input type="text" name="user_name" value="hshang7" class="login_input"/>
					</div>
										
                    <div class="login_form_row">
                        <label class="login_label">Password:</label>
					    <input type="password" name="password" value="haixia" class="login_input"/>
					
					</div>
					<br/>
					<br/>
					<br/>
					<br/>
				   <input type="submit" name="action" alt= "Action" value="Student login">
				   <form/>
				   
				   
				</div>  
				  
				  
				
                <?php include("lib/error.php"); ?>

                <div class="clear"></div>
         		
			</div>

            <?php include("lib/footer.php"); ?>

        </div>
    </body>
</html>