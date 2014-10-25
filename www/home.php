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
$profileImage = "/images/".$detail->id."_0_default.jpeg";
if(!file_exists(".".$profileImage)){
	$profileImage = "/assets/img/avatar.png";
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
$friends = $db->getFriendsByUserId($detail->id);

if($friends){
	$countFriends = count($friends);

	//Dirty fix for a Layout problem :P
	if($countFriends < 10){
		$countFriends = "00".$countFriends;
	}
	else if($countFeeds < 100){
		$countFriends = "0".$countFriends;
	}
}
else{
	$countFriends = 0;
}
?>

<div class="container">
	<div class="top-bar">
			<button class="trigger-menu" id="trigger-overlay" type="button"></button>
			<a class="trigger-settings" href="#"></a>
		</div>

		<div class="overlay overlay-slidedown">
			<button type="button" class="overlay-close">Close</button>
			<nav>
				<ul>
					<li><a href="#">Dashboard</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Logout</a></li>
				</ul>
			</nav>
		</div>
	<!--avatar-->
	<header class="profile">
		<img src="<?php echo $profileImage; ?>" class="profile-avatar"/>
		<h1><?php echo $detail->first_name; ?> <?php echo $detail->last_name; ?></h1>
		<h2><?php echo $detail->description; ?></h2>
		<div class="full">
			<div class="third">
				<a href="./index.php?page=home" class="profile video"><?php echo $countFeeds; ?></a>
			</div>
			<div class="third">
				<a href="./index.php?page=home&friends" class="profile photo"><?php echo $countFriends; ?></a>
			</div>
			<div class="third">
				<a href="./index.php?page=home&likes" class="profile likes">5531</a>
			</div>
		</div>
	</header>

	<section class="profile-content">
		<?php
		if(isset($_GET['friends'])){
			if($friends){
				foreach($friends as $friend){
					$profileImageFriend = "/images/".$friend->id."_0_default.jpeg";
					if(!file_exists(".".$profileImageFriend)){
						$profileImageFriend = "/assets/img/avatar.png";
					}
					echo '<a href="./index.php?page=home&id='.$friend->id.'">
						<div class="feed-item">
							<h3>'.$friend->first_name.' '.$friend->last_name.'</h3>
							<img class="feed-img" src="'.$profileImageFriend.'">
							<p>'.$friend->description.'</p>
						</div>
					</a>';
				}
			}
		}
		else{
			if($feeds){
				foreach($feeds as $feed){
					$tags = $db->getTagsByFeedId($feed->id);
					echo '<a href="./index.php?page=detail&id='.$feed->id.'">
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
		}

			
		?>
	</section>
</div>
