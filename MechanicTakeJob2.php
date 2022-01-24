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
        <?php include 'Connectdb.php';?><br>

        <?php
            $TakenByUserID = $_SESSION['UserID'];

            $CustRepairID = $_POST['CustRepairID'];
            $CustJobType = $_POST['CustJobType'];
            $CustRepairDesc = $_POST['CustRepairDesc'];
            $SpareName = $_POST['SpareName'];
            $Quantity = $_POST['Quantity'];
            $Registration = $_POST['Registration'];

            $result = mysqli_query($con, "SELECT * FROM CustRepairDetails WHERE CustJobTaken = 'YES' AND TakenByUserID = '$TakenByUserID' AND CustJobDone = 'NO'");
            $result11 = mysqli_query($con, "SELECT * FROM Spares WHERE SpareName = '$SpareName'");
            $res11 = mysqli_fetch_assoc($result11);
            $SpareID = $res11['SpareID'];
            $SpareCost = $res11['Cost'];



            if (mysqli_num_rows($result) == 1)

            {
                if ($_POST['submit'] == 'Continue') {            

                    echo 'The mechanic ID who has taken the job (TakenByUserID): ' . $TakenByUserID . '<br>';
                    echo 'The job ID/Number of the repair job (CustRepairID): ' . $CustRepairID . '<br>';

                    date_default_timezone_set("Africa/Nairobi");
                    $Time = date("h:i:sa d-m-y");

                    if (!mysqli_query($con, "UPDATE CustRepairDetails SET CustJobDone='YES', CustJobRepairedWhen='$Time', PaymentStatus='PENDING', SpareID='$SpareID' WHERE CustRepairID='$CustRepairID'")) {
                        echo "Error updating record: " . mysqli_error($con);
                    }

                    $result4 = mysqli_query($con, "SELECT * FROM `spares` WHERE `SpareName` = '$SpareName'");
                    $res4 = mysqli_fetch_assoc($result4);
                    $x = $res4['SpareID'];


                    $sql1 = mysqli_query($con, "INSERT INTO `sparedetails` (`SpareDetailsID`, `SpareDetailsName`, `SpareTblID`, `UsedWhen`, `UsedByCar`)
                                VALUES (NULL, '$SpareName', '$x', '$Time', '$Registration');");

                    
                    mysqli_free_result($result);
                    mysqli_close($con);

                    header("refresh:3; url=./MechanicLanding.php");

                }else{
                    echo 'You have declined this job';



                    $sql = "UPDATE CustRepairDetails SET CustJobTaken='NO', CustJobDone='NO', CustJobRepairedWhen=NULL, CustJobTakenWhen=NULL, TakenByUserID=NULL WHERE CustRepairID='$CustRepairID'";

                    if (!mysqli_query($con, $sql)){
                    echo "Error updating record: " . mysqli_error($con);
                    }
                    
                    mysqli_free_result($result);
                    mysqli_close($con);

                    header("refresh:3; url=./MechanicJob.php");
                }
            }
                                            
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
        echo '<br><br><br><center><h1>Mechanics only can view this page</h1></center>';
        header("refresh:4; url=./index.php");
    }
}else{
    echo '<br><br><br><center><h1>Please log in first</h1></center>';
    header("refresh:3; url=./Login.php");
}
?>