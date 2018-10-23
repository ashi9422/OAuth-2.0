<?php
    
    require_once 'config.php';
	
	//if access token is not set redirect to login page
    if(!isset($_SESSION['access_token']))
	{
        header('Location: index.php');
        exit();
    }

	if (!empty($_POST)) 
	{

		$files = $_FILES['fileToUpload']['name'];
	
		//apply an access token to a new Google_Client object since the access token is stored in a user session
		$google_client->setAccessToken($_SESSION['access_token']);
		//build a service object for the Google Drive API an authorized Google_Client object to the constructor for the API 
		$google_drive_service = new Google_DriveService($google_client);
		$fileMetadata = new Google_DriveFile(array(
			'name' => $_FILES['fileToUpload']['name']));

		$fileMetadata->setTitle($_FILES['fileToUpload']['name']);
		//get the contents of the file the uploaded
		$file_content = file_get_contents($_FILES['fileToUpload']['tmp_name']);
		//upload file to google drive
		$file = $google_drive_service->files->insert($fileMetadata, array(
			'data' => $file_content,
			'mimeType' => $_FILES['fileToUpload']['type'],
			'uploadType' => 'multipart',
			'fields' => 'id'));
		//alert to show success message
        echo "<script type='text/javascript'>alert('File Successfully Uploaded!')</script>";

    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Google Drive File Uploading</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./css/styles.css">
	</head>

	<body style="background: #8e4aa5">
		<h1 style="text-align: center; margin-top: 100px">UPLOAD FILES TO GOOGLE DRIVE</h1><br>
		<!-- Form to upload files-->
        <form class="modal-content" style="margin: auto;text-align:center;" method="POST" action="?" enctype="multipart/form-data"> 
            <div class="container" style="margin-top:20px">
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" /><br/>
                <input type="submit" value="Upload File" name="submit" class="btn form-control" style="background-color:#02144D;color: white;"><br/><br>
                <input type="button" value="LogOut" onclick="window.location ='Location: logout.php'" class="btn form-control" style="background-color:#75033C;color: white;" /><br>
			</div>
		</form>  
	</body>
</html>