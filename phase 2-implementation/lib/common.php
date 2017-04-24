<?php

if (!isset($_SESSION)) {
    session_start();
}

// Allow back button without reposting data
header("Cache-Control: private, no-cache, no-store, proxy-revalidate, no-transform");
date_default_timezone_set('America/Los_Angeles');

$error_msg = [];
$query_msg = [];
$showQueries = false; //false  true
$showCounts = false; 
$dumpResults = false;

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')           
    define("SEPARATOR", "\\");
else 
    define("SEPARATOR", "/");

//show cause of HTTP : 500 Internal Server Error
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("log_errors", 'on');
ini_set("error_log", getcwd() . SEPARATOR ."error.log");

// NotePad++ Fix Source Formating:  Ctrl+Alt+Shift+B
// PHPStorm Fix Source Formating: Ctrl+Alt+L
              
define('NEWLINE',  '<br>' );
define('REFRESH_TIME', 'Refresh: 1; ');

$encodedStr = basename($_SERVER['REQUEST_URI']); 
//convert '%40' to '@'  example: request_friend.php?friendemail=pam@dundermifflin.com
$current_filename = urldecode($encodedStr);
	
if($showQueries){
    array_push($query_msg, "<b>Current filename: ". $current_filename . "</b>"); 
}

define('DB_SERVER', "localhost");
define('DB_USERNAME', "gtuser");
define('DB_PASSWORD', "gtuser123");
define('DB_DATABASE', "cs6460_sp17_project");
define('DB_PORT', "8888");

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . NEWLINE;
    echo "Running on: ". DB_SERVER . ":". DB_PORT . '<br>' . "Username: " . DB_USERNAME . '<br>' . "Password: " . DB_PASSWORD . '<br>' ."Database: " . DB_DATABASE;
    phpinfo(); 
    exit();
}

function debug_to_console( $data ) {
    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug: " . $data . "' );</script>";
    echo $output;
}

function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	
//copied from lib/functions	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");

		}
	}
//manage student submenu
	function find_all_students() {
		global $db;
		$query = "SELECT stuID,first_name, last_name, user_name, password " .
											 "FROM Student " ;
                                             
        $student_set = mysqli_query($db, $query);
                                     
		confirm_query($student_set);
		return $student_set;
	}
	
	function find_student_by_id($id) {
		
		global $db;
		
		$safe_id = mysqli_real_escape_string($db, $id);
		
		$query  = "SELECT * ";
		$query .= "FROM Student ";
		$query .= "WHERE stuID = '{$safe_id}' ";
		$query .= "LIMIT 1";
		$student_select = mysqli_query($db, $query);
		confirm_query($student_select);
		if($student = mysqli_fetch_assoc($student_select)) {
			return $student;
		} else {
			return null;
		}
	}
	
	function find_student_by_username($username) {
		
		global $db;
		
		$safe_name = mysqli_real_escape_string($db, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM Student ";
		$query .= "WHERE user_name = '{$safe_name}' ";
		$query .= "LIMIT 1";
		$student_select = mysqli_query($db, $query);
		confirm_query($student_select);
		if($student = mysqli_fetch_assoc($student_select)) {
			return $student;
		} else {
			return null;
		}
	}
	//manage quiz submenu
	function find_all_quiz() {
		global $db;
		$query = "SELECT quizID, courseID, title " .
											 "FROM Quiz " ;
                                             
        $quiz_set = mysqli_query($db, $query);
                                     
		confirm_query($quiz_set);
		return $quiz_set;
	}
	
	function find_quiz_by_id($id) {
		global $db;
		
		$safe_quizID = mysqli_real_escape_string($db, $id);
		
		$query  = "SELECT * ";
		$query .= "FROM Quiz ";
		$query .= "WHERE quizID = '{$safe_quizID}' ";
		
		$quiz_select = mysqli_query($db, $query);
		confirm_query($quiz_select);
		if($quiz = mysqli_fetch_assoc($quiz_select)) {
			return $quiz;
		} else {
			return null;
		}
	}
	//manage question submenu
	function find_all_question() {
		global $db;
		$query = "SELECT * " .
											 "FROM Question " ;
                                             
        $question_set = mysqli_query($db, $query);
                                     
		confirm_query($question_set);
		return $question_set;
	}
	
	function find_question_by_id($id) {
		global $db;
		
		$safe_questionID = mysqli_real_escape_string($db, $id);
		
		$query  = "SELECT * ";
		$query .= "FROM Question ";
		$query .= "WHERE questionID = '{$safe_questionID}' ";
		
		$question_select = mysqli_query($db, $query);
		confirm_query($question_select);
		if($question = mysqli_fetch_assoc($question_select)) {
			return $question;
		} else {
			return null;
		}
	}
	
	function find_all_answer($id) {
		global $db;
		$safe_questionID = mysqli_real_escape_string($db, $id);
		
		$query  = "SELECT * FROM answer where questionID = '" .$safe_questionID. "' order by answerID";
		
        $answer_set = mysqli_query($db, $query);
                                     
		confirm_query($answer_set);
		return $answer_set;
	}
	
	
	function find_answer_by_answerID($questionID,$answerID){
		global $db;
		
		$safe_questionID = mysqli_real_escape_string($db, $questionID);
		$safe_answerID = mysqli_real_escape_string($db, $answerID);
		$query = "select * from Answer WHERE questionID = '" .$questionID. "' AND answerID = '" .$answerID. "'";
		/*
		$query  = "SELECT * ";
		$query .= "FROM Answer ";
		$query .= "WHERE questionID = '{$safe_questionID}' AND answerID = '{$safe_answerID}'";
		*/
		$answer_select = mysqli_query($db, $query);
		confirm_query($answer_select);
		if($answer = mysqli_fetch_assoc($answer_select)) {
			return $answer;
		} else {
			return null;
		}
	}
		
	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	//http://stackoverflow.com/questions/5434648/z-scoresstandard-deviation-and-mean-in-php
	function standard_deviation($aValues)
	{
		$fMean = array_sum($aValues) / count($aValues);
		//print_r($fMean);
		$fVariance = 0.0;
		foreach ($aValues as $i)
		{
			$fVariance += pow($i - $fMean, 2);

		}       
		$size = count($aValues) - 1;
		return (float) sqrt($fVariance)/sqrt($size);
	}
	
	
	function median($arr){
    if($arr){
        $count = count($arr);
        sort($arr);
        $mid = floor(($count-1)/2);
        return ($arr[$mid]+$arr[$mid+1-$count%2])/2;
    }
    return 0;
}

?>
