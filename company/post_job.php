<?php
    session_start();
    $Uid = $_SESSION['ID'];
    session_abort();
    $conn = mysqli_connect('localhost', 'root', '', 'samarth');
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
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: navy;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: navy;
            margin-bottom: 5px;
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group textarea {
            height: 100px;
            resize: none;
        }

        .submit-btn {
            width: 100%;
            background-color: navy;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background-color: #000066;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<div class="nav" id="nav">
        <div class="nav-logo">
            <img src="../logo1.png" width="50px" alt="Logo">
        </div>
        <div class="nav-links">
            <span onclick="window.location.href='comp_home.php'">Dashboard</span>
            <span onclick="window.location.href='post_job.php'">Post Job</span>
            <span onclick="window.location.href='manage_jobs.php'">Manage Jobs</span>
            <span onclick="window.location.href='comp_profile.php'">Company Profile</span>
            <span onclick="window.location.href='applications.php'">Manage Application</span>
            <button onclick="window.location.href='../data.php'" class="log-span">Log-Out</button>
        </div>
    </div>
    <div class="container">
        <h2>Post A New Job</h2>
        <form method="POST">
            <div class="form-group">
                <label for="job_title">Job Title</label>
                <input type="text" id="job_title" name="title" required>
            </div>

            <div class="form-group">
                <label for="job_type">Job Type</label>
                <select id="job_type" name="type" required>
                    <option value="Full-Time">Full-Time</option>
                    <option value="Part-Time">Part-Time</option>
                    <option value="Internship">Internship</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>

            <div class="form-group">
                <label for="salary">Salary (in INR)</label>
                <input type="number" id="salary" name="salary" required>
            </div>

            <div class="form-group">
                <label for="location">Job Location</label>
                <input type="text" id="location" name="loc" required>
            </div>

            <div class="form-group">
                <label for="description">Job Description</label>
                <textarea id="description" name="desc" required></textarea>
            </div>

            <div class="form-group">
                <label for="requirements">Requirements</label>
                <textarea id="requirements" name="req" required></textarea>
            </div>

            <button type="submit" name="submit" class="submit-btn">Post Job</button>
        </form>
    </div>

</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $type = $_POST['type'];
    $sal = $_POST['salary'];
    $location = $_POST['loc'];
    $desc = $_POST['desc'];
    $req = $_POST['req'];
    $unique_id = mt_rand(10000000, 99999999);
    

    $insert = mysqli_query($conn, "INSERT INTO `posted_jobs`(`title`, `type`, `salary`, `location`, `description`, `requirements`, `poster_uid`,`unique_id`) VALUES ('$title','$type','$sal','$location','$desc','$req','$Uid','$unique_id')");
    if($insert)
    {
        echo "<script>alert('Job Posted Successfully!');</script>";
        echo "<script>location.href='manage_jobs.php';</script>";
    }
    else
    {
        echo "<script>alert('Error Occured !');</script>";
    }
}
?>