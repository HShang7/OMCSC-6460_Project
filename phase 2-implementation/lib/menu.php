
			<div id="header">
                <div class="logo"><img src= "../image/gtonline_logo.gif" style="opacity:1.0;background-color:E9E5E2;" border="0" alt="", height = "100px", width = "820px", title="GT Online Logo"/>
            </div>
			
			<div class="nav_bar">
				<ul>    
                    <li><a href="manage_quiz.php" <?php if($current_filename=='manage_quiz.php') echo "class='active'"; ?>>Manage Quiz</a></li>                       
					<li><a href="manage_question.php" <?php if($current_filename=='manage_question.php') echo "class='active'"; ?>>Manage Question</a></li>  
                    <li><a href="manage_report.php" <?php if($current_filename=='manage_report.php') echo "class='active'"; ?>>Manage Report</a></li>  
                    <li><a href="manage_student.php" <?php if($current_filename=='manage_student.php') echo "class='active'"; ?>>Manage Student</a></li>                      
                    <li><a href="logout.php" <?php if($current_filename=='logout.php') echo "class='active'"; ?>>Log Out</a></li> 
					<li><a href="#">[These are tools for educator]</a>					
				</ul>
			</div>