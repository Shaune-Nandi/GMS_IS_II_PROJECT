<?php
session_start();


if (!isset($_SESSION['loggedin'])) {
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>GMS | Registration</title>
    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <div class="container d-flex justify-content-center">
			<div class="col-sm-10 rounded border border-dark">
				<div class="container">
					<div class="row">
						<form action="Registration.php" method="post"><br><br>
                            <h5><center>Personal Details</center></h5>
                            <div class="form-group">
                                <label for="FirstName">First Name</label>
                                <input class="form-control" type="text" name="FirstName" placeholder="E.g. John" id="FirstName" required>
                            </div><br>
                            <div class="form-group">
                                <label for="LastName">Last Name</label>
                                <input class="form-control" type="text" name="LastName" placeholder="E.g. Doe" id="LastName" required>
                            </div><br>
                            <div class="form-group">
                                <label for="UserName">UserName</label>
                                <input class="form-control" type="text" name="UserName" id="UserName" required>
                            </div><br>
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input class="form-control" type="text" name="Phone" placeholder="E.g. +254712345678" id="Phone" required>
                            </div><br>
                            <div class="form-group">
								<label for="Email">Email</label>
								<input class="form-control" type="email" name="Email" placeholder="E.g. johndoe@gmail.com" id="Email" required>
							</div><br>
							<div class="form-group">
								<label for="password">Password</label>
								<input class="form-control" type="password" name="Password" placeholder="Enter your password" id="password" required>
							</div><br><br>
                            <div class="form-group text-center">
                                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                            </div><br>                                
						</form>
					</div>
				</div>
			</div>
		</div>
    





        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->
    </body>
</html>




<?php

}else{
    echo '<br><br><br><center><h1>You are already logged in. Please Log out first to register as a new customer</h1></center>';
    echo '<br><center><h1>Please Log out first to register as a new customer</h1></center>';
    header("refresh:3; url=./Login.php");
}
?>




<?php



// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'GMSdb';

    
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


// If there is an error with the connection, stop the script and display the error.
if (mysqli_connect_errno()){
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}else{

    $Role = "Customer";
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $UserName = $_POST['UserName'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];


    $sql_f = "SELECT * FROM Users WHERE Email='$Email'";
    $res_f = mysqli_query($con, $sql_f);

    if(mysqli_num_rows($res_f) <= 0){
        date_default_timezone_set("Africa/Nairobi");
        $Time = date("h:i:sa d-m-y");
        $stmt = $con->prepare("INSERT INTO Users (Role, FirstName, LastName, UserName, Password, Email, Phone, DateJoined)
        VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $Role, $FirstName, $LastName, $UserName, $Password, $Email, $Phone, $Time);
        $stmt->execute();
        echo"<br><br><br><center><h1>Regisration Successful</h1></center>";
        $stmt->close();
        $con->close();
        echo("
            <script>
                setTimeout(function(){
                    location.href = './Login.php';
                }, 3000);
            </script>
        ");
      }
    }


 
?>


