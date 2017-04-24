<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
  $quiz = find_quiz_by_id($_GET["id"]);
  
  
  if (!$quiz) {
    // quiz was missing or invalid or 
    // couldn't be found in database
    redirect_to("manage_quiz.php");
	
  }
    $quizID = $quiz["quizID"];
?>

<?php include("lib/header.php"); ?>
		<title> View Quiz </title>
	</head>
   	<body>
        <div id="main_container">
		  <?php include("lib/menu.php"); ?>
            
			<div class="center_content">
				<div class="center_left">
					<div class="features">   	
						<div class="profile_section">
                        	<div class="subtitle">View Quiz</div>   
							<table>
								<tr>
									<td class="heading">Question No.</td>
									<td class="heading">Question Content</td>
									<td class="heading">Answer Key</td>
									<td class="heading">Key Concept No.</td>
								</tr>
																
								<?php								
                                    $query = "SELECT * from Question WHERE quizID = '". $quizID. "' " ;
											
                                             
                                    $result = mysqli_query($db, $query);
                                     if (!empty($result) && (mysqli_num_rows($result) == 0) ) {
                                         array_push($error_msg,  "SELECT ERROR: find Quiz" . __FILE__ ." : ". __LINE__ );
                                    }
                                    
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        print "<tr>";
                                        print "<td>{$row['questionID']}";
										print "<td>{$row['questionText']}</td>";
                                        print "<td>{$row['answer']}</td>";
                                        print "<td>{$row['keyID']}</td>";
                                        print "</tr>";							
                                    }									
                                ?>
							</table>						
						</div>	
					 </div> 
				</div> 
                
                <?php include("lib/error.php"); ?>
                    
				<div class="clear"></div> 
			</div>    

               <?php include("lib/footer.php"); ?>
		 
		</div>
	</body>
</html>
   


