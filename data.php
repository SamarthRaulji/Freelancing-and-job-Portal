<?PHP
        $conn = mysqli_connect('localhost', 'root', '', 'samarth');
        session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login As CAndidate</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="div-1" id="div-1">
        <div class="emptydiv"></div>
        <table width="80%" class="frm-container" align="center">
            <tr>
                <th>
                    <form method="post" enctype="multipart/form-data">
                        <h1><img src='logo1.png' width="15%"></h1>
                        <h1>Login As Candidate</h1>
                        <input type="text" class="input-text" name="flid" placeholder="Enter Your Email ID or Username">
                        <br>
                        <input type="password" class="input-text" name="flpwd" placeholder="Enter Your Login Password">
                        <br>
                        <br>
                        <input type="submit" class="btn" name="Login" value="Click Here to Login">
                        <br>
                        <h2>No Have An Account ?<a href="sign_up.php"> Click Here</a></h2>
                        <h2><a href="./company/comp_log.php">Login As Organization ?</a></h2>
                </th>
            </tr>
        </table>
    </div>

   
</body>
<?php

    if(isset(($_POST['Login'])))
    {
        $Uid = $_POST['flid'];
        $Pwd = $_POST['flpwd'];
        $selperdtl = "SELECT * FROM candidate_personal WHERE Email = '$Uid' OR Userid = '$Uid' AND Password = '$Pwd'";
        $resselperdtl = mysqli_query($conn,$selperdtl);
        $tot_rows = mysqli_num_rows($resselperdtl);
        if($tot_rows > 0 )
        {
            while($store = mysqli_fetch_assoc($resselperdtl))
            {
            $_SESSION['ID'] = $store['Userid'];
            $_SESSION['Pwd'] = $store['Password'];
            echo "<script>window.location.href='home.php';</script>";
            }
        }
        else
        {
            echo "<script>alert('You ve entered Wrong Credentails');</script>";
        }
    }
?>
</html>