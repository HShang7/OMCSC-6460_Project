<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
  $quiz = find_quiz_by_id($_GET["id"]);
  
  
  if (!$quiz) {
    // quiz was missing or invalid or 
    // couldn't be found in database
    redirect_to("manage_report.php");
	
  }
    $quizID = $quiz["quizID"];
	$courseID = $quiz["courseID"];
?>

<?php include("lib/header.php"); ?>
		<title> View Scores </title>
	</head>
   
	<body>
        <div id="main_container">
		    <?php include("lib/menu.php"); ?>
            
			<div class="center_content">
				<div class="center_left">
					<div class="features">   	
						<div class="profile_section">
                        	<div class="subtitle">View statistics of quiz<?php echo $quizID ?></div>   
							<table>
								<tr>
									<td class="heading">StuID.</td>
									<td class="heading">Scores</td>
								</tr>
																
								<?php								
                                    $query = "SELECT * from Score WHERE quizID = '". $quizID. "' group by stuID " ;
											
                                             
                                    $result = mysqli_query($db, $query);
                                     if (!empty($result) && (mysqli_num_rows($result) == 0) ) {
                                         array_push($error_msg,  "SELECT ERROR: find Quiz" . __FILE__ ." : ". __LINE__ );
                                    }
                                    
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        print "<tr>";
                                        print "<td>{$row['stuID']}";
										print "<td>{$row['score']}</td>";
                                        print "</tr>";
										//store score into array
										$score[] = 	$row['score'];
									}
									$max_score=max($score);
									$mean = array_sum($score)/count($score);
									$std = standard_deviation($score);	
									$median = median($score);
									
									         									
                                ?>
							</table>
							        <?php
									 
										echo "<br>Highest score: "; 
										echo "<font color='red'>$max_score</font><br>";
										echo "Mean score: ";
										echo "<font color='red'>$mean</font><br>";
										echo "Standard deviation: ";
										echo "<font color='red'>$std</font><br>";
										echo "Median score: ";
										echo "<font color='red'>$median</font><br>";
									?>	
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
   


