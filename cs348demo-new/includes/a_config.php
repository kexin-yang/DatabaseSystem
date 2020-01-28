<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/student.php":
			$CURRENT_PAGE = "Student"; 
			$PAGE_TITLE = "Workify for students";
			break;
		case "/employer.php":
			$CURRENT_PAGE = "Employer"; 
			$PAGE_TITLE = "Workify for employers";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Workify";
	}
?>