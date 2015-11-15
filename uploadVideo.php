<?php

    require 'lib/database.php';

    $tablename = "videos";
    

                echo "Reaches this point";
    try {

            $plsDrop = "DROP TABLE IF EXISTS $tablename";
            $db->exec($plsDrop);

             // sql to create table
            $sql = "CREATE TABLE $tablename(
                VIDEO LONGBLOB,
                videoId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                videoName VARCHAR(255),	
                videoURL VARCHAR(255) 
            )";

            $db->exec($sql);



            if(isset($_POST['submit'])) {
                $name = $_FILES['fileToUpload']['name'];
                $temp = $_FILES['fileToUpload']['tmp_name'];

                $message = '';
                switch( $_FILES['fileToUpload']['error'] ) {
                    case UPLOAD_ERR_OK:
                        $message = false;
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
                $url = "http://localhost/VideoUploader/uploaded/$name";

                $stmt = ("INSERT INTO $tablename (videoId, videoURL, videoName) VALUES ('','$url', '$name')");

                $db -> exec($stmt);
                echo "<br/>".$name." has been uploaded<br/>";
            } 
            else {
                echo "<br />Please upload a file<br/>";
            }
        }
        catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }