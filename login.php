<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.png">
    

    <title>Key</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">


    <link href="css/signin.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>
	
	<script src="js/jquery-2.1.0.min.js" ></script>

	<link rel="stylesheet" type="text/css" href="css1.css">
	<script src="js1.js"></script>
  </head>
<body>
<div id="formWrapper">

    <div id="form">
        <div id="logo">
                <form action="validasi.php" method="post">
                <h2 class="form-signin-heading">Please insert following key...</h2>
                		<div class="form-item">
                			<p class="formLabel">Consumer Key (API Key)</p>
                			<input type="text"  name="api" id="api" class="form-style" autocomplete="on"/>
                		</div>

                		<div class="form-item">
                			<p class="formLabel">Consumer Secret (API Secret)</p>
                			<input type="text" id="api_secret" name="api_secret" class="form-style" autocomplete="off"/>
                		</div>

                		<div class="form-item">
                			<p class="formLabel">Access Token</p>
                			<input type="text"  name="token" id="token" class="form-style" autocomplete="off"/>
                		</div>

                		<div class="form-item">
                			<p class="formLabel">Access Token Secret</p>
                			<input type="text" id="token_secret" name="token_secret" class="form-style" autocomplete="off"/>
                		</div>
                		
                		<div class="form-item">
                		<input type="submit" class="login pull-right" name="submit" value="Submit">
                		<div class="clear-fix"></div>
                		</div>
                </form>
        </div>
    </div>
  </div>
</body>
</html>