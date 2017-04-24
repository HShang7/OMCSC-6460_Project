

<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

include('lib/common.php');
//include('lib/functions.php');
include ('lib/session.php');



 if (isset($_GET["pagenum"])){ 

 

 $pagenum = intval($_GET["pagenum"]) ; }

 
 else
 {$pagenum = 1; }

 //Edit $data to be your query 
	$data = mysqli_query($db,"SELECT * FROM Question order by questionID"); 

	$rows = mysqli_num_rows($data); 
 
 
 //This is the number of results displayed per page +

 $page_rows = 8; 

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

$query = "select * from question order by questionID $max";
	    
	
//$query = "SELECT * FROM question $max";
$data_p = mysqli_query($db,$query); 
?>


<?php include("lib/header.php"); ?>
	<title>Manage Question<?php echo mysql_real_escape_string($_SESSION['educator_name']);?></title>
		</head>
			<body>
				<div id="main_container">
					<?php include("lib/menu.php"); ?>
					 <div class="center_content">
						<div class="center_left">
							<div class="center_right">
								<div class="profile_section">
						  
									<div class="subtitle">Manage Question</div>   
											<table>															
											<tr>
											<th style="text-align: left; width: 350px;">Question</th>
											
											<th colspan="2" style="text-align: left;">Actions</th>
											</tr>
											<?php while($question = mysqli_fetch_assoc($data_p)) { ?>
											  <tr>
												<td><?php echo htmlentities($question["questionText"]); ?></td>
												
												<td><a href="edit_question.php?id=<?php echo urlencode($question["questionID"]); ?>">Edit</a></td>
												<td><a href="delete_question.php?id=<?php echo urlencode($question["questionID"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
											  </tr>
											  
											<?php } ?>
										   </table>
										<br />
										<a href="new_question.php">Add new question</a>
								<?php		 
										 echo "<p>";
										 echo "<p>";
										 echo "<br>"; 
										 
										 echo "<p>";
										 

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
					 </div>
				</div>
		<?php include("lib/footer.php"); ?> 
		</div>
	<body>
</html>