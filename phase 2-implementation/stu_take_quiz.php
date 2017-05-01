

<?php
ini_set('display_errors', '1');
//error_reporting(E_ALL);

error_reporting(0);


include('lib/common.php');
//include('lib/functions.php');
include ('lib/session.php');

if (!isset($_SESSION['user_name']) ){
	header('Location: login.php');
	exit();
}
if (!isset($_SESSION['quizID'])){
	header('Location: take_quiz.php');
	exit();
}
if($showQueries){
 array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
}
 if (isset($_GET["pagenum"])){ 

 

 $pagenum = intval($_GET["pagenum"]) ; }

 
 else
 {$pagenum = 1; }

 //Edit $data to be your query 
 

	$courseID = $_SESSION['courseID'];
	//$keyID = $_SESSION['keyID'];
	$courseID_quiz = $_SESSION['courseID_quiz'];
	$quizID = $_SESSION['quizID'];
	$stuID =$_SESSION['stuID']; 
	// if student taken self-assessment, delete those questions in self-assessment from quiz questions
	
     $query = "select * from question q join Quiz qz on qz.quizID = q.quizID join course c on qz.courseID = c.courseID where qz.courseID ='" .$courseID_quiz. "' and q.quizID ='" .$quizID. "' 
				and q.questionID not in  (select questionID from usageLog where stuID = '" .$stuID. "' ) order by q.questionID limit 20";
	
		
	    
	$data = mysqli_query($db,$query);
	
	$rows = mysqli_num_rows($data); 
 
 
 //This is the number of results displayed per page 

 $page_rows = 1; 

 //This tells us the page number of our last page 

 $last = ceil($rows/$page_rows); 

 //this makes sure the page number isn't below one, or more than our maximum pages 

 if ($pagenum < 1) 

 { 

 $pagenum = 1; 

 } 

 elseif ($pagenum > $last) 

 { 

 $pagenum = $last; 

 }  


 //This sets the range to display in our query 

$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 



	
		$query = "select * from question q 
				join Quiz qz on qz.quizID = q.quizID 
				join course c on qz.courseID = c.courseID 
				where qz.courseID ='" .$courseID_quiz. "' and q.quizID ='" .$quizID. "' 
				and q.questionID not in 
				(select questionID from usageLog where stuID = '" .$stuID. "' )
				order by q.questionID $max";
	
	
	    
	
//$query = "SELECT * FROM question $max";
$data_p = mysqli_query($db,$query); 
$score = 0;
				$stuAnswer = '';
				$question_id = $pagenum-1;
				$correctAnswer = $_SESSION['question_quiz'][$question_id]['answer'];
				$quizID = $_SESSION['quizID'];
				$questionID_quiz = $_SESSION['question_quiz'][$question_id]['questionID'];
?>


