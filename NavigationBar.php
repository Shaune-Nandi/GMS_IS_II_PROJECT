


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>


    <body>
        <nav class="navbar navbar-expand-lg navbar-success bg-light">
            <a href="./index.php"><img src="Logo.jpg" alt="Logo" height="50px"></a>

                <?php
                    if (isset($_SESSION['loggedin'])) {
                        $Role = $_SESSION['Role'];
                        if ($Role == "Customer") {
                            echo '
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="nav">
                                    <li class="nav-item text-primary"><a class="nav-link" href="./CustomerLanding.php">Main</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./AddVehicle.php">Add Vehicle</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./RepairCar.php">Repair Vehicle</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./Payment.php">Pay</a></li>
                                </ul>
                            </div>
                            ';  
                        }elseif ($Role == "Mechanic") {
                            echo '
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="nav">
                                    <li class="nav-item text-primary"><a class="nav-link" href="./Index.php">Mechanic Home</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./Services.php">Mechanic Services</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./About.php">Mechanic About</a></li>
                                </ul>
                            </div>
                            ';  
                        }elseif ($Role == "Manager") {
                            echo '
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="nav">
                                    <li class="nav-item text-primary"><a class="nav-link" href="./Injjjdex.php">Manager Home</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./Services.php">Manager Services</a></li>
                                    <li class="nav-item text-primary"><a class="nav-link" href="./About.php">Manager About</a></li>
                                </ul>
                            </div>
                            ';  
                        }
                    }else{
                        echo '
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav">
                                <li class="nav-item text-primary"><a class="nav-link" href="./Index.php">No-one Home</a></li>
                                <li class="nav-item text-primary"><a class="nav-link" href="./Services.php">No-one Services</a></li>
                                <li class="nav-item text-primary"><a class="nav-link" href="./About.php">No-one About</a></li>
                            </ul>
                        </div>
                        ';           
                    }
                
                ?>

                
                
                

                <?php
                    if (isset($_SESSION['loggedin'])) {
                    echo '        
                        <ul class="nav">
                            <li class="nav-item text-primary">
                                <h6> ' . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . ' (' . $_SESSION['Role'] . ')</h6>
                            </li>
                        </ul>
                        <ul> </ul>
                        <ul class="nav">
                            <a href="./Logout.php"><button type="button" class="btn btn-outline-primary"><h6 style="padding:0;">Logout</h6></button><a>
                        </ul>
                        <ul> </ul>
                        ';
                    } else {
                    echo '
                        <ul class="nav">
                            <a href="./Registration.php"><button type="button" class="btn btn-outline-primary"><h6">Register</h6></button><a>
                            <li class="nav-item"><h5 class="nav-link text-dark"></h5></li>
                            <a href="./Login.php"><button type="button" class="btn btn-outline-primary"><h6">Login</h6></button><a>
                            <li class="nav-item"><h5 class="nav-link text-dark"></h5></li>
                        </ul>
                        ';
                    }
                ?>    
        </nav>
        <br>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script-->

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        
    </body>
</html>