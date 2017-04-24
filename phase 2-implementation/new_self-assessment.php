

<?php
ini_set('display_errors', '0');
//error_reporting(E_ALL);
error_reporting(0);
include('lib/common.php');
//include('lib/functions.php');
include ('lib/session.php');

if (!isset($_SESSION['user_name'])) {
	header('Location: login.php');
	exit();
}

 if (isset($_GET["pagenum"])){ 

 

 $pagenum = intval($_GET["pagenum"]) ; }

 
 else
 {$pagenum = 1; }

 //Here we count the number of results 

 //Edit $data to be your query 
 $courseID = $_SESSION['courseID'];
 $keyID = $_SESSION['keyID'];
 $data = mysqli_query($db,"select * from question q join keyconcept k on k.keyID = q.keyID join course c on k.courseID = c.courseID where k.courseID ='" .$courseID. "' and q.keyID ='" .$keyID. "'  order by q.questionID limit 5"); 
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


$query = "select * from question q join keyconcept k on k.keyID = q.keyID join course c on k.courseID = c.courseID where k.courseID ='" .$courseID. "' and q.keyID ='" .$keyID. "'  order by q.questionID $max";
//$query = "SELECT * FROM question $max";
$data_p = mysqli_query($db,$query); 
?>
<?php
	if (isset($_POST['submit'])) {
		if(isset($_POST['radio']))
		{
			//$keys=array_keys($_POST);
			$keys=array_keys($_POST, "radio");
			$order=implode(",",$keys); //  Displaying Selected Value
	   }
	 	 
}   ?>

<?php include("lib/header.php"); ?>
	<title>Self-assessmentfor key concept <?php echo mysql_real_escape_string($_SESSION['keyID']);?></title>
		</head>
			<body>
				<div id="main_container">
					<?php include("lib/menu_stu.php"); ?>
					 <div class="center_content">
						<div class="center_left">
						 <?php echo message(); ?>
								<?php
								 //This is where you display your query results

								 while($question = mysqli_fetch_assoc( $data_p )) 

								 { 

										 echo $question['questionText']; 
											   $current_qID = $question['questionID'];
											   $answer_set =  find_all_answer($current_qID);
								  ?>
								   
										<form action="new_self-assessment.php?pagenum=<?php echo urlencode($pagenum);?>" method="post" enctype="multipart/form-data">
																					
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
										
										
										
										
										
								<?php } 			
								 		 
										 
										 echo "<p>";
										 echo "<p>";
										 echo "<br>"; 
										 if(isset($_POST['radio'])){
											echo " You selected: ";
										    echo $_POST['radio'];
										 
										 echo "<p>";
										 echo " The correct answer is: "; 
										 $question_id = $pagenum-1;
										 echo $_SESSION['questions'][$question_id]['answer'];
										 }
										 //echo $keys;
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
		</div>
	<body>
</html>