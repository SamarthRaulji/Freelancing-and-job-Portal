<?php
    session_start();
    $Uid = $_SESSION['ID'];
    session_abort();
    $conn = mysqli_connect('localhost', 'root', '', 'samarth');
    $select = mysqli_query($conn, "SELECT * FROM `comp_login` WHERE `Userid` = '$Uid'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="stylesheet" href="../profile.css">
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: navy;
    margin-bottom: 20px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 4px;
    background-color: navy;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: green;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: navy;
    color: white;
}



.nav-links span, .log-span {
    margin-left: 15px;
    cursor: pointer;
    font-size: 16px;
}

.nav-links span:hover, .log-span:hover {
    color: yellow;
}

.log-span {
    background: transparent;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 20px;
    }
    
    .nav {
        flex-direction: column;
        text-align: center;
    }
    
    .nav-links {
        margin-top: 10px;
    }
    
    .nav-links span, .log-span {
        display: block;
        margin: 10px 0;
    }
}
.img1 {
    display: block;
    margin: 0 auto 20px;
    height: 150px;
    width: 150px;
    border-radius: 50%;
    object-fit: cover;
}

    </style>
</head>
<body>
    <form  method="post">
<div class="nav" id="nav">
        <div class="nav-logo">
            <img src="../logo1.png" width="50px" alt="Logo">
        </div>
        <div class="nav-links">
            <span onclick="window.location.href='comp_home.php'">Dashboard</span>
            <span onclick="window.location.href='post_job.php'">Post Job</span>
            <span onclick="window.location.href='manage_jobs.php'">Manage Jobs</span>
            <span onclick="window.location.href='applications.php'">Manage Application</span>
            <span onclick="window.location.href='comp_profile.php'">Company Profile</span>
            <button onclick="window.location.href='../data.php'" class="log-span">Log-Out</button>
        </div>
    </div>
    <div class="container">
        <h2>Company Profile</h2>
        <?php 
            while($row = mysqli_fetch_array($select))
            {
                ?>
                <img class="img1" src="Images/<?php echo $row[0]; ?>" >
                Name Of Company : <input type="text" name="comp_name" value="<?php echo $row[1]; ?>" id=""><br><br>
                Email : <input type="text" name="comp_email" value="<?php echo $row[2]; ?>" id=""><br><br>
                User Id : <input readonly type="text" name="comp_contact" value="<?php echo $row[3]; ?>" id=""><br><br>
                Land Mark : <input type="text" name="comp_address" value="<?php echo $row[5]; ?>" id=""><br><br>
                City : <input type="text" name="comp_city" value="<?php echo $row[6]; ?>" id=""><br><br>
                State : <input type="text" name="comp_state" value="<?php echo $row[8]; ?>" id=""><br><br>
                Pincode : <input type="text" name="comp_pincode" value="<?php echo $row[7]; ?>" id=""><br><br>
                <input type="submit" value="Update" name="update">
                <?php
                if(isset($_POST['update']))
                {
                    $comp_name = $_POST['comp_name'];
                    $comp_email = $_POST['comp_email'];
                    $comp_contact = $_POST['comp_contact'];
                    $comp_address = $_POST['comp_address'];
                    $comp_city = $_POST['comp_city'];
                    $comp_state = $_POST['comp_state'];
                    $comp_pincode = $_POST['comp_pincode'];
                    $update = mysqli_query($conn,"UPDATE `comp_login` SET `Name`='$comp_name',`Email`='$comp_email',`Address`='$comp_address',`City`='$comp_city',`State`='$comp_state',`Pincode`='$comp_pincode' WHERE `Userid` = '$Uid'");
                    if($update)
                    {
                        echo "<script>alert('Updated Successfully');</script>";
                        echo "<script>window.location.href='comp_profile.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Error Occured!');<script>";
                    }
                }
            }
        ?>

        
    </div>
       
 </form>
</body>
</html>
