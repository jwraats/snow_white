<?php

# check login
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php"</script>';
}

echo $_GET['id'];
$user_id = isset($_GET['id']) ? $_GET['id'] : 'login';
$select_detail = $pdo->prepare('SELECT u.* FROM user u
								INNER JOIN user f ON u.follow_id = f.id
								WHERE u.id = :user_id');

$follow_detail = $pdo->prepare('SELECT f.* FROM user u
								INNER JOIN user f ON u.follow_id = f.id
								WHERE u.id = :user_id');

try
{
	$select_detail->execute(array(':user_id' => $user_id));
	$detail = $select_detail->fetchAll();
	$select_detail->closeCursor();
}
catch(PDOException $e)
{
	$json['error'] = TRUE;
	$json['msg'] = 'Error executing select_detail: ' . $e->getMessage();
	exit;
}

try
{
	$follow_detail->execute(array(':user_id' => $user_id));
	$follow = $follow_detail->fetchAll();
	$follow_detail->closeCursor();
}
catch(PDOException $e)
{
	$json['error'] = TRUE;
	$json['msg'] = 'Error executing follow_detail: ' . $e->getMessage();
	exit;
}

if(count($detail) > 0){
	foreach($detail as $row){
		echo $row["first_name"];
		echo "<br/>";
		echo $row["last_name"];
		echo "<br/>";
		echo $row["username"];
		echo "<br/>";
		echo $row["picture"];
		echo "<br/>";
	}
} else {
	echo 'geen resultaten';
}

if(count($follow) > 0){
	foreach($follow as $row){
		echo $row["first_name"];
		echo "<br/>";
		echo $row["last_name"];
		echo "<br/>";
		echo $row["username"];
		echo "<br/>";
		echo $row["picture"];
	}
} else {
	echo 'geen resultaten';
}


?>
<div class="container">
	<div id="detail">
		<div class="top-bar">
			<a class="trigger-menu" href="#"></a>
		</div>

		<section class="video">
			<video
			  controls preload="auto" width="100%" height="100%"
			 <source src="https://bynder-public.s3.amazonaws.com/media/3ADB5E6D-AC07-4C4F-BAC3433A3696B4FE/718/2E20025A-3420-4121-BD4FA40CF9493360/46EA2EAC-F2F0-4552-AC65663B101A28A1.webm" type='video/mp4' />
			</video>
		</section>


		<section class="profile-content">
			<div class="detail-item">
				<img class="detail-img" src="assets/img/avatar.png">
				<h3>Ready to party! Lets get some chick here.</h3>
				<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
			</div>

			<div class="full">
				<div class="third facebook"></div>
				<div class="third twitter"></div>
				<div class="third comment"></div>
			</div>

			<div class="comments">
				<h3 class="title">24 comments</h3>
				<div class="comment-item">
					<img class="comment-img" src="assets/img/guy1.jpg">
					<p class="person"><span>Mark Flanders</span> - 2 hours ago</p>
					<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				</div>
				<div class="comment-item">
					<img class="comment-img" src="assets/img/guy2.jpg">
					<p class="person"><span>Abraham Scofield</span> - 46 hours ago</p>
					<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late. Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late. Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late. Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				</div>
				<div class="comment-item">
					<img class="comment-img" src="assets/img/guy3.jpg">
					<p class="person"><span>Herman von Smallhausen</span> - 4 weeks ago</p>
					<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				</div>
			</div>

		</section>
	</div>
</div>