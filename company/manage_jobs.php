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
            max-width: 1100px;
            margin: 30px auto;
            padding: 50px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
       input[type="submit"]{
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid navy;
            border-radius: 4px;
            background-color: navy;
            color: white;
        }
        input[type="submit"]:hover{
            background-color: red;
            color: white;
        }
        table{
            border:1px;
        }
        td {
            padding: 10px;
        }
        table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
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
        <h2>Manage Jobs</h2>
        <table style="width:100% ; height:150px;">
            
            <?php
                $select = mysqli_query($conn, "SELECT * FROM `posted_jobs` WHERE `poster_uid` = '$Uid'");
                $tot_row = mysqli_num_rows($select);
                if($tot_row > 0)
                {
                    $i=1;
                    ?>
                    <tr>
                        <th>Sr No.</th>
                        <th>Job Title</th>
                        <th>Job Type</th>
                        <th>Salary</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Requirements</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    while($row = mysqli_fetch_array($select))
                    {
                        ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $row['title']; ?></td>
                            <td align="center"><?php echo $row['type']; ?></td>
                            <td align="center"><?php echo $row['salary']; ?></td>
                            <td align="center"><?php echo $row['location']; ?></td>
                            <td align="center"><?php echo $row['description']; ?></td>
                            <td align="center"><?php echo $row['requirements']; ?></td>
                            <td align="center"><input type="submit" value="Remove" name="remove_<?php echo $row['unique_id']; ?>"></td>
                        </tr>
                        <?php
                        if (isset($_POST["remove_{$row['unique_id']}"])) 
                        {
                            $unique_id1 = $row['unique_id'];
                            $delete = mysqli_query($conn, "DELETE FROM `posted_jobs` WHERE `unique_id` = '$unique_id1'");
                            if ($delete) {
                                echo "<script>alert('Job removed successfully!');</script>";
                                echo "<script>window.location.href = 'manage_jobs.php';</script>";
                            }
                            else
                            {
                                echo "<script>alert('Error Occured!');</script>"; 
                            }
                    
                        }
                        $i++;
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="7" align="center"><h2>No Jobs Found!</h2></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
       
 </form>
</body>
</html>
