<?php require_once('lib/common.php');?>
<?php require_once("lib/session.php"); ?>

<?php
    //session_start();
	$quizID = $_SESSION["quizID_resultCheck"];
	
	$courseID = $_SESSION["courseID_resultCheck"];
    $stuID = $_SESSION["stuID_resultCheck"];
  	$score = 0;		
	if ($courseID && $quizID && $stuID) 
	{
    
	//  select the last selected answer choice
    $query = "create or replace VIEW stuReport as select * from report where stuID = '" .$stuID. "' and quizID = '" .$quizID. "' 
			group by questionID order by reportID desc";
	$result = mysqli_query($db, $query);
	//use page number (question _id showed in the Quiz)
	$query1 = "select * from stuReport order by pageNum asc";
	$result1 = mysqli_query($db, $query1);
	
	
	
	
					
    if (!empty($result1) && (mysqli_num_rows($result1) == 0) ) {
                                         array_push($error_msg,  "SELECT ERROR: find Quiz" . __FILE__ ." : ". __LINE__ );
                                    }
  
	}
 
?>

<?php include("lib/header.php"); ?>
		<title> View Quiz Report </title>
	</head>

	<body>
        <div id="main_container">
		    <?php include("lib/menu_stu.php"); ?>
            
			<div class="center_content">
				<div class="center_left">
					<div class="features">   	
						<div class="profile_section">
                        	<div class="subtitle">Quiz <?php echo $quizID ?> </div>   
							<table>
								<tr>
									<td class="heading">Question ID</td>
									<td class="heading">Correct Answer</td>
									<td class="heading">Student Answer</td>
									
								</tr>
																
								<?php								
                                                                       
                                    while ($row = mysqli_fetch_assoc($result1)){
                                        print "<tr>";
                                        print "<td>{$row['pageNum']}";
										print "<td>{$row['correctAnswer']}</td>";
                                        print "<td>{$row['stuAnswer']}</td>";
                                        print "</tr>";	
										$stuAnswer[] = $row['stuAnswer'];
										$correctAnswer[] = $row['correctAnswer'];
										$questionID [] = $row ['questionID'];
										
                                    }	
                                  
                                ?>
							</table>						
						</div>	
					 </div> 
					 <?php 
							//echo $stuAnswer[0];  echo $correctAnswer[0]; echo "<br>";
							//echo $stuAnswer[1];  echo $correctAnswer[1]; echo "<br>";
							//echo $stuAnswer[2];  echo $correctAnswer[2]; echo "<br>";
							//echo $stuAnswer[3];  echo $correctAnswer[3]; echo "<br>";
							//echo $stuAnswer[4];  echo $correctAnswer[4]; echo "<br>";
							//echo $stuAnswer[5];  echo $correctAnswer[5]; echo "<br>";
						    $size= sizeof($correctAnswer);
							//echo $size;
							$rightAnswerNum = 0;
							for($i = 0; $i < $size; $i++)
							{
								if (strcmp(rtrim(ltrim($stuAnswer[$i])),rtrim(ltrim($correctAnswer[$i]))) == 0)
								{
									$rightAnswerNum ++;
									
									$sql = "update question set correct_count  = correct_count + 1 where questionID ='" .$questionID[$i]. "'";
									
									//echo $i; echo rtrim(ltrim($stuAnswer[$i])); echo "<br>";
									$result = mysqli_query($db, $sql);
								}
								
								else
								{	
									$sql = "update question set wrong_count  = wrong_count + 1 where questionID ='" .$questionID[$i]. "'";
									
									//echo $i; echo rtrim(ltrim($stuAnswer[$i])); echo "<br>";
									$result = mysqli_query($db, $sql);
								}
							}
						   
							
							echo "Your score is:"."<br>";
							$score = number_format($rightAnswerNum*100/$size, 1);		
							echo "<font color='red'>$score</font><br>";
							
							$query = "INSERT INTO Score (stuID, courseID, quizID) " .
										"VALUES ('" .$stuID. "', '" .$courseID. "', '" .$quizID. "')";
	
							$result = mysqli_query($db, $query);
							
							$sql = "update score set score = '" .$score. "' where courseID = '" .$courseID. "' and stuID = '" .$stuID. "' and quizID ='" .$quizID. "' ";
							
									
						    $result = mysqli_query($db, $sql);
						
					 ?>
				</div> 
                  
				<div class="clear"></div> 
			</div>    

               <?php include("lib/footer.php"); ?>
		 
		</div>
	</body>
</html>
   


