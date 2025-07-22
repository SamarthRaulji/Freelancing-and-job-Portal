<?php
session_start();
$Uid = $_SESSION['ID'];

$conn = mysqli_connect('localhost', 'root', '', 'samarth');

$jobs = mysqli_query($conn, "SELECT * FROM applications WHERE user_id = '$Uid'");
$tot_jobs = mysqli_num_rows($jobs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status</title>
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
            padding: 10px;
            gap: 30px;
            width: 100%;
        }
        .details div {
            width: 100%;
            background: #e3e3e3;
            padding: 20px;
            border-radius: 10px;
        }
        .status {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            padding: 8px;
            border-radius: 5px;
            display: inline-block;
        }
        .approved { background-color: green; }
        .pending { background-color: orange; }
        .rejected { background-color: red; }
        .no-jobs {
            text-align: center;
            font-size: 24px;
            color: red;
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
    <h2>My Job Applications</h2>

    <?php
    if ($tot_jobs > 0) {
        while ($fetch_rows = mysqli_fetch_array($jobs)) {
            $poster_id = $fetch_rows[3];
            $unique_id = $fetch_rows[4];
            $select_poster_id = mysqli_query($conn, "SELECT * FROM posted_jobs WHERE `unique_id` = '$unique_id'");
            while ($fetch_poster_id = mysqli_fetch_array($select_poster_id)) {
                $select_comp = mysqli_query($conn, "SELECT * FROM `comp_login` WHERE `Userid` = '$poster_id'");
                while ($comp = mysqli_fetch_array($select_comp)) {
                    ?>
                    <div class="job-card">
                        <div class="details">
                            <h2><?php echo $comp[1]; ?></h2> 
                            <p><strong>Job:</strong> <?php echo $fetch_poster_id[0]; ?></p>
                            <p><strong>Salary:</strong> <?php echo $fetch_poster_id[2]; ?></p>
                            <p><strong>Work Type:</strong> <?php echo $fetch_poster_id[1]; ?></p>
                            <p><strong>Location:</strong> <?php echo $fetch_poster_id[3]; ?></p>
                            <p><strong>Status:</strong> <?php echo $fetch_rows[6]; ?></p>
                        </div>
                    </div>
    <?php
                }
            }
        }
    } else {
        echo "<h1 class='no-jobs'>No Applications Found!</h1>";
    }
    ?>
</div>

</body>
</html>
