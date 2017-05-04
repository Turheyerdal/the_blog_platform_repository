<!DOCTYPE>
<html>

<head>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<?php


		
		
		session_start();
		if (isset($_SESSION['login']) ) {
			$login = $_SESSION['login'];
		} else {
			header("Location:login.html") ;
			
		}
		

		
		?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link media="screen" rel="stylesheet" type="text/css" href ="main_style.css?version=1"/>

</head>
	<body>
		
		
		
		<header>
		<div class="center">
		<div class="logo">
		<?php
		echo "<h1>The page of ".$login."</h1>";
		?>
		</div>
		
		<nav>
		<ul>
		<li><a href="clear.php" style='letter-spacing:1px;'>Exit</a></li>
		<li></li>
		</ul>
		</nav>
		</div>
		</header>
		
		<div class="main">
			<form id="form_content"action="listner.php" method="POST">
				<input type="text" required=" "   oninput="setCustomValidity('')" oninvalid= "this.setCustomValidity('Please,Enter a title!')"; id="title" name="title" placeholder="Input your title"/>
				<textarea name="content" required=" "  oninput="setCustomValidity('')"  oninvalid= "this.setCustomValidity('Please,Enter content!')"; placeholder = "References, objects, notes, books" maxlength="500"></textarea>
				
				<button id="btn" type="submit">Publish</button>
				
			</form method="POST"action="search.php">
			<form>
			<input type="text" required=" "  id="search" name="search" placeholder="Search by title"/>
			<button id="btn_search" type="submit">Search</button>
			</form>
			
		</div>
		
		<div class="main">
		
		<hr noshade size="1" width="100%"color="#4B2162" style="margin-top:60px;">
		

	
		
			<?php
			
			$link = mysqli_connect('localhost', 'root', 'vertrigo') or die('Unable to connect our db: ' . mysqli_error());
			mysqli_select_db($link,'notes') or die('Unable to use our db: ');
			mysqli_query($link,"SET NAMES 'utf8'"); 
			mysqli_query($link,"SET CHARACTER SET 'utf8'");
			mysqli_query($link,"SET SESSION collation_connection = 'utf8_general_ci'");
			
			$status='ready';
			
			$sql = "SELECT * FROM post_information WHERE status='{$status}'and author ='{$login}' ORDER BY timestamp DESC";
			$result = mysqli_query($link,$sql) or die(mysqli_error($link));
			
			
			while ($row = mysqli_fetch_assoc($result)) {
				
				$author = $row['author'];
				$content_text = $row['content'];
				$title_text = $row['title'];
				$date = $row['date'];
			
			echo "
			
			<div class='all_article'>
			
			<p class='date'>Date:{$date}</p>
			<p class='author'>Author:{$author}</p>
			
			<div class='content_manager'>
			 <h2 class='title_of_article'>Title:{$title_text}</h2>
			 <p>
				{$content_text}
			 </p>
			</div>
			</div>";};
		?>
		</div>
	</body>
</html>