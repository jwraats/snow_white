
<?php

if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php"</script>';exit;
} else {
	$user_id = $_SESSION['id'];
}

$select_detail = $pdo->prepare('SELECT u.* FROM user u 
								INNER JOIN user f ON u.follow_id = f.id
								WHERE u.id = :user_id');

try
{	
	$select_detail->execute(array(':user_id' => $user_id));
	$detail = $select_detail->fetch(PDO::FETCH_OBJ);
	$select_detail->closeCursor();
}
catch(PDOException $e)
{
	$json['error'] = TRUE;
	$json['msg'] = 'Error executing select_detail: ' . $e->getMessage();
	exit;
}

?>

<div class="container">
	<div class="top-bar">
		<div class="container">
			<a class="trigger-menu" href="#"></a>
			<a class="trigger-settings" href="#"></a>
	<!--avatar-->
	<header class="profile">
		<img src="<?php echo $detail->picture; ?>" class="profile-avatar"/>
		<h1><?php echo $detail->first_name; ?> <?php echo $detail->last_name; ?></h1>
		<h2><?php echo $detail->description; ?></h2>
		<div class="full">
			<div class="third">
				<a href="#" class="profile video">217</a>
			</div>
			<div class="third">
				<a href="#" class="profile photo">2261</a>
			</div>
			<div class="third">
				<a href="#" class="profile likes">5531</a>
			</div>
		</div>
	</header>

	<section class="profile-content">
		<a href="">
			<div class="feed-item">
				<h3>Feed item</h3>
				<img class="feed-img" src="assets/img/avatar.png">
				<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
			</div>
		</a>

		<a href="">
			<div class="feed-item">
				<h3>Ready to party! Lets get some chick here.</h3>
				<img class="feed-img" src="assets/img/avatar.png">
				<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
			</div>
		</a>
		<a href="">
			<div class="feed-item">
				<h3>Ready to party! Lets get some chick here.</h3>
				<img class="feed-img" src="assets/img/avatar.png">
				<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
			</div>
		</a>
		<a href="">
			<div class="feed-item">
				<h3>Ready to party! Lets get some chick here.</h3>
				<img class="feed-img" src="assets/img/avatar.png">
				<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
			</div>
		</a>
		<a href="">
			<div class="feed-item">
				<h3>Ready to party! Lets get some chick here.</h3>
				<img class="feed-img" src="assets/img/avatar.png">
				<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
				<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
			</div>
		</a>
	</section>
</div>
