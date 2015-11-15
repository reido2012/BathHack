<!DOCTYPE html>
<html>
<head>
<title>Video Upload</title>
</head>

<body>

<form action = "index.php" method = "POST" enctype = "multipart/form-data" >
	<input type = "file" name = "fileToUpload" id = "fileToUpload">
	<input type = "submit" name = "submit" value = "Upload"/>
</form>
<?php


$servername = "bathhack.cloudcell.co.uk";
$username = "bathhackapp";
$password = "fe2184fe2184";
$dbName = "panic-button";
$tablename = "videos";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	$plsDrop = "DROP TABLE IF EXISTS $tablename";
    	$conn->exec($plsDrop);
  
    	 // sql to create table
	    $sql = "CREATE TABLE $tablename(
	    	VIDEO LONGBLOB,
	    	videoId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	    	videoName VARCHAR(255),	
	    	videoURL VARCHAR(255) 
	    )";

		$conn->exec($sql);
 

  
    		if(isset($_POST['submit'])) {

			$name = $_FILES['fileToUpload']['name'];
			$temp = $_FILES['fileToUpload']['tmp_name'];

	$message = '';
        switch( $_FILES['fileToUpload']['error'] ) {
            case UPLOAD_ERR_OK:
                $message = false;;
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $message .= ' - file too large (limit of xxx bytes).';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message .= ' - file upload was not completed.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message .= ' - zero-length file uploaded.';
                break;
            default:
                $message .= ' - internal error #'.$_FILES['newfile']['error'];
                break;
        }


			move_uploaded_file($temp, "./uploaded/".$name);
			$url = "http://localhost/Video%20Uploader/uploaded/$name";

			 $stmt = ("INSERT INTO $tablename (videoId, videoURL, videoName) VALUES ('','$url', '$name')");
		 	
			$conn -> exec($stmt);
			echo "<br/>".$name." has been uploaded<br/>";
		} else {
			echo "<br />Please upload a file<br/>";
		}
	}
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    $conn = null;
?>

//<a href="uploadedvids.php" >Uploaded //Videos<a/>
</body>
</html>