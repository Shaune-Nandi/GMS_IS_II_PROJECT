<?php
session_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<title>GMS | Login</title>
    </head>
	

	<body>
		<?php include 'NavigationBar.php';?>
		<div class="container d-flex justify-content-center" style="margin-top:50px; margin-bottom:50px;">
			<div class="col-sm-8 rounded border border-dark">
				<div class="container">
					<div class="row">
						<div class="container">
							<form action="login.php" method="post"><br>
								<h1><center>Login</center></h1><br>
								<div class="form-group">
									<label for="Email">Email</label>
									<input class="form-control" type="email" name="Email" placeholder="Enter your email" id="Email" required>
								</div>
								<br>
								<div class="form-group">
									<label for="password">Password</label>
									<input class="form-control" type="password" name="Password"
										placeholder="Enter your password" id="password" required>
								</div>
								<br>
								<div class="form-group text-center">
									<input class="btn btn-primary" type="submit" value="Login" name="submit">
								</div><br>
							</form>





							<?php
								include 'Connectdb.php';

									
								// Now we check if the data from the login form was submitted, isset() will check if the data exists.
								if (!isset($_POST['Email'], $_POST['Password'])){
									// Could not get the data that should have been sent.
									die ('<center><p class="text-primary">Please fill both the Email and password field!</p></center>');
								}

								// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
								if ($stmt = $con->prepare('SELECT * FROM Users WHERE Email = ?')){
									// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
									$stmt->bind_param('s', $_POST['Email']);
									$stmt->execute();
									// Store the result so we can check if the account exists in the database.
									$stmt->store_result();

									if ($stmt->num_rows > 0){
										$stmt->bind_result($UserID, $Role, $FirstName, $LastName, $UserName, $Password, $Email, $Phone, $DateJoined);
										$stmt->fetch();
										// Account exists, now we verify the password.
										// Note: remember to use password_hash in your registration file to store the hashed passwords.
										if ($_POST['Password'] === $Password){
											// Verification success! User has loggedin!
											// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
											//session_regenerate_id();
											$_SESSION['loggedin'] = TRUE;
											$_SESSION['UserID'] = $UserID;
											$_SESSION['Role'] = $Role;
											$_SESSION['FirstName'] = $FirstName;
											$_SESSION['LastName'] = $LastName;
											$_SESSION['UserName'] = $UserName;
											$_SESSION['Password'] = $Password;
											$_SESSION['Email'] = $Email;
											$_SESSION['Phone'] = $Phone;
											if($_SESSION['Role'] === "Manager"){
												echo("
													<script>
														setTimeout(function(){
															location.href = './ManagerLanding.php';
														}, 000);
													</script>
												");
												//header('Location: ./ManagerLanding.php');
											}elseif ($_SESSION['Role'] === "Mechanic") {
												echo("
													<script>
														setTimeout(function(){
															location.href = './MechanicLanding.php';
														}, 000);
													</script>
												");
												//header('Location: ./MechanicLanding.php');
											}elseif ($_SESSION['Role'] === "Customer") {
												echo("
													<script>
														setTimeout(function(){
															location.href = './CustomerLanding.php';
														}, 000);
													</script>
												");
												//header('Location: ./CustomerLanding.php');
											}else{
												echo 'This role does not exist';
												echo("
													<script>
														setTimeout(function(){
															location.href = './index.php';
														}, 3000);
													</script>
												");
												//header("refresh:2; url=./index.php");
											}
										} 
										else{                
											echo '<center><p class="text-danger">Incorrect Password!</p></center>';
											//header( "refresh:1; url=login.php" );
											echo("
													<script>
														setTimeout(function(){
															location.href = './login.php';
														}, 3000);
													</script>
												");
										}
									} 
									else{
										echo '<center><p class="text-danger">Incorrect Email!</p></center>';
										//header( "refresh:1; url=login.php" );
										echo("
													<script>
														setTimeout(function(){
															location.href = './login.php';
														}, 3000);
													</script>
												");
									}
									$stmt->close();
								}
							?>



						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>

















































