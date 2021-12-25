<?php
session_start();

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

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
        <title>GMS | Repair Car</title>
    </head>

    <body>
    <?php include 'NavigationBar.php';?><br>
    <?php include 'Connectdb.php';?><br>




        <div class="container d-flex justify-content-center">
			<div class="col-sm-10 rounded border border-dark">
				<div class="container">
					<div class="row">
                        <?php
                            if (isset($_POST['JobType'], $_POST['RepairDescription'])){
                                $Registration = strtoupper($_POST['Registration']);
                                $VehicleType = $_POST['VehicleType'];
                                $VehicleMake = $_POST['VehicleMake'];
                                $VehicleName = $_POST['VehicleName'];
                                $VehicleYear = $_POST['VehicleYear'];
                                $UserID = $_SESSION['UserID'];
                                $JobType = $_POST['JobType'];
                                $RepairDescription = $_POST['RepairDescription'];
                                $CustJobTaken = "NO";
                                $CustJobDone = "NO";
                                $PaymentStatus = "NO";
                                $RndToken = generateRandomString() . $UserID;

                                date_default_timezone_set("Africa/Nairobi");
                                $Time = date("h:i:sa d-m-y");
                                $stmt = $con->prepare("INSERT INTO CustRepairDetails (RepairCust, Registration, CustJobType, CustRepairDesc, CustToken, CustDate, CustJobTaken, CustJobDone, PaymentStatus)
                                VALUES (?,?,?,?,?,?,?,?,?)");
                                $stmt->bind_param("issssssss", $UserID, $Registration, $JobType, $RepairDescription, $RndToken, $Time, $CustJobTaken, $CustJobDone, $PaymentStatus);
                                $stmt->execute();
                                echo"<br><center><h1>Your repair details have been added successfully</h1></center>";
                                $stmt->close();
                                $con->close();
                                echo("
                                        <script>
                                            setTimeout(function(){
                                                location.href = './CustomerLanding.php';
                                            }, 3000);
                                        </script>
                                    ");

                            }else{
                                echo "<br><center><h1>Please fill in all fields!</h1></center>";
                                echo("
                                        <script>
                                            setTimeout(function(){
                                                location.href = './RepairCar2.php';
                                            }, 3000);
                                        </script>
                                    ");
                            }

                        ?>
						






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

