<?php
    session_start();
    $_SESSION['ID'] ;
    $_SESSION['Pwd'] ;
    $Uid=$_SESSION['ID'];
    $Pwd=$_SESSION['Pwd'];
    $conn = mysqli_connect('localhost','root','','samarth');
    $selperdtl = "SELECT * FROM candidate_personal WHERE Email = '$Uid' OR Userid = '$Uid' AND Password = '$Pwd'";
    $resperdtl = mysqli_query($conn,$selperdtl);
    $i = 0 ;
    $j = 0 ;
    
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
    <title>My Cloud</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        h1{
            color: black;
        }
        h2{
            color: navy;
            cursor: pointer;
        }
        h2:hover{
            text-decoration: underline;
        }
        input[type=text]{
            height: 10px;
            width: 95%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid navy;
            margin-top: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input[type=text]:focus{
            outline: none;
            border-color: navy;
            box-shadow: 0 0 5px navy;
        }
        input[type=submit]{
            background-color: navy;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin:0;
        }
        input[type=submit]:hover{
            background-color: #ffd700; /* Gold hover effect */
            color: navy;
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

    <div class="div-1" id="div-1">
        <div class="emptydiv"></div>
        <table width="80%"  class="content" align="center">
            <tr>
                <th  width="40%">
                <?php
                echo "<img src='Images/$dp' width=70%>";
                echo "</th>
                      <th align=left width=60%>";
                echo "<h1>Welcome, $nm <br>Here You can Upload, Your Static Webproject, Documentation, PPT, etc...</h1>";
                ?>
                </th>
            </tr>
            <tr>
                <th width="50%" onclick="window.location.href =  'webpro.php'"><h2>Upload Static Webproject</h2></th>
                <th width="50%" onclick="window.location.href = 'Document.php'"><h2>Upload Documentation</h2></th>
            </tr>
        </table>
        <br><br>
        
        <?php
        $sel_proj = "SELECT * FROM candidate_project WHERE Userid = '$Uid'";
        $res_proj = mysqli_query($conn,$sel_proj);
       
        echo "<table  width=80%  class=content align=center><tr><th colspan=3><h1>Your Uploaded Documents will be shown here</h1></th></tr>";
        while($rowproj = mysqli_fetch_array($res_proj))
        {
            if($Uid == $rowproj[3])
            {
                $project_nm = $rowproj[4];
                $project_disc = $rowproj[5];

                if($project_nm == 'N/A' || $project_disc == 'N/A'){
                    echo "<tr><th colspan=3><h1>You Haven't Uploaded Anything Yet.....</h1></th></tr></table>";
            }
            else{
                $i++;
                echo "
                <tr>
                <form method='post'>
                <th align=left width=5%>$i</th>
                <th width=60%> 
                    <input type=text name='fproject' readonly value='$rowproj[5]'>
                    <input type=text name='doc_nm' value='$rowproj[4]' readonly style='display:none'>
                </th>
                <th>
                <a href='Cloud/$rowproj[4]' target='_blank' style='color:white;'>Click here to Access in New Tab</a>
                    </th>
                </tr>
                <tr>
                <th colspan=3>
                    <input type=submit value='Delete' name='del_document' >
                </th>
                </form>
                </tr>
                ";
            }
            }
        }
        echo "</table>";
        ?>

        <br>
        <br>

        <?php
        $sel_proj_web = "SELECT * FROM webhosting WHERE Userid = '$Uid'";
        $res_proj_web = mysqli_query($conn,$sel_proj_web);

        $sel_porj_link = "SELECT * FROM webhosting_link WHERE Userid = '$Uid'";
        $res_proj_link = mysqli_query($conn,$sel_porj_link);

        echo "<table  width=80%  class=content align=center><tr><th colspan=3><h1>Your Uploaded Static Website will be shown here</h1></th></tr>";

        while($rowweb = mysqli_fetch_array($res_proj_web))
        {
            $project_nm_web = $rowweb[4];
            $project_disc_web = $rowweb[5];

            $j++;
                echo "
                <tr>
                <form method='post'>
                <th align=left width=5%>$j</th>
                <th width=60%>                
    
                    <input type=text name='fproject' class='input-addr' readonly value='$rowweb[5]' >
                    <input type=text name='web_nm' value=$rowweb[4] style='display:none' readonly>
                </th>
                <th>
                <h2>    
                <a href='webprojects/$rowweb[4]' target='_blank' style='color:white;'>Click here to Access in New Tab</a>
                    </th>
                </tr>
                <tr>
                <th colspan=3>
                    <input type=submit value='Delete' name='del_web' >
                </th>
                </form>
                </tr>
                ";
        }

        while($rowlink = mysqli_fetch_array($res_proj_link))
        {
            $project_nm_link = $rowlink[4];
            $project_disc_link = $rowlink[5];

            $j++;
                echo "
                <tr><form method='post'>
                <th align=left width=5%>$j</th>
                <th width=60%>                
                
                    <textarea name='fproject' class='input-addr'>$rowlink[5]</textarea>
                     <input type=text name='web_link' value=$rowlink[4] style='display:none' readonly> 
                     
                </th>
                <th>
                
                <a href='$rowlink[4]' target='_blank' style='color:white;'>Click here to Access in New Tab</a>
                
                    </th> 
                </tr>
               <tr>
                <th colspan=3>
                    <input style='margin-top:0;' type=submit value='Delete' name='del_link'>
                </th>
                </form>
                ";
        }
        echo "</table>";
        ?>
        <br>
        <br>
   
</body>
<?php
if(isset($_POST['del_document']))
{
    $doc_nm = $_POST['doc_nm']; 

    unlink("Cloud/".$_POST['doc_nm']);

        $del_doc = "DELETE FROM candidate_project WHERE Userid = '$Uid' AND Project_name = '$doc_nm'";
        $res_del_doc = mysqli_query($conn,$del_doc);

        if($res_del_doc)
        {
            echo "<script>alert('Document has been removed');</script>";
            echo "<script>window.location.href = 'cloud.php'</script>";
        }
    }

if(isset($_POST['del_link']))
{
    $doc_nm = $_POST['web_link'];
    $del_link = "DELETE FROM webhosting_link WHERE Userid = '$Uid' AND link = '$doc_nm'"; 
    $res_del_web = mysqli_query($conn,$del_link);
    if($res_del_web)
    {
        echo "<script>alert('Document has been removed');</script>";
        echo "<script>window.location.href = 'cloud.php'</script>";
    }
}

    if (isset($_POST['del_web'])) {
        $doc_web = $_POST['web_nm'];
        $doc_web_folder = str_replace('/Index.html', '', $doc_web);
    
        function deleteDirectory($dir) {
            if (!file_exists($dir)) {
                return false;
            }
    
            if (!is_dir($dir)) {
                return unlink($dir);
            }
    
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
    
                if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                    return false;
                }
            }
    
            return rmdir($dir);
        }
    
        if (deleteDirectory("webprojects/" . $doc_web_folder)) {
            $del_web = "DELETE FROM webhosting WHERE Userid = '$Uid' AND Project_name = '$doc_web'";
            $res_del_web = mysqli_query($conn, $del_web);
    
            if ($res_del_web) {
                echo "<script>alert('Document has been removed');</script>";
                echo "<script>window.location.href = 'cloud.php';</script>";
            } else {
                echo "<script>alert('Failed to delete record from database');</script>";
            }
        } else {
            echo "<script>alert('Failed to delete folder');</script>";
        }
    }

    ?>
    

</html>
