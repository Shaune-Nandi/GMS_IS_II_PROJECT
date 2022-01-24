<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['Role'] === "Manager"){
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<title>GMS | Manager Customers</title>

    </head>

    <body>
        <?php include 'NavigationBar.php';?><br>
        <?php include 'Connectdb.php';?><br>
        <div class="container">
            <div class="row">
                <table class="table table-hover table-bordered">
                <?php
                    $UserID = $_SESSION['UserID'];  
                    $result = mysqli_query($con, "SELECT * FROM Users WHERE Role = 'Customer'");
                    if (mysqli_num_rows($result) > 0) {
                        echo "Returned rows are: " . mysqli_num_rows($result) . "<br>";
                        echo '
                            <thead>
                                <tr>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        $x = 1;
                        while ($x <= mysqli_num_rows($result)) {
                            $res = $result->fetch_array();
                            echo '                                
                                <tr>                            
                                    <th scope="row">' . $res['FirstName'] . '</th>
                                    <td scope="row">' . $res['LastName'] . '</td>
                                    <td scope="row">' . $res['Email'] . '</td>
                                    <td scope="row">' . $res['Phone'] . '</td>
                                    <td scope="row">' . $res['DateJoined'] . '</td>
                                </tr>                                                 
                            ';
                            $x=$x+1;
                        }
                    }
                ?>
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