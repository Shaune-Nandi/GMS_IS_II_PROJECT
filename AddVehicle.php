<?php
session_start();


if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['Role'] === "Customer"){
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>GMS | Add Vehicle</title>
    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <div class="container d-flex justify-content-center">
			<div class="col-sm-10 rounded border border-dark">
				<div class="container">
					<div class="row">
						<form action="AddVehicle.php" method="post"><br><br>
                            <h5><center>Vehicle details</center></h5>
                            <div class="form-group">
                                <label for="Registration">Vehicle Registration</label>
                                <input class="form-control" type="text" size="7" pattern="[A-Za-z]{3}[0-9]{3}[A-Za-z]{1}" title="Enter in this format: KDA399V)" name="Registration" placeholder="Enter your vehicle's number plate/registration. (e.g. KDA399V)" id="Registration" required>
                            </div><br>
                            <label for="VehicleType">Vehicle type</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="VehicleType" id="Car" value="Car" required>
                                <label class="form-check-label" for="Car">Car</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="VehicleType" id="Pick-up" value="Pick-up" required>
                                <label class="form-check-label" for="Pick-up">Pick-up</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="VehicleType" id="Van" value="Van" required>
                                <label class="form-check-label" for="Van">Van</label>
                            </div><br><br>                        
                            <div class="form-group">
                                <label for="VehicleMake">Vehicle Make</label>
                                <input list="VehicleMake" name="VehicleMake" class="list-group-item" placeholder="Select make" required>
                                <datalist id="VehicleMake">
                                    <option value="Toyota"> <option value="Nissan"> <option value="Mazda"> <option value="Ford"> <option value="Volkswagen"> <option value="BMW"> <option value="Mercedes Benz"> <option value="Honda"> <option value="Suzuki"> <option value="Mitstubishi"> <option value="Subaru"> <option value="Isuzu"> <option value="Audi"> 
                                </datalist>
                            </div><br>
                            <div class="form-group">
                                <label for="VehicleName">Vehicle Name</label>
                                <input class="form-control" type="text" name="VehicleName" placeholder="Enter your vehicle's name" id="VehicleName" required>
                            </div><br>
                            <div class="form-group">
                                <label for="VehicleYear">Year of Manufacture</label>
                                <input class="form-control" type="text" size="4" pattern="[19-20]{2}[0-9]{2}" title="Enter a valid year" name="VehicleYear" placeholder="Enter your Vehicle's year of manufacture" id="VehicleYear" required>
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
        echo '<br><br><br><center><h1>Customers only can view this page</h1></center>';
        header("refresh:4; url=./index.php");
    }
}else{
    echo '<br><br><br><center><h1>Please log in first</h1></center>';
    header("refresh:3; url=./Login.php");
}
?>

<?php



if (!isset($_POST['Registration'], $_POST['VehicleType'], $_POST['VehicleMake'], $_POST['VehicleName'], $_POST['VehicleYear'])){
    // Could not get the data that should have been sent.
    die ('<center><p class="text-primary">Please fill in all fields!</p></center>');
}
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

    $Registration = strtoupper($_POST['Registration']);
    $VehicleType = $_POST['VehicleType'];
    $VehicleMake = $_POST['VehicleMake'];
    $VehicleName = $_POST['VehicleName'];
    $VehicleYear = $_POST['VehicleYear'];

    $Email = $_SESSION['Email'];
    $UserID = $_SESSION['UserID'];


    $sql_e = "SELECT * FROM Vehicles WHERE Registration='$Registration'";
    $res_e = mysqli_query($con, $sql_e);

    $sql_f = "SELECT * FROM Users WHERE Email='$Email'";
    $res_f = mysqli_query($con, $sql_f);

    if (mysqli_num_rows($res_e) > 0){
        echo "<br><br><br><center><h1>This vehicle already exists in our database</h1></center>"; 
        header( "refresh:2; url=registration.html" );	
      }elseif(mysqli_num_rows($res_f) > 0){
        date_default_timezone_set("Africa/Nairobi");
        $Time = date("h:i:sa d-m-y");
        $stmt = $con->prepare("INSERT INTO Vehicles (Registration, VehicleType, VehicleMake, VehicleName, VehicleYear, OwnerID)
        VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("sssssi", $Registration, $VehicleType, $VehicleMake, $VehicleName, $VehicleYear, $UserID);
        $stmt->execute();
        echo"<br><br><br><center><h1>Vehicle added successfully</h1></center>";
        $stmt->close();
        $con->close();
        echo("
            <script>
                setTimeout(function(){
                    location.href = './CustomerLanding.php';
                }, 3000);
            </script>
        ");
      }

}
 
?>