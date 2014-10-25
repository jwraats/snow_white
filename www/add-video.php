<?php

# check login
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php?page=login"</script>';exit;
} else {
	$user_id = $_SESSION['id'];
}
?>
<div class="container">
	<div class="top-bar">
		<button class="trigger-menu" id="trigger-overlay" type="button"></button>
		<a class="trigger-remove-friend" href="#"></a>
	</div>

	<!--avatar-->
	<header class="profile friends">

		<form>
			<fieldset>
				<input type="text" name="title" id="title" placeholder="Title">
				<textarea type="text" name="message" id="message">Message</textarea>				
			</fieldset>
		</form>

	</header>

	<section id="photo">

		<form>
			<fieldset>
				<table class="friend">
							<tr class="friend-row">
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
							</tr>
							<tr class="friend-row">
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
								<td class="friend-item">
									<a href="" />
										<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
									</a>
								</td>
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
								<td class="friend-item">
									<a href="" />
										<img class="feed-img" src="'.$profileImageFriend.'">
									</a>
								</td>
							</tr>
						</table>
				<button type="submit" value="Log In">Add photo</button>
			</fieldset>
		</form>

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
