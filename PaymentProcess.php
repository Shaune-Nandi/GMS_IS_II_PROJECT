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
							<form action="PaymentProcess1.php" method="post"><br>
                                <center><h5>Payment Details</h5></center>


                                <?php
                                    $Registration = $_POST['Registration'];
                                    $CustRepairID = $_POST['CustRepairID'];                                    
                                    $UserID = $_SESSION['UserID'];

                                    date_default_timezone_set("Africa/Nairobi");
                                    $Time = date("h:i:sa d-m-y");

                                    $result = mysqli_query($con, "SELECT * FROM CustRepairDetails WHERE CustRepairID = '$CustRepairID'");
                                    $res = mysqli_fetch_assoc($result);
                                    $SpareID = $res['SpareID'];

                                    $result1 = mysqli_query($con, "SELECT * FROM Spares WHERE SpareID = '$SpareID'");
                                    $res1 = mysqli_fetch_assoc($result1);
                                    $Cost = $res1['Cost'];

                                    $result2 = mysqli_query($con, "SELECT * FROM Payments WHERE CustRepairID = '$CustRepairID' AND Registration = '$Registration'");
                                    $res2 = mysqli_fetch_assoc($result2);
                                ?>


                                <div class="form-group">
                                    <input type="hidden" class="form-control" value="<?php echo $_POST['CustRepairID']; ?>" readonly name="CustRepairID">

                                    <label for="Registration">Vehicle Registration:</label>
                                    <input type="text" class="form-control" value="<?php echo $Registration; ?>" readonly name="Registration">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="Cost">Total cost for the repair:</label>
                                    <input type="number" class="form-control" value="<?php echo $res1['Cost'] ?>" readonly name="Cost">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="Amount">Pay Amount: <span class="text-danger">[*** Remaining balance to be paid is: <?php 
                                    
                                        if (mysqli_num_rows($result2) >= 1){
                                            $Counter = 1;
                                            $x = 0;
                                            $result1_1 = mysqli_query($con, "SELECT * FROM Spares WHERE SpareID = '$SpareID'");
                                            $result1_2 = mysqli_query($con, "SELECT * FROM Payments WHERE CustRepairID = '$CustRepairID'");

                                            while ($Counter <= mysqli_num_rows($result2)) {
                                                $res1_2 = mysqli_fetch_assoc($result1_2);
                                                $Cost1_2 = $res1_2['PaymentAmount'];
                                                $x = $x + $Cost1_2;
                                                $Counter = $Counter + 1;
                                            }
                                            echo '<strong>KSH ' .$res1['Cost'] - $x . '</strong>';

                                        }else{
                                            echo '<strong>KSH ' .$res1['Cost'] . '</strong>';
                                        }
                                    
                                    ?> ***]</span> </label>
                                    <input type="number" class="form-control" id="Amount" name="Amount" min="0">
                                </div>
                                <br>
								<br>
                                <div class="form-group text-center">
                                    <input class="btn btn-success" type="submit" value="Pay" name="Pay">
                                    <input class="btn btn-danger" type="submit" value="Cancel" name="Pay">
                                </div>
                                <br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
        


        <?php
            mysqli_free_result($result);
            mysqli_close($con);
        ?>                






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

