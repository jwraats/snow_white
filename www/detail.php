<?php

# check login
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php?page=login"</script>';exit;
} else {
	$user_id = $_SESSION['id'];
}
$detail = false;
if(isset($_GET['id'])){
	$detail = $db->getFeedById($_GET['id']);
}

if(!$detail){
	  echo '<script> window.location = "./index.php?page=home&error=No feed.."</script>';exit;
}
$profileImage = "/images/".$detail->user_id."_0_default.jpeg";
if(!file_exists(".".$profileImage)){
	$profileImage = "/assets/img/avatar.png";
}

$tags = $db->getTagsByFeedId($detail->id);

?>
<div class="container">
	<div id="detail">
		<div class="top-bar">
			<button class="trigger-menu" id="trigger-overlay" type="button"></button>
		</div>

		<div id="cf">
		  <img class="bottom" src="<?php echo './images/'.$detail->user_id.'_'.$detail->session.'_before.jpeg'; ?>" />
		  <img class="top" src="<?php echo './images/'.$detail->user_id.'_'.$detail->session.'_after.jpeg'; ?>" />
		</div>


		<section class="profile-content">
			<div class="detail-item">
				<img class="detail-img" src="<?php echo $profileImage; ?>">
				<h3><?php echo $detail->title; ?></h3>
				<p><?php echo $detail->message; ?></p>
				<p class="tags"><span>tags:</span><?php if($tags){
									foreach($tags as $tag){
										echo '#'.$tag->hashTag.' ';
									}
								}
								else{
									echo 'No tags atm';
								}?></p>
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

		<div class="overlay overlay-slidedown">
			<button type="button" class="overlay-close">Close</button>
			<nav>
				<ul>
					<li><a href="#">Dashboard</a></li>
					<li><a href="./index.php?page=home">Profile</a></li>
					<li><a href="./auth.php?logout">Logout</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>
