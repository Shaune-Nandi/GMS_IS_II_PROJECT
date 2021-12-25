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
        <div class="container">
            <div class="row">
                <?php include 'Connectdb.php';?>
                <table class="table table-hover table-sm table-bordered">

                    <?php
                        $UserID = $_SESSION['UserID'];
                        $result = mysqli_query($con, "SELECT * FROM CustRepairDetails WHERE RepairCust = '$UserID'");
                        if (mysqli_num_rows($result) >= 1){
                            $result1 = mysqli_query($con, "SELECT * FROM CustRepairDetails WHERE PaymentStatus = 'PENDING'");

                            if (mysqli_num_rows($result1) >= 1) {
                                echo "Returned rows are: " . mysqli_num_rows($result1) . "<br>";
                                echo '
                                    <thead>
                                        <tr>
                                            <th scope="col">Car Registration</th>
                                            <th scope="col">Repair Type</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                ';

                                $Counter = 1;

                                while ($Counter <= mysqli_num_rows($result1)) {
                                    $res = $result->fetch_array();
                                    $res1 = mysqli_fetch_assoc($result1);
                                    echo '                                
                                        <tr>
                                            <form action="PaymentProcess.php" method="post">
                                                <input type="hidden" class="form-control" value="' . $res1['CustRepairID'] . '" readonly name="CustRepairID">
                                                <td scope="row"><input type="text" class="form-control" value="' . $res1['Registration'] . '" readonly name="Registration"></td>
                                                <td scope="row"><input type="text" class="form-control" value="' . $res1['CustJobType'] . '" readonly name="CustJobType"></td>
                                                <td scope="row"><textarea class="form-control" readonly name="CustRepairDesc" rows = "1">' . $res1['CustRepairDesc'] . '</textarea></td>
                                            </form>
                                        </tr>                                
                                    ';
                                    $Counter=$Counter+1;
                                }
                            
                                // Free result set                
                                mysqli_free_result($result);
                                mysqli_close($con);  
                            }else {
                                echo"<br><br><br><center><h1>You have no pending payments</h1></center>";
                                echo'<br><br><center><a href="./CustomerLanding.php">Go back to main menu</a></center>';
                                mysqli_free_result($result);
                                mysqli_close($con);
    
                            }
                        }else {
                            echo"<br><br><br><center><h1>No records available</h1></center>";
                            echo'<br><br><center><a href="./CustomerLanding.php">Go back to main menu</a></center>';
                            mysqli_free_result($result);
                            mysqli_close($con);

                        }





                    ?>
                    <tbody>
                </table>
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

