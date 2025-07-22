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
    <title>Upload Document</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        .upload-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
        }
        
        .upload-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid navy;
            margin-top: 5px;
        }
        
        input[type="submit"] {
            background-color: navy;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }
        
        input[type="submit"]:hover {
            transition: 0.5s ease-in-out;
            color :white;
            background-color: #000066;
        }
        
        .search-input {
            width: 300px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid white;
            margin-right: 5px;
        }
        
        .sb {
            padding: 8px 15px;
            background-color: white;
            color: navy;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .sb:hover {
            background-color: #f0f0f0;
        }
        
        .log-span {
            background-color: white;
            color: navy;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .log-span:hover {
            background-color: #f0f0f0;
        }

        .nav {
            background-color: navy;
            color: white;
            padding: 1rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-right: 20px;
        }

        .nav span {
            color: white;
            cursor: pointer;
            font-size: 16px;
            text-transform: uppercase;
            position: relative;
            transition: color 0.3s;
            text-decoration: none;
        }

        .nav span:hover {
            color: #ffd700;
        }

        .nav span::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0%;
            height: 2px;
            background-color: #ffd700;
            transition: width 0.3s;
        }

        .nav span:hover::after {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="nav" id="nav">
        <div class="nav-logo">
            <img src="logo1.png" width="50px" alt="Logo">
        </div>
        <div class="nav-links">
            <span onclick="window.location.href='home.php'">Home</span>
            <span onclick="window.location.href='explore.php'">Explore</span>
            <span onclick="window.location.href='cloud.php'">My cloud</span>
            <span onclick="window.location.href='requests.php'">Applications</span>
            <span onclick="window.location.href='profile.php'">Profile</span>
            <button onclick="window.location.href='data.php'" class="log-span">Log-Out</button>
        </div>
        
    </div>

    <div class="upload-container">
        <form method="post" enctype="multipart/form-data">
            <div class="upload-form">
                <input type="file" name="fdocument" required>
                <textarea class="input-addr" name="discription" placeholder="Enter Something About your File" required></textarea>
                <input type="submit" class="btn" name="upload" value="Upload">
            </div>
        </form>
    </div>
    
    <?php
    if(isset($_POST['upload']))
    {
        function generateRandomString($length = 5) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $charactersLength = strlen($characters);
            $randomString = '';
            
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            
            return $randomString;
        }
        
        $file = $_FILES['fdocument'];
        $randomString = generateRandomString();
        $fileName = $Uid . "_" . $randomString . "_" . basename($file['name']);
        
        $targetDirectory = "Cloud/";
        $targetFile = $targetDirectory . $fileName;
        
        $discript = $_POST['discription'];

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {

        }
        $inst_proj = "INSERT INTO candidate_project VALUES ('$dp','$nm','$email','$Uid','$fileName','$discript');";
        $res_proj = mysqli_query($conn,$inst_proj);

        if($res_proj)
        {
            echo "<script>alert('File Uploaded Successfully');</script>";
            echo "<script>window.location.href='cloud.php';</script>";
        }
        else
        {
            echo "<script>alert('Failed to upload file');</script>";
        }

    }

    ?>
</body>
</html>
