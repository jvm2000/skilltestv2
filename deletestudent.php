<?php
	//delete student
	include("util/dbhelper.php");
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		
		$ok=deleterecord('student',['id'],[$id]);
		if($ok)
			header("location:studentlist.php?message=STUDENT DELETED");
		else
			header("location:studentlist.php?message=ERROR DELETING ");
	}
?>