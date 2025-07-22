<?php
    session_start();
    $_SESSION['ID'] ;
    $_SESSION['Pwd'] ;
    $Uid=$_SESSION['ID'];
    $Pwd=$_SESSION['Pwd'];
    $conn = mysqli_connect('localhost','root','','samarth');
    $selperdtl = "SELECT * FROM candidate_personal WHERE Email = '$Uid' OR Userid = '$Uid' AND Password = '$Pwd'";
    $resperdtl = mysqli_query($conn,$selperdtl);
    
    if($resperdtl)
    {
       while($rowresperdtl = mysqli_fetch_array($resperdtl))
       {
        $dp = $rowresperdtl[0];
        $nm = $rowresperdtl[1];
        $email = $rowresperdtl[2];
        $about = $rowresperdtl[12];
       }
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Homepage</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        h1{
            cursor: pointer;
            margin:0;
        }
        h1:hover{
            text-decoration: underline;
        }
    
    </style>
</head>

<body>
<div class="nav" id="nav">
    <div class="logo">
        <img src="logo1.png" width="50px" alt="Logo">
    </div>
    <div class="nav-links">
        <span onclick="window.location.href='home.php'">Home</span>
        <span onclick="window.location.href='explore.php'">Explore</span>
        <span onclick="window.location.href='cloud.php'">My Cloud</span>
        <span onclick="window.location.href='requests.php'">Application</span>
        <span onclick="window.location.href='profile.php'">Profile</span>
        <button onclick="window.location.href='data.php'" class="log-out">Log-Out</button>
    </div>
</div>

    <div class="div-1" id="div-1">
        <div class="emptydiv"></div>
        <table width="80%"  class="content" align="center">
            <tr>
                <th  width="40%">
                <?php
                echo "<img src='Images/$dp' width=70%>";
                echo "</th>
            <th align=left width=60%>";
                echo "<h2>Welcome, $nm <br> $Uid <br> $email <br><br> About me : $about</h2>";
                ?>
                </th>
            </tr>
            <tr>
                <th colspan="2" class="container" onclick="window.location.href='explore.php'">
                    <h1>Search / Explore for Jobs and Freelancing.</h1>
                </th>
            </tr>
            <tr>
                <th colspan="2" class="container1" onclick="window.location.href='cloud.php'">
                    <h1>Host your own Static Webproject on My Cloud.</h1>
                </th>
            </tr>
        </table>
    </div>

   
</body>


</html>
