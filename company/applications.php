<?php
    session_start();
    $Uid = $_SESSION['ID'];
    session_abort();

    $conn = mysqli_connect('localhost', 'root', '', 'samarth');
    $select = mysqli_query($conn,"SELECT * FROM `comp_login` WHERE `Userid`= '$Uid'");
    $tot_comp = mysqli_num_rows($select);

    $applications = mysqli_query($conn,"SELECT * FROM `applications` WHERE `poster_id` = '$Uid'");
    $tot_app = mysqli_num_rows($applications);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <link rel="stylesheet" href="../profile.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-card h2 {
            color: navy;
            margin-bottom: 15px;
        }

        .nav {
            background: navy;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .nav-logo img {
            width: 50px;
        }

        .nav-links span, .log-span {
            margin: 0 15px;
            cursor: pointer;
        }

        .log-span {
            background: red;
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .log-span:hover {
            background: darkred;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: navy;
            color: white;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .company-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .status-accepted {
            color: green;
            font-weight: bold;
        }

        .status-rejected {
            color: red;
            font-weight: bold;
        }

        .action-buttons input {
            background-color: navy;
            color: white;
            border: none;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .action-buttons input:hover {
            background-color: #000066;
            transform: scale(1.05);
        }

        .no-jobs {
            text-align: center;
            font-size: 20px;
            color: gray;
            margin-top: 20px;
        }
        .title {
    text-align: center;
    margin: 20px 0;
}

.title h1 {
    font-size: 28px;
    font-weight: bold;
    color: navy;
}

    </style>
</head>
<body>
    <div class="nav" id="nav">
        <div class="nav-logo">
            <img src="../logo1.png" alt="Logo">
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
    <div class="title">
    <h1>Manage  Applications</h1>
</div>
    <div class="dashboard-container">
        <form method="post">
            <?php
            if ($tot_app > 0) {
                ?>
                <table>
                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                <?php
                while ($row = mysqli_fetch_assoc($applications)) {
                    $user_id = $row['user_id'];
                    $select_candidate = mysqli_query($conn, "SELECT * FROM `candidate_personal` WHERE `Userid` = '$user_id'");
                    while ($row_candi = mysqli_fetch_assoc($select_candidate)) {
                        ?>
                        <tr>
                            <td><img src="../Images/<?php echo $row_candi['DP']; ?>" alt="Profile" class="company-logo"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row_candi['City']; ?></td>
                            <td><?php echo $row_candi['Pincode']; ?></td>
                            <td><?php echo $row_candi['State']; ?></td>
                            <td class="action-buttons">
                                <?php if ($row['status'] == "Accepted") { ?>
                                    <span class="status-accepted">Accepted</span>
                                <?php } elseif ($row['status'] == "Rejected") { ?>
                                    <span class="status-rejected">Rejected</span>
                                <?php } else { ?>
                                    <input type="submit" value="Accept" name="a_<?php echo $row['unique_post_id']; ?>">
                                    <input type="submit" value="Reject" name="r_<?php echo $row['unique_post_id']; ?>">
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                        if (isset($_POST["a_" . $row['unique_post_id']])) {
                            $a_id = $row['unique_post_id'];
                            $accept = mysqli_query($conn, "UPDATE `applications` SET `status` = 'Accepted' WHERE `unique_post_id` = '$a_id'");
                            if ($accept) {
                                echo "<script>alert('Application Accepted!');</script>";
                                echo "<script>location.href='applications.php';</script>";
                            }
                        }
                        if (isset($_POST["r_" . $row['unique_post_id']])) {
                            $r_id = $row['unique_post_id'];
                            $reject = mysqli_query($conn, "UPDATE `applications` SET `status` = 'Rejected' WHERE `unique_post_id` = '$r_id'");
                            if ($reject) {
                                echo "<script>alert('Application Rejected!');</script>";
                                echo "<script>location.href='applications.php';</script>";
                            }
                        }
                    }
                }
            } else {
                echo "<h1 class='no-jobs'>No Applications Found!</h1>";
            }
            ?>
        </form>
    </div>
</body>
</html>
