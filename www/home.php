<?php
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php"</script>';
}
?>

<div class="top-bar">
	<a class="trigger-menu" href="#"></a>
	<a class="trigger-settings" href="#"></a>
</div>
<!--avatar-->
<header class="profile">
	<img src="assets/img/avatar.png" class="profile-avatar"/>
	<h1>Jasper van Naarden</h1>
	<h2>Simon aka Grumpy Cat loves sleeping and getting cuddled</h2>
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
</section>
