<?php
session_start();
require_once 'includes/functionload.php';

if(isConnect())
{
	if(verifSessionController())
	{
		if(!isTimeout())
		{
			updateUser();
			if(isBanni())
			{
				header("Location: index.php?p=connexion&n=6");	
				session_destroy();
				die();
			}
		}
		else
		{
			header("Location: index.php?p=connexion&n=5");
			session_destroy();
			die();
		}
	}
	else
	{
		header("Location: index.php?p=connexion&n=4");
		session_destroy();
		die();
	}
}
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>Failywood - Pannel Admin</title>
	    <!-- Bootstrap Core CSS -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/small-business.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>

	<body>
		<?php require_once 'includes/menu.php';?>
		<!---->

		 <div id="wrap">
	    <div class="container" style ="margin-top:100px"><!-- Page Content -->
	    	<div class="row"><!-- Heading Row -->
	            <div class="col-md-12">
	    		<?php
	        		
					require_once 'includes/notification.php';

	        		$page = "";
					if(isset($_GET['p'])){
						$page = $_GET['p'];
					}
					if($page == "" || $page == "index"){
						if(file_exists("pages/default.php"))
							include 'pages/default.php';
					}else{
						if(preg_match("#^[a-zA-Z0-9]+$#", $page)){
							if(file_exists("pages/".$page.".php")){
								include "pages/".$page.".php";
							}
							else{
								if(file_exists("pages/404.php"))	
									include "pages/404.php";
							}
						}
						else{
							if(file_exists("pages/404.php"))
								include "pages/404.php";
						}
					}
	        	?>
	        	</div>
	        </div>
	    </div><!-- /.container -->

    <div id="push"></div></div>
    <div id="footer">
      <div class="container">
        <p class="muted credit"><center>Copyright &copy; FailyWood 2015</center></a>.</p>
      </div>

    </div>
    
	    <!-- jQuery -->
	    <script src="js/jquery.js" type="text/javascript"	></script>
	    <!-- Bootstrap Core JavaScript -->
	    <script src="js/bootstrap.min.js"></script>
	    <script src="js/tablesorter.js" type="text/javascript"></script>

	</body>

</html>