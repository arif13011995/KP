<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Mediawave | Get Data Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="images/favicon.png">
    
	<!-- CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/flexslider.css" rel="stylesheet" type="text/css" />
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/owl.carousel.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/colors/" rel="stylesheet" type="text/css" id="colors" />
    
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500italic,700,500,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">	
    
	<!-- SCRIPTS -->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if IE]><html class="ie" lang="en"> <![endif]-->
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery.nicescroll.min.js" type="text/javascript"></script>
	<script src="js/superfish.min.js" type="text/javascript"></script>
	<script src="js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="js/animate.js" type="text/javascript"></script>
	<script src="js/myscript.js" type="text/javascript"></script>
	
</head>
<body>

<!-- PRELOADER -->
<img id="preloader" src="images/preloader.gif" alt="" />
<!-- //PRELOADER -->
<div class="preloader_hide">

	<!-- PAGE -->
	<div id="page" class="single_page">
	
		<!-- HEADER -->
		<header>
			
			<!-- MENU BLOCK -->
			<div class="menu_block">
			
				<!-- CONTAINER -->
				<div class="container clearfix">
					
					<!-- LOGO -->
					<div class="logo pull-left">
						<a href="index.php" ><img src="images/favicon.png" width="89px" height="63px" alt="Mediawave"></a>
					</div><!-- //LOGO -->
										
					<!-- MENU -->
					<div class="pull-right">
						<nav class="navmenu center">
							<ul>
								<li class="first active scroll_btn"><a href="index.php" >Home</a></li>
								<li class="scroll_btn"><a href="logout.php" >Log Out</a></li>
							</ul>
						</nav>
					</div><!-- //MENU -->
				</div><!-- //MENU BLOCK -->
			</div><!-- //CONTAINER -->
		</header><!-- //HEADER -->
		
		
		<!-- BREADCRUMBS -->
		<section class="breadcrumbs_block clearfix parallax">
			<div class="container center">
				<h2><b>Media</b>Wave</h2>
				<p>Your data...</p>
			</div>
		</section><!-- //BREADCRUMBS -->
		
		
		<!-- BLOG -->
		<section id="blog">
		<?php
		error_reporting(0);
		$screen_name = $_POST['screen_name'];


		set_time_limit(0);

		//include the twitteroauth library
		//require_once('C:/xampp/htdocs/localphp/connection.php');
		require_once('twitteroauth.php');

		require_once('token_twitter.php');

		try {
		 $db = new PDO('mysql:host=localhost;ports=3360;dbname=datatwitter', 'root','') or die("cant connect");
		 $db->exec("SET CHARACTER SET utf8"); 

		$cursor = -1;


		while($cursor != 0){
			if($cursor != 0)
				$loc = 'friends/list.json?cursor='.$cursor.'&screen_name='.$screen_name.'&count=200';
			else
				break;

			$data = (array)$connection->get($loc);
			   // print_r($data);
			   echo "\r\n";
			// echo "count: ".sizeof($data['users'])."\n ";
		 
			foreach($data['users'] as  $bebas){

			 $sql = "INSERT IGNORE INTO get_list_following VALUES
					(
					 '".$screen_name."'
					, '".$bebas->created_at."'
					, '".$bebas->id_str."'
					, '".$bebas->screen_name."'
					, '".$bebas->name."'
					, '".$bebas->followers_count."'
					, '".$bebas->friends_count."'
					, '".$bebas->statuses_count."'
					, '".$bebas->location."'
					, '".$bebas->description."'
					,now()
					, ".$data['next_cursor_str']."
					)";
				
					$masuk = $db->exec($sql);
					
				 }
			
			
			$cursor = $data['next_cursor_str'];
			//echo"Last Cursor :".$cursor;
			echo "\r\n";
			}
		}
		catch(PDOException $e) {
		  echo $e->getMessage();
		}

		?>			

		<div class="container">	
		  <h2><b>List </b>Followers</h2>   
		    <a href="download_following.php?screen_name='<?php echo $screen_name;?>'" target="_blank"><button type="button" class="btn btn-default">Download This Data</button></a>

		  <table class="table table-striped">
		    <thead>
		      <tr>
		      	<th style="width:25px" align="center">No</th>
		        <th>Official</th>
		        <th>Created_at</th>
		        <th>ID_STR</th>
		        <th>Screen Name</th>
		        <th>Name</th>
		        <th>Followers Count</th>
		        <th>Friends Count</th>
		        <th>Status Count</th>
		        <th>Location</th>
		        <th>Description</th>
		        
		      </tr>
		    </thead>
		    <tbody>
			      <?php 
			      $sql1 =$db->query("select * from get_list_following where official = '".$screen_name."'");
			      $i=1;
			      while ($row=$sql1->fetch(PDO::FETCH_ASSOC)) {
			      	?>
			      	<tr>
			        <td align="center"><?php echo $i;?></td>
			        <td><?php echo $row['official'];?></td>
			       	<td><?php echo $row['created_at'];?></td>
			       	<td><?php echo $row['id_str'];?></td>
			       	<td><?php echo $row['screen_name'];?></td>
			       	<td><?php echo $row['name'];?></td>
			       	<td><?php echo $row['followers_count'];?></td>
			       	<td><?php echo $row['friend_count'];?></td>
			       	<td><?php echo $row['status_count'];?></td>
			       	<td><?php echo $row['location'];?></td>
			       	<td><?php echo $row['description'];?></td>
			       	
			        </tr>
			        <?php
			        if($i==10){
			        	goto c;
			        }
			        $i++;
			        
			        
			      }
			      ?>
			       <?php c: ?>
            </tbody>
		  </table>
		 </div>
		
		
	</section><!-- //BLOG -->
	</div><!-- //PAGE -->
	<!-- CONTACTS -->

	<section id="contacts">
	</section><!-- //CONTACTS -->
	 
		<div class="container">
		<h3>Untuk melihat lebih lanjut data di atas silahkan klik tombol <a href="download_following.php?screen_name='<?php echo $screen_name;?>'" target="_blank"><b>Download</b></a> untuk melihat data tersebut</h3>
		</div>
		
		<br>
		<br>
		<br>
		<br>

	<!-- FOOTER -->
	<footer>
			
		<!-- CONTAINER -->
		<div class="container">
			
		</div><!-- //CONTAINER -->
	</footer><!-- //FOOTER -->
	
	
	<!-- MAP -->
	<div id="map">
		
	</div><!-- //MAP -->

</div>
</body>
</html>
