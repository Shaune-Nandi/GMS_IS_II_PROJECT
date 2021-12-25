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
		<title>GMS | Mechanic Available Jobs</title>

    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <div class="container">
            <div class="row">
                <?php include 'Connectdb.php';?>
                <table class="table table-hover table-sm table-bordered">

                    <?php
                        $result = mysqli_query($con, "SELECT * FROM CustRepairDetails WHERE CustJobTaken = 'NO' AND CustJobDone = 'NO'");
                        //$result1 = mysqli_query($con, "SELECT * FROM Vehicles");
                        


                        if (mysqli_num_rows($result) >= 1) {
                            echo "Returned rows are: " . mysqli_num_rows($result) . "<br>";
                            echo '
                                <thead>
                                    <tr>
                                        <th scope="col">Job ID</th><!--Job number gotten from CustRepairDetails(CustRepairID)-->
                                        <th scope="col">Repair Type</th><!--Job Type gotten from CustRepairDetails(CustJobType)-->
                                        <th scope="col">Description</th><!--Job description gotten from CustRepairDetails(CustRepairDesc)-->
                                        <th scope="col">Time received</th><!--Job description gotten from CustRepairDetails(CustDate)-->
                                        <th scope="col">Car Registration</th><!--Mechanic chooses whether to take job or not [Take job/Decline job]-->
                                        <th scope="col">Decision</th><!--Mechanic chooses whether to take job or not [Take job/Decline job]-->
                                    </tr>
                                </thead>
                                <tbody>
                            ';

                            $Counter = 1;
                            
                            while ($Counter <= mysqli_num_rows($result)) {
                                $res = $result->fetch_array();
                                //$res1 = $result1->fetch_array();

                                //$RepairCust = $res['RepairCust'];
                                //$result2 = mysqli_query($con, "SELECT * FROM Vehicles WHERE OwnerID = '$RepairCust'");
                                //$res2 = $result2->fetch_array();
                                echo '                                
                                    <tr>
                                        <form action="MechanicTakeJob.php" method="post">
                                        
                                            <th scope="row"><input type="number" class="form-control" value="' . $res['CustRepairID'] . '" readonly name="CustRepairID"></th>
                                            <td scope="row"><input type="text" class="form-control" value="' . $res['CustJobType'] . '" readonly name="CustJobType"></td>
                                            <td scope="row"><textarea class="form-control" readonly name="CustRepairDesc" rows = "3">' . $res['CustRepairDesc'] . '</textarea></td>
                                            <td scope="row"><input type="text" class="form-control" value="' . $res['CustDate'] . '" readonly name="CustDate"></td>
                                            <td scope="row"><input type="text" class="form-control" value="' . $res['Registration'] . '" readonly name="Registration"></td>
                                            <td><input class="btn btn-primary" type="submit" value="Take Job" name="TakeJob"></td>
                                        </form>
                                    </tr>                                
                                ';
                                $Counter=$Counter+1;
                            }
                        
                            // Free result set                
                            mysqli_free_result($result);
                            mysqli_close($con);
                            
                        }else {
                            echo"<br><br><br><center><h1>There are no repair jobs available</h1></center>";
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
        echo '<br><br><br><center><h1>Mechanics only can view this page</h1></center>';
        header("refresh:4; url=./index.php");
    }
}else{
    echo '<br><br><br><center><h1>Please log in first</h1></center>';
    header("refresh:3; url=./Login.php");
}
?>