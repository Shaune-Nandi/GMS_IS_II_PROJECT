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
        <title>GMS | Payment</title>
    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <?php include 'Connectdb.php';?><br>
        <div class="container d-flex justify-content-center" style="margin-top:50px; margin-bottom:50px;">
			<div class="col-sm-8 rounded border border-dark">
				<div class="container">
					<div class="row">
						<div class="container">
                            <?php
                                date_default_timezone_set("Africa/Nairobi");
                                $Time = date("h:i:sa d-m-y");
                                $Amount = $_POST['Amount'];
                                $UserID = $_SESSION['UserID'];
                                $Registration = $_POST['Registration'];
                                $CustRepairID = $_POST['CustRepairID'];                                    

                                if ($_POST['Pay'] == 'Pay') {
                                    $sql = mysqli_query($con, "INSERT INTO `payments` (`PaymentID`, `PaymentDate`, `PaymentAmount`, `UserID`, `Registration`, `CustRepairID`)
                                    VALUES (NULL, '$Time', '$Amount', '$UserID', '$Registration', '$CustRepairID')");

                                    $resultP1 = mysqli_query($con, "SELECT * FROM `CustRepairDetails` WHERE `CustRepairID` = '$CustRepairID'");
                                    $resP1 = mysqli_fetch_assoc($resultP1);

                                    $SpareID = $resP1['SpareID'];

                                    $resultP2 = mysqli_query($con, "SELECT * FROM `Spares` WHERE `SpareID` = '$SpareID'");
                                    $resP2 = mysqli_fetch_assoc($resultP2);

                                    $Cost = $resP2['Cost'];

                                    $resultP3 = mysqli_query($con, "SELECT * FROM `Payments` WHERE `CustRepairID` = '$CustRepairID'");

                                    $Counter = 1;
                                    $x = 0;

                                    while ($Counter <= mysqli_num_rows($resultP3)) {
                                        $resP3 = mysqli_fetch_assoc($resultP3);
                                        $CostP3 = $resP3['PaymentAmount'];
                                        $x = $x + $CostP3;
                                        $Counter = $Counter + 1;
                                    }

                                    if($Cost > $x){
                                        $sql1 = mysqli_query($con, "UPDATE `CustRepairDetails` SET `PaymentStatus` = 'PENDING', `PaidWhen` = '$Time' WHERE `CustRepairID` = '$CustRepairID'");
                                    }else{
                                        $sql2 = mysqli_query($con, "UPDATE `CustRepairDetails` SET `PaymentStatus` = 'DONE', `PaidWhen` = '$Time' WHERE `CustRepairID` = '$CustRepairID'");
                                    }             


                                    echo '<center>Payment successful</center>';
                                    echo '<br><center><a href="./CustomerLanding.php">Go to Main Menu</a></center>';

                                    mysqli_close($con);

                                }else{
                                    echo 'Payment canceled';

                                    mysqli_close($con);                
                                    header("refresh:3; url=./PayNow.php");
                                }
                            
                            ?>

						</div>
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

