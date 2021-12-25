<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['Role'] === "Mechanic"){
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<title>GMS | Mechanic Take Job</title>

    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <div class="container rounded border border-dark"><br>
            <div class="container">
                <div class="row">
                    <?php include 'Connectdb.php';?>

                    <?php
                        //From the table/form from MechanicJob.php
                        $CustRepairID = $_POST['CustRepairID'];
                        $CustJobType = $_POST['CustJobType'];
                        $CustRepairDesc = $_POST['CustRepairDesc'];
                        $CustDate = $_POST['CustDate'];
                        $Registration = $_POST['Registration'];
                        //From the session of the current user [UserID: ### (Mechanic)]
                        $TakenByUserID = $_SESSION['UserID'];

                        date_default_timezone_set("Africa/Nairobi");
                        $Time = date("h:i:sa d-m-y");

                        $result = mysqli_query($con, "SELECT * FROM CustRepairDetails WHERE CustJobTaken = 'YES' AND TakenByUserID = '$TakenByUserID' AND CustJobDone = 'NO'");
                        $result1 = mysqli_query($con, "SELECT * FROM Vehicles WHERE Registration = '$Registration'");

                        if (mysqli_num_rows($result) < 1)

                            {
                                //1st we need to update the table to show that the job has been taken once the user has pressed take job from MechanicJob.php.
                                $sql_b = "UPDATE CustRepairDetails SET CustJobTaken='YES', CustJobTakenWhen='$Time', TakenByUserID='$TakenByUserID' WHERE CustRepairID='$CustRepairID'";
                                $res_b = mysqli_query($con, $sql_b);

                                $res = mysqli_fetch_assoc($result);
                                $res1 = mysqli_fetch_assoc($result1);
                                echo '
                                    
                                    <form action="MechanicTakeJob2.php" method="POST">
                                        <div class="row">    
                                            <div class="col-sm-3 bg-light">
                                                <center><h5>Vehicle Details</h5></center>
                                                <h5><input type="text" class="form-control-plaintext" value="' . $res1['Registration'] . '" readonly name="Registration"></input></h5>
                                                <hr>
                                                <h6>Type:</h6>
                                                <p><input type="text" class="form-control-plaintext" value="' . $res1['VehicleType'] . '" readonly name="VehicleType"></input></p>
                                                <hr>
                                                <h6>Make:</h6>
                                                <p><input type="text" class="form-control-plaintext" value="' . $res1['VehicleMake'] . '" readonly name="VehicleMake"></input></p>
                                                <hr>                                                
                                                <h6>Name:</h6>
                                                <p><input type="text" class="form-control-plaintext" value="' . $res1['VehicleName'] . '" readonly name="VehicleName"></input></p>
                                                <hr>
                                                <h6>Year:</h6>
                                                <p><input type="number" class="form-control-plaintext" value="' . $res1['VehicleYear'] . '" readonly name="VehicleYear"></input></p>
                                                <hr>
                                            </div>


                                            <div class="col-sm-9">
                                                <center><h5>Repair Details</h5></center>
                                                <div class="form-group">
                                                    <label for="CustRepairID">Job Number:</label>
                                                    <input type="number" class="form-control" value="' . $_POST['CustRepairID'] . '" readonly name="CustRepairID">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="CustJobType">Repair Type:</label>
                                                    <input type="text" class="form-control" value="' . $_POST['CustJobType'] . '" readonly name="CustJobType">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="CustRepairDesc">Description:</label>
                                                    <textarea class="form-control" readonly name="CustRepairDesc" rows = "3">' . $_POST['CustRepairDesc'] . '</textarea>
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="SpareName">Spare Name:</label>';
                                                    $result3 = mysqli_query($con, "SELECT * FROM Spares");
                                                    $res3 = mysqli_fetch_assoc($result3);
                                                    $Counter = 1;
                                                    while ($Counter <= 10) {
                                                        $ppp = $res3['SpareName'];
                                                        echo $ppp;
                                                        $Counter = $Counter + 1;
                                                    }


                                                    echo '<input type="text" class="form-control" name="SpareName">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="Quantity">Quantity:</label>
                                                    <input type="number" class="form-control" name="Quantity">
                                                </div><br>
                                                <div class="form-group text-center">
                                                    <input class="btn btn-primary" type="submit" value="Continue" name="submit">
                                                    <input class="btn btn-danger" type="submit" value="Decline" name="submit">
                                                </div>
                                            </div>                                            
                                        </div>
                                    </form>                              
                                ';


                                mysqli_free_result($result);
                                mysqli_close($con);
                            }
                            else
                                {
                                    $res = mysqli_fetch_assoc($result);
                                    $res1 = mysqli_fetch_assoc($result1);

                                    $Regg = $res['Registration'];
                                    $result2 = mysqli_query($con, "SELECT * FROM Vehicles WHERE Registration = '$Regg'");
                                    $res2 = mysqli_fetch_assoc($result2);

                                    echo '
                                    <form action="MechanicTakeJob2.php" method="POST">
                                    <div class="row">
                                        <div class="col-sm-3 bg-light">
                                            <center><h5>Vehicle Details</h5></center>
                                            <h5><input type="text" class="form-control-plaintext" value="' . $res2['Registration'] . '" readonly name="Registration"></input></h5>
                                            <hr>
                                            <h6>Type:</h6>
                                            <p><input type="text" class="form-control-plaintext" value="' . $res2['VehicleType'] . '" readonly name="VehicleType"></input></p>
                                            <hr>
                                            <h6>Make:</h6>
                                            <p><input type="text" class="form-control-plaintext" value="' . $res2['VehicleMake'] . '" readonly name="VehicleMake"></input></p>
                                            <hr>                                                
                                            <h6>Name:</h6>
                                            <p><input type="text" class="form-control-plaintext" value="' . $res2['VehicleName'] . '" readonly name="VehicleName"></input></p>
                                            <hr>
                                            <h6>Year:</h6>
                                            <p><input type="number" class="form-control-plaintext" value="' . $res2['VehicleYear'] . '" readonly name="VehicleYear"></input></p>
                                            <hr>
                                        </div>


                                        <div class="col-sm-9">
                                            <center><h5 class="text-danger">First finish the job displayed below before you can select another job: <br> [Repair Job Number: ' . $res['CustRepairID'] . ']</h5></center><br><br>
                                            <center><h5>Repair Details</h5></center>
                                            <div class="form-group">
                                                <label for="CustRepairID">Job Number:</label>
                                                <input type="number" class="form-control" value="' . $res['CustRepairID'] . '" readonly name="CustRepairID">
                                            </div><br>
                                            <div class="form-group">
                                                <label for="CustJobType">Repair Type:</label>
                                                <input type="text" class="form-control" value="' . $res['CustJobType'] . '" readonly name="CustJobType">
                                            </div><br>
                                            <div class="form-group">
                                                <label for="CustRepairDesc">Description:</label>
                                                <textarea class="form-control" readonly name="CustRepairDesc" rows = "3">' . $res['CustRepairDesc'] . '</textarea>
                                            </div><br>
                                            <div class="form-group">
                                                <label for="SpareName">Spare Name:</label>
                                                <input list="SpareName" name="SpareName" class="list-group-item" placeholder="Select spare part" required>
                                                <datalist id="SpareName">';

                                                $result3 = mysqli_query($con, "SELECT * FROM Spares");
                                                    $Counter = 1;
                                                    while ($Counter <= mysqli_num_rows($result3)) {
                                                        $res3 = mysqli_fetch_assoc($result3);
                                                        $ppp = $res3['SpareName'];
                                                        echo '<option value="' . $ppp . '">';
                                                        $Counter = $Counter + 1;
                                                    }
                                                echo '</datalist>
                                            </div><br>
                                            <div class="form-group">
                                                <label for="Quantity">Quantity:</label>
                                                <input type="number" class="form-control" name="Quantity" required>
                                            </div><br>
                                            <div class="form-group text-center">
                                                <input class="btn btn-primary" type="submit" value="Continue" name="submit">
                                                <button class="btn btn-danger">Decline</button>
                                            </div>
                                        </div>                                            
                                    </div>
                                </form>
                                    ';


                                    mysqli_free_result($result);
                                    mysqli_close($con);

                                }
        
                    ?>  
                </div>
            </div><br>
        </div><br><br>
    





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
        echo '<br><br><br><center><h1>Mechanics only can view this page</h1></center>';
        header("refresh:4; url=./index.php");
    }
}else{
    echo '<br><br><br><center><h1>Please log in first</h1></center>';
    header("refresh:3; url=./Login.php");
}
?>