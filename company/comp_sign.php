<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="div-2" id="div-2" >
    <table width="80%" class="frm-container" align="center">
        <tr>
            <th>
                <br>
                <form method="POST" enctype="multipart/form-data">
                    <h1><img src='logo1.png' width="15%"></h1>
                    
                    <div class="file-input-container">
                    <h2>Regester As Organization</h2>
                        <input type="file" name="fdp" id="fdp" class="input-file">
                        
                        <label for="fdp" class="file-input-label">
                            <span>Upload Organization Picture or Logo</span>
                        </label>
                    </div>
                    <br>
                    <input type="text" class="input-text" name="fnm" placeholder="Enter Your Name ">
                    <br>
                    <input type="email" class="input-text" name="feid" placeholder="Enter Your Email Address">
                    <br>
                    <br>
                    <input type="text" class="input-text" name="funm" placeholder="Create a User Name">
                    <br>
                    <input type="Password" class="input-text" name="fpwd" placeholder="Create a Password">
                    <br>
                    <textarea placeholder="  Enter Your Residentail / Mailing address" class="input-addr" name="faddr"></textarea>
                    <br>
                    <input type="text" name="fcity" class="mini-input" placeholder="Enter Name of Your City"> &nbsp; <input type="text" name="fpin" class="mini-input" placeholder="Enter Pincode"> &nbsp; <input type="text" name="fstate" class="mini-input"
                        placeholder="Enter Name of Your State">
                    <br>
                    <br>
                    <select name="fcountry" class="input-text-mini" value="Choose Nation and Enter Phone Number">
                        <option>Argentina (+54)</option>
                        <option>Australia (+61)</option>
                        <option>Brazil (+55)</option>
                        <option>Canada (+1)</option>
                        <option>China (+86)</option>
                        <option>Egypt (+20)</option>
                        <option>France (+33)</option>
                        <option>Germany (+49)</option>
                        <option>India (+91)</option>
                        <option>Indonesia (+62)</option>
                        <option>Italy (+39)</option>
                        <option>Japan (+81)</option>
                        <option>South Korea (+82)</option>
                        <option>Mexico (+52)</option>
                        <option>Nigeria (+234)</option>
                        <option>Russia (+7)</option>
                        <option>Saudi Arabia (+966)</option>
                        <option>South Africa (+27)</option>
                        <option>Spain (+34)</option>
                        <option>Turkey (+90)</option>
                        <option>United Kingdom (+44)</option>
                        <option>United States (+1)</option>
                        </select>
                    <input type="text" placeholder="Enter Your Contact Number" name="fno" class="input-text-mini">
                    <input type="submit" class="btn" name="register" value="Register">
                    <h2>Already have an account ? <a href="comp_log.php">Login</a></h2>
                </form>
            </th>
        </tr>
    </table>
</div>
</body>
</html>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'samarth');
if ($conn) {
    if (isset($_POST['register'])) {
        $type = $_POST['fform'];
        $image = $_FILES['fdp']['name'];
        $image_upload = move_uploaded_file($_FILES["fdp"]["tmp_name"], "Images/".$_FILES["fdp"]["name"]);
        if ($image_upload) 
        {     
            $name = $_POST['fnm'];
            $email = $_POST['feid'];
            $uid = $_POST['funm'];
            $password = $_POST['fpwd'];
            $address = $_POST['faddr'];
            $city = $_POST['fcity'];
            $pin = $_POST['fpin'];
            $state = $_POST['fstate'];
            $country = $_POST['fcountry'];
            $contact = $_POST['fno'];

            $sql = "INSERT INTO `comp_login`(`DP`, `Name`, `Email`, `Userid`, `Password`,`Address`, `City`, `Pincode`, `State`, `Country`, `Number`) VALUES ('$image', '$name', '$email', '$uid', '$password', '$address', '$city', '$pin', '$state', '$country', '$contact')";

            $register = mysqli_query($conn, $sql);
            if ($register) {
                echo "<script>alert('Registration Successful');</script>";
                echo "<script>window.location.href='comp_log.php';</script>";
            } else {
                echo "<script>alert('Registration Failed!');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    }
}
?>
