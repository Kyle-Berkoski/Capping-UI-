<html>
<head>

</head>


<body>
<?php
session_start();
	
	if (!isset($_SESSION["username"]) ){
		header('Location: index.php');
		echo "hello";
	}
	
	$dbconn = pg_connect("host=10.10.7.195 port=5432 dbname=cappingdb user=postgres password=admin")
    or die('Could not connect: ' . pg_last_error());
	
	$time = $_POST['currTime'];
	
	
	$eid = $_POST['eidPicked'];
	
	$lid = $_POST['lidPicked'];
	
	
	$class_id = $_SESSION['classid_tools']; //not editing
	
	$c_subject = $_SESSION['classsubjecttools'] ; //user not editing
	
	
	$cidquery = "SELECT cid FROM classes_scheduled WHERE class_id = '$class_id '";
		$cidresult = pg_query($cidquery) or die('Query failed: ' . pg_last_error());
		$cidrow = pg_fetch_array($cidresult );
		
		$cid = $cidrow['cid'] ;
		

		
		
	echo $class_id;
	echo $cid ;
	echo $eid ;
	echo $lid;
	echo $c_subject;
	echo $time;
	
	
	$submitclasschange = "UPDATE classes_scheduled SET cid='$cid ', eid='$eid', location_id = '$lid', c_subject = '$c_subject', date_time_schedules = '$time' WHERE class_id = '$class_id' ";
		
		$submitresult = pg_query($submitclasschange);
		echo "class updated";
			
	
	
	
	?>
	
	
	
	
	
	
	
	
	</body>
	
	
	</html>