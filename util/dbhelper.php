<?php	
	//database abstraction
	//define the database connection config
	$hostname="127.0.0.1";
	$username="root";
	$password="";
	$database="skill";
	
	function dbconnect(){
		global $hostname,$username,$password,$database;
		return mysqli_connect($hostname,$username,$password,$database);
	}
	
	function getall($table){
		$rows=array();
		$sql="SELECT * FROM `$table`";
			$conn=dbconnect();
			$query=mysqli_query($conn,$sql) or die("SQL Error");
			while($row=mysqli_fetch_assoc($query)){
				array_push($rows,$row);
			}
			mysqli_close($conn);
		return $rows;
	}
	function getrecord($table,$fields,$data){
		$row=null;
		$flds=array();
		if(count($fields)==count($data)){
			//"SELECT * FROM `USER` WHERE `USERNAME`='admin' AND `PASSWORD`='XXX'"
			for($i=0;$i<count($fields);$i++){
				array_push($flds,"`".$fields[$i]."`='".$data[$i]."'");
			}
			$fld=implode(" AND ",$flds);
			$sql="SELECT * FROM `$table` WHERE $fld";
			
			//
			$conn=dbconnect();
			$query = mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($query);
			mysqli_close($conn);
		}
		return $row;
	}
	
	
	function addrecord($table,$fields,$data){
		$ok=false;
		if(count($fields)==count($data)){
			//INSERT INTO `user`(`username`,`password`) VALUES('DENNIS','DURANO')
			$flds=implode("`,`",$fields);
			$dta=implode("','",$data);
			$sql="INSERT INTO `$table`(`$flds`) VALUES ('$dta')";
			$conn=dbconnect();
			$query = mysqli_query($conn,$sql);
			mysqli_close($conn);
			$ok=true;
		}
		return $ok;
	}
	function updaterecord($table,$fields,$data){
		$ok=false;
		$flds=array();
		if(count($fields)==count($data)){
			//UPDATE `USER` SET `password`='ABCD' WHERE `username`='admin';
			//UPDATE `STUDENT` SET `lastname`='durano',`firstname`='dennis',`course`='bscpe',`level`='4' WHERE `idno`='0001';
			for($i=1;$i<count($fields);$i++){
				array_push($flds,"`".$fields[$i]."`='".$data[$i]."'");
			}
			$fld=implode(",",$flds);
			$sql="UPDATE `$table` SET $fld WHERE `$fields[0]`='$data[0]'";
			echo $sql;
			$conn=dbconnect();
			$query = mysqli_query($conn,$sql);
			mysqli_close($conn);
			$ok=true;
		}
		return $ok;
	}
	function deleterecord($table,$fields,$data){
		$ok=false;
		$flds=array();
		if(count($fields)==count($data)){
			//"SELECT * FROM `USER` WHERE `USERNAME`='admin' AND `PASSWORD`='XXX'"
			for($i=0;$i<count($fields);$i++){
				array_push($flds,"`".$fields[$i]."`='".$data[$i]."'");
			}
			$fld=implode(" AND ",$flds);
			$sql="DELETE FROM `$table` WHERE $fld";
			//
			$conn=dbconnect();
			$query = mysqli_query($conn,$sql);
			$okey=true;
			mysqli_close($conn);
		}
		return $okey;
	}
	
?>


