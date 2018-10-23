<?php
   
    if(isset($_SESSION['access_token'])){
        header('Location: login.php');
        exit();
    }
	require_once "config.php";
	//generate a URL to request access from Google's OAuth 2.0 server
    $loginURL = $google_client->createAuthUrl();
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
    <h1 style="text-align: center; margin-top: 100px">UPLOAD FILES TO GOOGLE DRIVE</h1>
	<!--Form to login with facebook-->
        <form class="modal-content" style="margin: auto;text-align:center;"> 
			<div class="container" style="margin-top:20px">
                <input style="background-color: #a54a7f;" type="button" value="Login with Google" onclick="window.location ='<?php echo $loginURL ?>';" class="btn btn-danger form-control"/><br>
            </div>
        </form>
</body>
</html>