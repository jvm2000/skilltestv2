<?php
	///studentlist.php
	include("util/dbhelper.php");
	session_start();
	if($_SESSION['user']==null) header("location:index.php?message=LOGIN PROPERLY")
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="ie-edge,chrome=1.0,safari">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="assets/css/w3.css">
	</head>
	<body>
		<div class="w3-blue w3-padding-large w3-card-2">
			<h3>STUDENT</h3>
			<a href="logout.php" class="w3-right w3-button">LOG-OUT</a>
			<br>
			<br>
			
		</div>
		<div class="w3-padding-large">
			<button class="w3-button w3-blue w3-right" onclick="clearitem();modalcontrol('mymodal','block')">+ADD</button>
			<br><br>
			<table class="w3-table-all w3-card-2 w3-animate-top">
				<?php
					$header=['idno','lastname','firstname','course','level','action'];
					echo "<tr>";
						foreach($header as $h){
							echo "<th>".strtoupper($h)."</th>";
						}
					echo "</tr>";
					$list=getall('student');
					foreach($list as $student){
						echo "<tr>";
							echo "<td>".$student['idno']."</td>";
							echo "<td>".$student['lastname']."</td>";
							echo "<td>".$student['firstname']."</td>";
							echo "<td>".$student['course']."</td>";
							echo "<td>".$student['level']."</td>";
							echo "<td>";
								echo "<button onclick=removeitem(".$student['id'].")>&times;</button>";
								echo "&nbsp;";
								echo "<button onclick=updateitem('".$student['idno']."','".$student['lastname']."','".$student['firstname']."','".$student['course']."','".$student['level']."')>&#9998;</button>";
								
							echo "</td>";
						echo "</tr>";
					}

				?>
			</table>
		</div>
		<div class="w3-modal" id="mymodal">
			<div class="w3-modal-content w3-animate-top">
				<div class="w3-container w3-blue">
					<h3>STUDENT INFO</h3>
					<span class="w3-button w3-display-topright" onclick="modalcontrol('mymodal','none')">&times;</span>
				</div>
				<div class="w3-padding-large">
					<form action="savestudent.php" method="post">
						<input type="hidden" name="id" id="id">
					<p>
						<label><b>IDNO</b></label>
						<input type="number" id="idno" name="idno" class="w3-input w3-border">
					</p>
					<p>
						<label><b>LASTNAME</b></label>
						<input type="text" id="lastname" name="lastname" class="w3-input w3-border">
					</p>
					<p>
						<label><b>FIRSTNAME</b></label>
						<input type="text" id="firstname" name="firstname" class="w3-input w3-border">
					</p>
					<p>
						<label><b>COURSE</b></label>
						<input type="text" id="course" name="course" class="w3-input w3-border">
					</p>
					<p>
						<label><b>LEVEL</b></label>
						<input type="number" id="level" name="level" class="w3-input w3-border">
					</p>
					<p class="w3-center">
						<?php
							if(isset($_GET['message'])){
								echo $_GET['message'];
							}
						?>
					</p>
					<p>
						<input type="submit" name="save" value="&#128427; SAVE" class="w3-button w3-blue w3-right">
						<br><br>
					</p>
				</form>
				</div>
			</div>
		</div>
		<script>

			function modalcontrol(modalname,action){
				document.getElementById('mymodal').style.display=action;
			}
			
			function removeitem(id){
				var ok=confirm("Do you want to delete this student?");
				if(ok)
					location.href="deletestudent.php?id="+id;
				console.log('remove');
			}
			
			function updateitem(idno,lastname,firstname,course,level){
				document.getElementById('idno').value=idno;
				document.getElementById('lastname').value=lastname;
				document.getElementById('firstname').value=firstname;
				document.getElementById('course').value=course;
				document.getElementById('level').value=level;
				modalcontrol('mymodal','block');
			}

			function clearitem(){
				var getId=document.getElementById('idno');
				var getLastname=document.getElementById('lastname');
				var getFirstname=document.getElementById('firstname');
				var getCourse=document.getElementById('course');
				var getLevel=document.getElementById('level');

				if(getId.value!="" && getLastname.value!="" && getFirstname.value!="" && getCourse.value!="" && getLevel!=""){
					getId.value="";
					getLastname.value="";
					getFirstname.value="";
					getCourse.value="";
					getLevel.value="";
				}
			}
		</script>
	</body>
</html>



