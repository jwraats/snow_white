
<?php
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php"</script>';exit;
}

if(isset($_GET['id'])){
	$detail = $db->getUserByID($_GET['id']);
}
else{ //Show own profile
	$detail = $db->getUserByID($_SESSION['id']);
}

if(!$detail){
	echo "User not existing";
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
