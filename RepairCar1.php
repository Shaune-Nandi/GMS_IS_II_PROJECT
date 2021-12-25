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
        <title>GMS | Repair Car</title>
    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <?php include 'Connectdb.php';?><br>

        <div class="container d-flex justify-content-center">
			<div class="col-sm-10 rounded border border-dark">
				<div class="container">
                    <form action="./RepairCar2.php" method="post"><br>
                    <center><h4>Repair Details</h4><br></center>
                        <div class="row">
                            <div class="col-sm-3 bg-light">
                                <?php
                                    $Registration = $_POST['CarRegistration'];
                                    $result = mysqli_query($con, "SELECT * FROM Vehicles WHERE Registration = '$Registration'");
                                    $res = mysqli_fetch_assoc($result);
                                ?>
                                <h5><input type="text" class="form-control-plaintext" value="<?php echo $Registration; ?>" readonly name="Registration"></input></h5>
                                <hr>
                                <input type="text" class="form-control-plaintext" value="<?php echo $res['VehicleType']; ?>" readonly name="VehicleType"></input>
                                <input type="text" class="form-control-plaintext" value="<?php echo $res['VehicleMake']; ?>" readonly name="VehicleMake"></input>
                                <input type="text" class="form-control-plaintext" value="<?php echo $res['VehicleName']; ?>" readonly name="VehicleName"></input>
                                <input type="text" class="form-control-plaintext" value="<?php echo $res['VehicleYear']; ?>" readonly name="VehicleYear"></input>
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="JobType">Select the type of repair</label>
                                    <input list="JobType" name="JobType" class="list-group-item" placeholder="e.g. Puncture" required>
                                    <datalist id="JobType">
                                        <option value="General Service"> <option value="Puncture"> <option value="Wheel Alignment"> <option value="Brake Repair"> <option value="Oil Change"> <option value="Body Panelling"> 
                                    </datalist>
                                </div><br>
                                <div class="form-group">
                                    <label for="RepairDescription">Description</label>                            
                                    <textarea class="form-control" rows = "4" name="RepairDescription" id="RepairDescription" required placeholder="Enter your repair details here..."></textarea>
                                </div><br><br>
                                <div class="form-group text-center">
                                    <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                                </div><br>
                            </div>
                        </div><br>                           
                    </form>
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