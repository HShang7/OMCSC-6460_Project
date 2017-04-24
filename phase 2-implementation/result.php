<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

include('lib/common.php');
//include('lib/functions.php');
include ('lib/session.php');

if (!isset($_SESSION['user_name'])) {
	header('Location: login.php');
	exit();
}


if (isset($_POST['submit'])) {
	if(isset($_POST['radio']))
		{
			//$keys=array_keys($_POST);
			$keys=array_keys($_POST)['radio'];
			$order=implode(",",$keys); //  Displaying Selected Value
	   }
	 
	 while($question = $_SESSION['question']) 

	{ 
								 
		$current_qID = $question['questionID']; 
    
	    $response=mysql_query("select answer from question where questioID = '" .$current_qID. "'");

		while($result=mysqli_fetch_assoc($response)){
			if($result['answer']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
   }   
	  
} 

	//$name=$_SESSION['user_name'];  
	//mysqli_query($db,"update student set score='$right_answer' where user_name='$name'"); 
?>