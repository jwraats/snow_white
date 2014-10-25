<?php
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php?page=login"</script>';exit;
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

if(isset($_GET['addFriend'])){
	if(!$db->addFriend($_GET['id'])){
		echo '<script> window.location = "./index.php?page=home&error=Er is een fout opgetreden"</script>';exit;
	}
} elseif(isset($_GET['delFriend'])){
	if(!$db->delFriend($_GET['id'])){
		echo '<script> window.location = "./index.php?page=home&error=Er is een fout opgetreden"</script>';exit;
	}
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

$images = array();
foreach(scandir($imageDir, 1) as $img){
	$imgArray = explode("_", $img);
	if(isset($imgArray[0]) && isset($imgArray[1]) && isset($imgArray[2])){
		if($imgArray[2] == "after"){
			if($imgArray[0] == $_SESSION['id']){
				if(!$this->checkFeedSession($imgArray[1]) && $imgArray[1] != "0"){
					$images[] = $imgArray[1];
				}
			}
		}
	}
}

?>

<div class="container">
	<div class="top-bar">
		<button class="trigger-menu" id="trigger-overlay" type="button"></button>
		<?php 
		if(!$db->checkIfFriends($detail->id) && $detail->id != $_SESSION['id']){
			echo '<a class="trigger-add-friend" href="./index.php?page=home&id='.$detail->id.'&addFriend"></a>';
		} else{
			if($detail->id != $_SESSION['id']){
				echo '<a class="trigger-remove-friend" href="./index.php?page=home&id='.$detail->id.'&delFriend"></a>';
			}else{
				echo '<a class="trigger-setting" href="./index.php?page=addAsset"></a>';
			}
		}
		?>
	</div>

	<div class="alert" style="<?php if(isset($_GET['error'])){ echo "display:block;";}?>">
		<p><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
	</div>

	<!--avatar-->
	<header class="profile">
		<div class="profile-avatar">
			<img src="<?php echo $profileImage; ?>"/>
		</div>
		<h1><?php echo $detail->first_name; ?> <?php echo $detail->last_name; ?></h1>
		<h2><?php echo $detail->description; ?></h2>
		<div class="full">
			<div class="third">
				<a href="./index.php?page=home<?php if(isset($_GET['id'])){ echo "&id=".$_GET['id']; } ?>" class="profile video"><?php echo $countFeeds; ?></a>
			</div>
			<div class="third">
				<a href="./index.php?page=home&friends<?php if(isset($_GET['id'])){ echo "&id=".$_GET['id']; } ?>" class="profile photo"><?php echo $countFriends; ?></a>
			</div>
			<div class="third">
				<a href="./index.php?page=home&likes<?php if(isset($_GET['id'])){ echo "&id=".$_GET['id']; } ?>" class="profile likes">0000</a>
			</div>
		</div>
	</header>

	<section class="profile-content">

		<?php
		if(isset($_GET['friends'])){
			echo '<table class="friend">
				<tr class="friend-row">';
			if($friends){
				$countRow = 0;
				foreach($friends as $friend){
					$profileImageFriend = "/images/".$friend->id."_0_default.jpeg";
					if(!file_exists(".".$profileImageFriend)){
						$profileImageFriend = "/assets/img/avatar.png";
					}
					$countRow++;
					echo 
						'<td class="friend-item">
							<a href="./index.php?page=home&id='.$friend->id.'">
								<img class="feed-img" src="'.$profileImageFriend.'">
								<p>'.$friend->first_name.' '.$friend->last_name.'</p>
							</a>
						</td>';
					if(($countRow % 4) == 0){
						echo '</tr><tr class="friend-row">';
					}
				}
			}
			echo '</tr>
					</table>';
		}
		else{
			if($feeds){
				foreach($feeds as $feed){
					$tags = $db->getTagsByFeedId($feed->id);
					echo '<a href="./index.php?page=detail&id='.$feed->id.'">
						<div class="feed-item">
							<h3>'.$feed->title.'</h3>
							<img class="feed-img" src="./images/'.$feed->user_id.'_'.$feed->session.'_after.jpeg">
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
