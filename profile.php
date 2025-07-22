<?php
    session_start();
    $_SESSION['ID'] ;
    $_SESSION['Pwd'] ;
    $Uid=$_SESSION['ID'];
    $Pwd=$_SESSION['Pwd'];
    $conn = mysqli_connect('localhost','root','','samarth');

    $selperdtl = "SELECT * FROM candidate_personal WHERE Email = '$Uid' OR Userid = '$Uid'";
    $resperdtl = mysqli_query($conn,$selperdtl);
    
    if($resperdtl)
    {
       while($rowresperdtl = mysqli_fetch_array($resperdtl))
       {
        $dp = $rowresperdtl[0];
        $nm = $rowresperdtl[1];
        $email = $rowresperdtl[2];
        $unm = $rowresperdtl[3];
        $contact = $rowresperdtl[11];
        $about = $rowresperdtl[12];
        $password = $rowresperdtl[4];
       }

       $seledu = "SELECT * FROM candidate_edu WHERE Userid = '$Uid'";
       $resedu = mysqli_query($conn,$seledu);

       while ($rowedu = mysqli_fetch_array($resedu))
       {
        $hs = $rowedu[4];
        $board = $rowedu[5];
        $degree = $rowedu[6];
        $university = $rowedu[7];
       }
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Feed</title>
    <link rel="stylesheet" href="profile.css">
    <style>
         .input-text, .input-addr {
            width: 98%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid navy;
            margin-top: 5px;
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


<div class="card">
    <form method="post" enctype="multipart/form-data">
    <table width="95%" align="center" border="4px" bordercolor="black">
        <tr>
            <th align="left">
                <h1>Personal Details : <?php echo $Uid;
                 ?>
                <br>
                <br>
                <?php
                echo "<center><img src='Images/$dp'  width=20%><br><input type=file name=fdp value='$dp'></center>";
                echo "<br><br>";
                echo "Name<br><input type=text name=fpnm value='$nm' class='input-text'>";
                echo "<br><br>";
                echo "About me<br><textarea name=fabout class='input-addr'>$about</textarea>";
                echo "<br><br>";
                echo "Email<br><input type=text name=feid value='$email' class='input-text'>";
                echo "<br><br>";
                echo "Contact no.<br><input type=text name=fcontact value='$contact' class='input-text'>";
                echo "<br><br><hr width=98% color=white align=left><br>";
              
                ?>
            </h1> 
                <center><input type="submit" class="btn" name="update" value="Update"></center>
        </th>
        </tr>
    </table>
    </form>
    </div>
       
</body>


</html>
<?php
if(isset($_POST['update']))
{
    $udp = $_FILES['fdp'];
    move_uploaded_file($udp['tmp_name'], "Images/" . $udp['name']);

    $dp = $udp['name'];
    $name = $_POST['fpnm'];
    $about = $_POST['fabout'];
    $email = $_POST['feid'];
    $contact = $_POST['fcontact'];

    $hs = $_POST['fhs'];
    $board = $_POST['fboards'];
    $degree = $_POST['fdegree'];

    $update_personal = "UPDATE `candidate_personal` SET `About` = '$about', `Name` = '$name', Email = '$email', Userid = '$Uid', `Password` = '$password', `Number` = '$contact' WHERE Userid = '$Uid';";
    $res_update_personal = mysqli_query($conn,$update_personal);

    if($res_update_personal)
    {
        
        $update_edu = "UPDATE `candidate_edu` SET `DP` = '$dp', `Name` = '$name', Email = '$email', Userid = '$Uid', Highschool = '$hs', Board = '$board', Graduation = '$degree'";
        $res_update_edu = mysqli_query($conn,$update_edu);
        if($res_update_edu)
        {
            echo "<script>alert('Database has been updated Sucessfully');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
        }
    }
}
?>