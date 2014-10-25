
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
$feeds = $db->getFeedByUserId($detail->id);
if($feeds){
	$countFeeds = count($feeds);

	//Dirty fix for a Layout problem :P
	if($countFeeds < 10){
		$countFeeds = "00".$countFeeds;
	}
	else if($countFeeds < 100){
		$countFeeds = "0".$countFeeds;
	}
}
else{
	$countFeeds = 0;
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
				<a href="#" class="profile video"><?php echo $countFeeds; ?></a>
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
		<?php
			if($feeds){
				foreach($feeds as $feed){
					$tags = $db->getTagsByFeedId($feed->id);
					echo '<a href="">
						<div class="feed-item">
							<h3>'.$feed->title.'</h3>
							<img class="feed-img" src="assets/img/avatar.png">
							<p>'.$feed->message.'</p>
							<p class="tags"><span>tags:</span>';
								if($tags){
									foreach($tags as $tag){
										echo '#'.$tag->hashTag.' ';
									}
								}
								else{
									echo 'No tags atm';
								}
							echo '</p>
						</div>
					</a>';
				}
			}
		?>
	</section>
</div>