<?php include("lib/header.php"); ?>
	<title>quiz <?php echo mysql_real_escape_string($_SESSION['quizID']);?></title>
		</head>
			<body>
				<div id="main_container">
					<?php include("lib/menu_stu.php"); ?>
					 <div class="center_content">
						<div class="center_left">
						 <!--<?php echo message(); ?> -->
						 	<?php
								 //This is where you display your query results
								
								 while($question = mysqli_fetch_assoc( $data_p )) 

								 { 
												//$query2= "INSERT INTO Report (questionID, pageNum,quizID, correctAnswer, stuID) 
												//VALUES ('" .$questionID_quiz. "', '" .$pagenum. "','" .$quizID. "', '" .$correctAnswer. "', '" .$stuID. "')";
												//$result = mysqli_query($db, $query2);
										 echo $question['questionText']; 
											   $current_qID = $question['questionID'];
											   $answer_set =  find_all_answer($current_qID);
								  ?>
								   
										<form action="stu_take_quiz.php?pagenum=<?php echo urlencode($pagenum);?>" method="post" enctype="multipart/form-data">
																					
												<br/>				
												<br/>												
												<?php while($answer = mysqli_fetch_assoc($answer_set)) { ?>
																	
																			
														<input type='radio' name='radio' value='<?php echo $answer['answerID']?> '><?php echo $answer['text']?></td>
														
																											
												<br/> 
												<br/>				
												<br/>									
												<?php } ?>
												<input type="submit" name="submit" value="Submit" />
													
										</form>
										<br/>
										<br/>
										<?php  if (isset($_POST['submit']))        
																						
										
										echo "<font color='red'>Answer Submitted !</font>";?>
											
										
								<?php } 			
								 		 
										 //store student's response to report
										 echo "<p>";
										 echo "<p>";
										 echo "<br>"; 
										 //echo " You selected: ";
										 //$stuAnswer = $_POST['radio'];
										 //echo $stuAnswer;
										 echo "<p>";
										 //echo " The correct answer is: "; 
										 
										 
										 echo "<p>";
										 echo "<br>";
										 echo "<br>"; 

										  // This shows the user what page they are on, and the total number of pages

										 echo " --Page $pagenum of $last-- <p>";

										 // First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page.


										 if ($pagenum == 1) 

										 {

										 } 

										 else 

										 {

										 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";

										 echo " ";

										 $previous = $pagenum-1;

										 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";

										 } 

										 //just a spacer

										 //echo " ---- ";

										 //This does the same as above, only checking if we are on the last page, and then generating the Next and Last links

										 if ($pagenum == $last) 

										 {

										 } 

										 else {

										 $next = $pagenum+1;

										 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";

										 echo "                     ";

										 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> ";

										 } 
									?> 
							 </div>
					   </div>
		<?php include("lib/footer.php"); ?> 
		<?php
				//$score = 0;
				//$stuAnswer = '';
				//$question_id = $pagenum-1;
				//$correctAnswer = $_SESSION['question_quiz'][$question_id]['answer'];
				//$quizID = $_SESSION['quizID'];
				//$questionID_quiz = $_SESSION['question_quiz'][$question_id]['questionID'];
				//build report table
				//while($question = mysqli_fetch_assoc( $data )) 

				//{ 
				
				//}
				
				if (isset($_POST['submit'])) 
				{
					if(isset($_POST['radio']))
					{
						 $stuAnswer = $_POST['radio'];
						 
						
						//$keys=array_keys($_POST);
						//$keys=array_keys($_POST, "radio");
						//$order=implode(",",$keys); //  Displaying Selected Value
				   }
				   echo $stuAnswer;
						
						
						
						//$query1 = "INSERT INTO Report (questionID, pageNum,quizID, correctAnswer, stuID, stuAnswer) 
									//VALUES ('" .$questionID_quiz. "', '" .$pagenum. "','" .$quizID. "', '" .$correctAnswer. "', '" .$stuID. "','" .$stuAnswer. "')";
						$query0 = "INSERT INTO Report (questionID, pageNum,quizID, correctAnswer, stuID, stuAnswer) 
									VALUES ('" .$questionID_quiz. "', '" .$pagenum. "','" .$quizID. "', '" .$correctAnswer. "', '" .$stuID. "','" .$stuAnswer. "')";
						$result = mysqli_query($db, $query0);
						$query1 = "update Report set stuAnswer = '" .$stuAnswer. "' 
									where stuID = '" .$stuID. "' and quizID = '" .$quizID. "' and questionID = '" .$questionID_quiz. "' and pageNum = '" .$pagenum. "'";
						$result = mysqli_query($db, $query1);
						if (mysqli_affected_rows($db) > 0) {
							if($showQueries)
							{
								array_push($query_msg,  $query1);
								array_push($query_msg, "result created ");
							}
						} else
							{
								array_push($error_msg, "Report creation failed" );
							}		
			}
			else
				{
						
						$stuAnswer = 'unanswered';
						echo $stuAnswer;
						
						$query0 = "INSERT INTO Report (questionID, pageNum,quizID, correctAnswer, stuID, stuAnswer) 
									VALUES ('" .$questionID_quiz. "', '" .$pagenum. "','" .$quizID. "', '" .$correctAnswer. "', '" .$stuID. "','" .$stuAnswer. "')";
						$result = mysqli_query($db, $query0);			
						$query1 = "update Report set stuAnswer = '" .$stuAnswer. "' 
									where stuID = '" .$stuID. "' and quizID = '" .$quizID. "' and questionID = '" .$questionID_quiz. "' and pageNum = '" .$pagenum. "'";

						$result = mysqli_query($db, $query1);
				}
						//echo $stuID;
						//echo $quizID;
						//echo $pagenum;
						//echo $correctAnswer;
						//echo $questionID_quiz;
		
		
  ?>
		</div>
	<body>
</html>