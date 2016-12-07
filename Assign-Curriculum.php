<!Doctype html>
<head>
	<meta charset="utf-8"> 

	<!--- this is for bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 900px)' href='css/mobile.css' />
	<link rel="stylesheet" href="CSS/style.css">

	<title>CPCA Enroll Participant</title>
	<?php
		
		session_start();
	
		if (!isset($_SESSION["username"]) ){
			header('Location: index.php');
			echo "hello";
		}
	  
	  
		// Connecting, selecting database
		$dbconn = pg_connect("host=10.10.7.195 port=5432 dbname=cappingdb user=postgres password=admin")
			or die('Could not connect: ' . pg_last_error());
			
			echo "<h1> THIS DOES NOT WORK </h1>";
		
		if( isset($_POST['curriculum_select']) && isset($_POST['f_name']) && isset($_POST['l_name'])){
			
			$first_name = $_POST['f_name'];
			$last_name = $_POST['l_name'];
			$select_value = $_POST['curriculum_select'];
			
			$query1 = 'SELECT * FROM referrals WHERE ref_f_name = "'.$first_name.'" AND ref_l_name = '.$last_name;
			$query2 = 'SELECT cid FROM curriculum WHERE curriculum_name = '.$select_value;
			
			echo $query1;
			
			$p_num_result = pg_query($query1) or die('Query failed: ' . pg_last_error());
			$cid_result = pg_query($query2) or die('Query failed: ' . pg_last_error());
			
			echo $p_num_result;
			echo $cid_result;
			
			$p_num = pg_fetch_array($p_num_result);
			$cid = pg_fetch_array($cid_result);
			
			echo $p_num;
			echo $cid;
			
			$query = 'UPDATE participants SET cid = '.$cid.' WHERE p_num = '.$p_num;
			
			pg_query($query) or die('Query failed: ' . pg_last_error());
			
		}
	?>
</head>
<body>
<!-- Top left Logo -->
	<div class="page-header">
		<h1><a class="home-button" href="homepage.php">CPCA</a></h1>
	</div>
	
<nav class="navbar navbar-default CPCA_navbar">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Report Card</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav navbar-right">
					<li><a href="admin-tools.php">Admin Tools</a></li>
					<li><a href="attendance-reports.php">Reports</a></li>
					<li><a href="participant-search.php">Search</a></li>
					<li><a href="index.php">Log out</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav> <!-- end of navbar-->
<div class = "container">
<div class="jumbotron login_panel">
<div class= "login_wrapper">
<!-- css div's for jumbotron work best --> 
<!-- I never wanted a problem with lining up a dropdown.... i'm sad -->
<!-- this launches another php file --->
  <form class="form-horizontal" action="Assign-Curriculum.php" method="post">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control input-lg" placeholder="first name" name="f_name" id="attendance-f_name" oninput="validateAlpha('attendance-f_name');">
				</div>
				<div class="input-group">
					<input type="text" class="form-control input-lg" placeholder="last name" name="l_name" id="attendance-l_name" oninput="validateAlpha('attendance-l_name');">
				</div>
			<label for="sel1">Select A Curriculum:</label> 
				<select class="form-control" id="sel1" name="curriculum_select">
					<?php
						

						// Performing SQL query
						$query = 'SELECT * FROM public.curriculum ORDER BY cid ASC ';
						
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());
						
					while($row = pg_fetch_array($result)){
						echo "<option value='".$row['curriculum_name']."'>".$row['curriculum_name']."</option>";
					}
					
					?>
				</select>
		</div>
	</div>
  </div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="testName" class="btn btn-default">Submit</button>
	  <!-- needs apache/php link to database -->
	  <!-- needs to send user back to login once new password is created -->
	  <!-- style is messed up will fix tomorrow --> 
    </div>
  </div>
  </form>
 </div>
</div>
</body>
</html>


