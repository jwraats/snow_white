<?php

# check login
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php?page=login"</script>';exit;
} else {
	$user_id = $_SESSION['id'];
}

$detail = $db->getUserByID($_SESSION['id']);

if(!$detail){
	echo "User not existing";
	exit;
}

if(isset($_POST['title']) && isset($_POST['picture']) && isset($_POST['message'])){
	if($db->addFeed($_POST['picture'], $_POST['title'], $_POST['message'])){
		echo '<script> window.location = "./index.php?page=home"</script>';exit;
	}
	else{
		echo '<script> window.location = "./index.php?page=home&error=Something went wrong"</script>';exit;
	}
}

$images = array();
foreach(scandir($imageDir, 1) as $img){
	$imgArray = explode("_", $img);
	if(isset($imgArray[0]) && isset($imgArray[1]) && isset($imgArray[2])){
		if($imgArray[2] == "after.jpeg"){
			if($imgArray[0] == $_SESSION['id']){
				if(!$db->checkFeedSession($imgArray[1]) && $imgArray[1] != "0"){
					$images[] = $imgArray[1];
				}
			}
		}
	}
}

if(count($images) < 0){
 echo '<script> window.location = "./index.php?page=home&error=No mirror images yet!"</script>';exit;
}
?>
<div class="container">
	<div class="top-bar">
		<button class="trigger-menu" id="trigger-overlay" type="button"></button>
	</div>

	<!--avatar-->
	<?php 
	if(isset($_GET['session']) && is_numeric($_GET['session'])){
		$imageUrl = "/images/".$detail->id."_".$_GET['session']."_after.jpeg";
		echo '<header class="profile friends">
			<img class="feed-img" src="'.$imageUrl.'" style="width:200px;height:150px;" />
			<form method="post" action="index.php?page=add-video">
				<fieldset>

					<input type="text" name="title" id="title" placeholder="Title">
					<input type="hidden" name="picture" value="'.$_GET['session'].'"/>
					<textarea type="text" name="message" id="message"></textarea>			
					<button type="submit" value="Log In">Add photo</button>	
				</fieldset>

			</form>

		</header>';
	}
	else{
?>
<section id="photo">

		<form>
			<fieldset>
				<table class="friend">
					<tr class="friend-row">
					<?php
						$countRow = 0;
						foreach($images as $img){
							$imageUrl = "/images/".$detail->id."_".$img."_after.jpeg";
							if(file_exists(".".$imageUrl)){
								$countRow++;
								echo 
									'<td class="friend-item">
										<a href="./index.php?page=add-video&session='.$img.'">
											<img class="feed-img" src="'.$imageUrl.'">
										</a>
									</td>';
								if(($countRow % 4) == 0){
									echo '</tr><tr class="friend-row">';
								}
							}
							
							
						}
					?>
							
							</tr>
						</table>
			</fieldset>
		</form>

	</section>
<?php
	}

	?>
	

	

	<div class="overlay overlay-slidedown">
		<button type="button" class="overlay-close">Close</button>
		<nav>
			<ul>
				<li><a href="./index.php?page=dashboard">Dashboard</a></li>
				<li><a href="./index.php?page=home">Profile</a></li>
				<li><a href="./auth.php?logout">Logout</a></li>
			</ul>
		</nav>
	</div>
</div>
