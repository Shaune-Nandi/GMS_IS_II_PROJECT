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
		<title>GMS | Mechanic Home</title>

    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <div class="container">
            <div class="row">
                
                <!--For the Card Tiles-->
                <div class="row">
                    <div class="col-sm-6">
                        <a href="./MechanicJob.php" style="text-decoration: none;">
                            <div class="card">
                                <div class="card-body">
                                    <center><img src="#" alt="Image of Available jobs"></center>
                                </div>
                                <div class="card-footer">
                                    <h4 class="card-title text-primary"><center>Available jobs</center></h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="MechanicFinishedJobs.php" style="text-decoration: none;">
                            <div class="card">
                                <div class="card-body">
                                    <center><img src="#" alt="Image of Finished jobs"></center>
                                </div>
                                <div class="card-footer">
                                    <h4 class="card-title text-primary"><center>Finished Jobs</center></h4>
                                </div>
                            </div>
                        </a>
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
        echo '<br><br><br><center><h1>Mechanics only can view this page</h1></center>';
        header("refresh:4; url=./index.php");
    }
}else{
    echo '<br><br><br><center><h1>Please log in first</h1></center>';
    header("refresh:3; url=./Login.php");
}
?>