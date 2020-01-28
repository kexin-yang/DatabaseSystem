<?php
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/about.php":
			$CURRENT_PAGE = "About"; 
			$PAGE_TITLE = "Workify for students";
			break;
		case "/contact.php":
			$CURRENT_PAGE = "Contact"; 
			$PAGE_TITLE = "Workify for employers";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Welcome to my homepage!";
	}
?>