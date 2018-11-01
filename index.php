<?php
	require 'core.inc.php';
	require 'connect.inc.php';
		
		$certificates=0;

	
	if(loggedin() && $_SESSION['login_type']=='student')
	{
		$firstname = getuserfield('first_name');
		
		?>
<html>
	<head>
		<title>College Zone</title>
		<link href='layout.css' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/png" href='favicon.png'>

	</head>
	
	<body>
	
	<div id='big_wrapper'>
			<div id='header'>
				<div id='logo'>
					<img src='logo.png' id='logo_img'>
				</div>
				<div id='menu'>
						<div class='item'><a href="logout.php" class='link'>Logout</a></div>
						<div class='item'><a href="preferences.php" class='link'>Edit Preferences</a></div>
						
						

				</div>
			</div>
			
			<div id='main'>
			
		
<style type='text/css'>
	.img_dp{
		float:right;
		width:200;
		height:220;
		margin:20px;
		border:1 px solid blue;
	}
</style>


<?php
	
?>

		<?php
			$sql="select profile_pic from students where app_no=".$_SESSION["app_no"];
			$result=mysqli_query($mysql_connect,$sql);
			$data=mysqli_fetch_assoc($result);
			if ($data["profile_pic"]!=""){
				?><img class='img_dp' src="<?php echo "uploads/".$data['profile_pic']/*.$data["profile_pic"];*/ ?>">
				<?php
			}
			else if($data["profile_pic"]==""){
				?>
				<img class='img_dp' src="upload1.jpg">
				<?php
			}

		?>

		<Table>
		<Tr>
		<td colspan=2><h1>Profile</h1></td>
		
		<tr>
		<td>Application number:</td>
		<td>
		<?php  $query='select app_no from students where app_no='.$_SESSION['app_no'];
			$result=mysqli_query($mysql_connect,$query);
			$data=mysqli_fetch_assoc($result);
			echo $data['app_no'];
		?>
		</td>
		<tr>
		<Td>Name:</td>
		<Td>
		<?php
		$query="select first_name,last_name from students where app_no=".$_SESSION["app_no"];
		if($conn=mysqli_query($mysql_connect,$query)){
			while($row=mysqli_fetch_assoc($conn)){
				echo $row['first_name']."  ".$row['last_name'];
			}
		}
		?>
		</td>
		<tr>
		<td>
		Email address:
		</td>
		<td>
		<?php
			$query="select email from students where app_no=".$_SESSION["app_no"];
			$result=mysqli_query($mysql_connect,$query);
			$data=mysqli_fetch_assoc($result);
			echo $data["email"];
		?>
		</td>
		<tr>
		<td>
		Phone number:
		</td>
		<td>
		<?php
			$query="select phone from students where app_no=".$_SESSION["app_no"];
			$result=mysqli_query($mysql_connect,$query);
			$data=mysqli_fetch_assoc($result);
			echo $data["phone"];
		?>
		</td>
		<tr>
		<form action="upload_file.php" method="post" enctype="multipart/form-data">
    	<td colspan=2>Select image to upload(in jpeg format) and 12th marksheet(in pdf format):</td>
		<tr>
		<td>
    	<input type="file" name="file[]" required="" multiple="multiple" class='txt'></td>
		<tr>
    	<td>
		<input type="file" name="file[]" required="" multiple="multiple" class='txt'></td>
		<tr>
    	<!--<input type="submit" value="Upload" name="new">-->
    	<td colspan=2 align='center'><input type="submit" value="Change" name="change" class='btn'></td>
		</form>
		<tr>
		<td colspan=2><hr></td>
		<tr>
		<td colspan=2><h2>Edit profile</h2></td>
		<form action="reset.php" method="post">
		<tr>
		<td>New password:</td><td><input type="password" name="reset_password" class='txt'></td>
		<tr>
		<td>New email address:</td><td><input type='text' name="reset_email" class='txt'></td>
		<tr>
		<td>New phone number:</td><td><input type='text' name="reset_phone" class='txt'></td>
		<tr>
		<td colspan=2 align='center'><input type="submit" name="reset" class='btn'></td>

	    </form>
		<tr>
		<Td>
	    <?php
	    	$query="select ms_12th from students where app_no=".$_SESSION["app_no"];
	    	if($result=mysqli_query($mysql_connect,$query))
			{
				$data=mysqli_fetch_assoc($result);
				$output=$data["ms_12th"];
				if($output!=""){
					?>
					<a href="<?php echo "uploads/".$output; ?>" target="_blank">download your marksheet for review</a>
					<?php
				}
			}
	    ?></td>
		</table>
		

			</div><!--main-->
		</div>
	</body>
</html>		
<?php
	}

	else if(loggedin() && $_SESSION['login_type']=='college'){
	?>

<!-- college -->
<html>
	<head>
		<title>College Zone</title>
		<link href='layout.css' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/png" href='favicon.png'>

	</head>
	
	<body>
	
	<div id='big_wrapper'>
			<div id='header'>
				<div id='logo'>
					<img src='logo.png' id='logo_img'>
				</div>
				<div id='menu'>
						<div class='item'><a href="logout.php" class='link'>Logout</a></div>
				</div>
			</div>
			
			<div id='main'>

	<?php
		$sql123="select app_no,first_name,last_name,alloted_branch from students where alloted_clg=".$_SESSION["app_no"];
		
		if($result=mysqli_query($mysql_connect,$sql123)){	
				?>

				<table>
						<tr>
							<th><h3>Name</h3></th>
							<th><h3>Branch allocated</h3></th>
							<th><h3>Documents</h3></th>
						</tr>

				<?php
				while($data=mysqli_fetch_assoc($result)){

					//$_SESSION['verify_app_no']=$data['app_no'];
					$sql="select allocated from students where app_no=".$data["app_no"];
					$sql12="select ms_12th from students where app_no=".$data["app_no"];

					$sql_result=mysqli_query($mysql_connect,$sql);
					if($sql_result12=mysqli_query($mysql_connect,$sql12)){
						$certificates=1;
					}

					$sql_data=mysqli_fetch_assoc($sql_result);
					//$sql_data12=mysqli_fetch_assoc($sql_result12);
					//$sql_rows=mysqli_num_rows($sql_result12);

					

					?>

					<tr>
						<?php
						if($certificates==1){
							?>
						<td><?php echo $data["first_name"]."  ".$data["last_name"]; ?></td>
						<td><?php echo $data["alloted_branch"]; ?></td>

						<?php  
							if($sql_data['allocated']!=2 && $certificates==1){
								?>
									<form  action="verify.php" method="post">
									<input type="hidden" name="data_app_no" value="$data['app_no']"> 
									<td><a href="<?php echo "uploads/".$sql_data['ms_12th']; ?>" target="_blank">download</a></td>
									<td><input type="submit" name="verify" value="verify" action="verify.php" method="post"></td>
									</form>
								<?php
							}
							else if($sql_data['allocated']==2 && $certificates==1){
								?>
								<form  action="verify.php" method="post">
									<input type="hidden" name="data_app_no" value="$data['app_no']"> 
									<td><a href="<?php echo "uploads/".$sql_data['ms_12th']; ?>" target="_blank">download</a></td>
									<td><input type="text" name="verified"  ></td>
									</form>
									<?php
							}
							
							

							}
							?>

					</tr>

					</table>


					<?php
				}

		}
		else {
			echo "error running query";
		}
?>
			</div><!--main-->
		</div>
	</body>
</html>		
<?php
	}
	else if(loggedin() && $_SESSION['login_type']=='admin'){
		
		?>
<html>
	<head>
		<title>College Zone</title>
		<link href='layout.css' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/png" href='favicon.png'>

	</head>
	
	<body>
	
	<div id='big_wrapper'>
			<div id='header'>
				<div id='logo'>
					<img src='logo.png' id='logo_img'>
				</div>
				<div id='menu'>
						<div class='item'><a href="logout.php" class='link'>Logout</a></div>
				</div>
			</div>
			
			<div id='main'>
			<a href="counselling.php">start the counselling</a>
			
			</div><!--main-->
		</div>
	</body>
</html>		
			
		<?php
	}
	else
	{
		include 'loginform.inc.php';
	}
?>
