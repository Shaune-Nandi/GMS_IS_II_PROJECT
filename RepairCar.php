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
        <div class="container d-flex justify-content-center">
			<div class="col-sm-10 rounded border border-dark">
				<div class="container">
					<div class="row">
						<form action="RepairCar.php" method="post"><br><br>
                            <div class="form-group">
                                <center><label for="Registration">Vehicle's Registration</label><br><br></center>
                                <input class="form-control" type="text" size="7" pattern="[A-Za-z]{3}[0-9]{3}[A-Za-z]{1}" title="Enter in this format: KDA399V)" name="Registration" placeholder="(e.g. KDA399V)" id="Registration" required>
                            </div><br>
                            <div class="form-group text-center">
                                <input class="btn btn-success" type="submit" value="Verify" name="submit">
                            </div><br>
                        </form>
					</div>

                    <?php
                        if (!isset($_POST['Registration'])){
                            // Could not get the data that should have been sent.
                            die ('<center><p class="text-primary">Please fill in all fields!</p></center>');
                        }else{
                            include 'Connectdb.php';
                            $Registration = $_POST['Registration'];
                            $UserID = $_SESSION['UserID'];

                            $sql_e = "SELECT * FROM Vehicles WHERE Registration='$Registration'";
                            $res_e = mysqli_query($con, $sql_e);

                            if (mysqli_num_rows($res_e) === 1){        
                                $result = mysqli_query($con, "SELECT * FROM Vehicles WHERE Registration = '$Registration' AND OwnerID = '$UserID'");
                                if (mysqli_num_rows($result) == 1){
                                    $res = mysqli_fetch_assoc($result);
                                    echo '<form action="RepairCar1.php" method="post"><br><center><h1>Your vehicle is: <input type="text" readonly name="CarRegistration" value="' . $res['Registration']; echo '"></h1><input class="btn btn-primary" type="submit" value="Continue" name="submit"></center><br></form>';



                                    //mysqli_free_result($result);
                                    //mysqli_close($con);









                                        
                                }else{
                                    echo "<br><center><h1>Enter a vehicle that you own</h1></center><br>";
                                    echo("
                                        <script>
                                            setTimeout(function(){
                                                location.href = './RepairCar.php';
                                            }, 3000);
                                        </script>
                                    ");
                                }
                            }else{
                                echo "<br><center><h1>Vehicle not found. Please add vehicle first</h1></center>";
                                echo '<center><a href="./AddVehicle.php">Add Car</a></center><br>';
                                echo("
                                    <script>
                                        setTimeout(function(){
                                            location.href = './RepairCar.php';
                                        }, 10000);
                                    </script>
                                ");
                            }
                        }                      
                    ?>
                    
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



