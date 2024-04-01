<?php
include 'dbconn.php';
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>PDF Access</title>
</head>

<body>
    <h1>Fill username and Upload PDF</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" id="name" name="name" placeholder="Enter your name" required><br>
        <input type="file" id="file" name="pdf_file" accept=".pdf" title="Upload PDF" required><br>
        <input type="submit" name="submit" id="submit" value="Upload">

        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            if (isset($_FILES['pdf_file']['name'])) {
                $file_name = $_FILES['pdf_file']['name'];
                $file_tmp = $_FILES['pdf_file']['tmp_name'];
                move_uploaded_file($file_tmp, "./pdf/" . $file_name);
                $insertq = "INSERT INTO pdf_datas(username,filename,downloads) VALUES('$name','$file_name',0)";
                $iquery = mysqli_query($con, $insertq);
                if ($iquery) {
        ?>
                    <div class="alert">
                        <a class="close" data-dismiss="alert" aria-label="close"></a>
                        <h6>!!!!!!!!!!!!</h6>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert">
                        <a class="close" data-dismiss="alert" aria-label="close"></a>
                        <h4>Failed! Try again</h4>
                    </div>
        <?php
                }
            }
        }
        ?>
    </form>
    <div class="card">
        <h2>Records from Database</h2>
        <table>
            <thead>
                <th>ID</th>
                <th>UserName</th>
                <th>Filename</th>
                <th>Downloads</th>
                
            </thead>
            <tbody>
                <?php
                $selectquery = "SELECT * FROM pdf_datas";
                $squery = mysqli_query($con, $selectquery);
                while ($result = mysqli_fetch_assoc($squery)) {
                    ?>
                    <tr>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo $result['username']; ?></td>
                        <td><?php echo $result['filename']; ?></td>
                        
                        <td><a href="download.php?file=<?php echo urlencode($result['filename']); ?>">Download</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    

</body>

</html>