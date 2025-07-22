<?php
    session_start();
    $Uid = $_SESSION['ID'];
    session_abort();
    $conn = mysqli_connect('localhost', 'root', '', 'samarth');
    $select = mysqli_query($conn,"SELECT * FROM `comp_login` WHERE `Userid`= '$Uid'");
    $row = mysqli_fetch_assoc($select);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <link rel="stylesheet" href="../profile.css">
    <style>
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
        
        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: navy;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        
        .action-button {
            display: inline-block;
            background-color: navy;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            transition: background-color 0.3s;
        }
        
        .action-button:hover {
            background-color: #000066;
        }
        
        .welcome-section {
            grid-column: 1 / -1;
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .company-logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        h1,h2,h3 {
            color: navy;
        }
        .welcome-section input[type="submit"] {
    background-color: navy;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.welcome-section input[type="submit"]:hover {
    background-color: #000066;
    transform: scale(1.05);
    color:yellow;
    text-decoration: underline;
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
            <span onclick="window.location.href='applications.php'">Manage Application</span>
            <span onclick="window.location.href='comp_profile.php'">Company Profile</span>
            <button onclick="window.location.href='../data.php'" class="log-span">Log-Out</button>
        </div>
    </div>

    <div class="welcome-section">
        <img src="./Images/<?php echo $row['Dp'];?>" alt="Company Logo" class="company-logo">
        <h1>Welcome, <?php echo $row['Name']; ?></h1>
        <h3>City &nbsp; : &nbsp; <?php echo $row['City'];?><br>Pincode : <?php echo $row['Pincode'];?><br>State &nbsp; &nbsp; : <?php echo $row['State'];?>    <br>
        <br>Email : <?php echo $row['Email'];?>
        </h3>
        <input type="submit" value="Post Job / Hier Freelancer" onclick="location.href='post_job.php'">
    </div>

    

        
</body>
</html>