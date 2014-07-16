<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/feed.css">
	</head>
	<body>
		<div id="feed_main_div">
			<?php $con=mysqli_connect("localhost","root","","freeforsale"); ?>
			<?php foreach ($feeds as $item):?>
				<?php echo '<div class="feed_items" id="feed_item_'.$item['ID'].'">
								<span class="feed_item_messages">'.$item['message'].'</span>';
								$sql = "SELECT * FROM likes WHERE feedID='".$item['ID']."' AND ipID='".$ipID."'";
								$result = mysql_query($sql) or die(mysql_error());
								$row = mysql_fetch_array($result); 
								$num_results = mysql_num_rows($result);
								if($num_results == 0){
									echo '<a href="#" class="like_buttons">Spread</a>';
								}else{
									echo '<span class="afterlike_messages">You&#39;ve Spread The Word!</span>';
								}
							echo '</div>';
				
				?>
			<?php endforeach?>
		</div>
		<input type="text" id="feed_input_text" />
		<input type="hidden" id="input_lat_hidden"/>
		<input type="hidden" id="input_long_hidden"/>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="/js/feed.js"></script>
	</body>
</html>