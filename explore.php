<?php
session_start();
$Uid = $_SESSION['ID'];
$Pwd = $_SESSION['Pwd'];

$conn = mysqli_connect('localhost', 'root', '', 'samarth');

$jobs = mysqli_query($conn, "SELECT * FROM posted_jobs");
$tot_jobs = mysqli_num_rows($jobs);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Feed</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .job-card {
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .details {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            gap: 30px;
        }
        .details div {
            width: 48%;
            background: #e3e3e3;
            padding: 15px;
            border-radius: 10px;
        }
        .details p {
            margin: 5px 0;
        }
        .no-jobs {
            text-align: center;
            font-size: 24px;
            color: red;
        }
        input[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="button"]:hover {
            background-color: #0056b3;
        }

        /* Modal CSS */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 50px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
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

<div class="container">
    <form method="post">
        <?php
        if ($tot_jobs > 0) {
            while ($fetch_rows = mysqli_fetch_array($jobs)) {
                $poster_id = $fetch_rows[6];
                $select_poster_id = mysqli_query($conn, "SELECT * FROM comp_login WHERE `Userid` = '$poster_id'");
                while ($fetch_poster_id = mysqli_fetch_array($select_poster_id)) {
                    ?>
                    <div class="job-card">
                        <h2><?php echo $fetch_poster_id[1]; ?></h2> <!-- Job Title -->

                        <div class="details">
                            <!-- Company Details -->
                            <div>
                                <h3>Company Details</h3>
                                <p><strong>Name:</strong> <?php echo $fetch_poster_id[1]; ?></p>
                                <p><strong>Email:</strong> <?php echo $fetch_poster_id[2]; ?></p>
                                <p><strong>Location:</strong> <?php echo $fetch_poster_id[5]; ?></p>
                                <p><strong>City:</strong> <?php echo $fetch_poster_id[6]; ?></p>   
                                <p><strong>Pincode:</strong> <?php echo $fetch_poster_id[7]; ?></p>  
                                <p><strong>State:</strong> <?php echo $fetch_poster_id[8]; ?></p> 
                            </div>

                            <!-- Job Details -->
                            <div>
                                <h3>Job Details</h3>
                                <p><strong>Work Type:</strong> <?php echo $fetch_rows[1]; ?></p>
                                <p><strong>Salary:</strong> <?php echo $fetch_rows[2]; ?></p>
                                <p><strong>Working Place:</strong> <?php echo $fetch_rows[3]; ?></p>
                                <p><strong>Work:</strong> <?php echo $fetch_rows[0]; ?></p>
                                <p><strong>Description:</strong> <?php echo $fetch_rows[4]; ?></p>
                                <p><strong>Requirements:</strong> <?php echo $fetch_rows[5]; ?> years</p>
                            </div>
                        </div>
                        <center>
                        <input type="button" value="Apply Now" onclick="openModal('<?php echo $fetch_rows[7]; ?>', '<?php echo $poster_id; ?>')">

                        </center>
                    </div>
        <?php
                }
            }
        } else {
            echo "<h1 class='no-jobs'>No Jobs Available!</h1>";
        }
        ?>
    </form>
</div>

<!-- Apply Modal -->
<div id="applyModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Apply for the Job</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="job_id" name="job_id" value="">
            <input type="hidden" id="poster_id" name="poster_id" value="">

            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume" required><br><br>

            <input type="submit" name="submit_application" value="Submit Application">
        </form>
    </div>
</div>

<script>
    function openModal(jobId, posterId) {
    document.getElementById("job_id").value = jobId;
    document.getElementById("poster_id").value = posterId;
    document.getElementById("applyModal").style.display = "block";
}
    function closeModal() {
        document.getElementById("applyModal").style.display = "none";
    }
</script>
<?php
if (isset($_POST['submit_application'])) 
{
    $unique_id = $_POST['job_id'];
    $poster_id = $_POST['poster_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = $_FILES['resume']['name'];
    $image_upload = move_uploaded_file($_FILES["resume"]["tmp_name"], "resumes/" . $_FILES["resume"]["name"]);
    if ($image_upload) {
        $insert = mysqli_query($conn, "INSERT INTO applications(`name`, `email`, `resume`, `poster_id`, `unique_post_id`, `user_id`,`status`) VALUES ('$name', '$email', '$image', '$poster_id', '$unique_id', '$Uid','Pending')");
        if ($insert) {
            echo "<script>alert('Applied Successfully!');</script>";
            echo "<script>location.href='explore.php';</script>";
        } else {
            echo "<script>alert('Error Occurred!');</script>";
        }
    } 
    else {
        echo "<script>alert('Error Occurred in resume upload!');</script>";
    }
}
?>
</body>
</html>
