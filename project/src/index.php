<?php require_once './database.php'; ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>SHOUT IT!</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
	<div id="container">
		<header>
			<h1>SHOUT IT! Shoutbox</h1>
		</header>
		<div id="shouts">
			<ul>

				<?php

				function getShouts($pdo)
				{
					$sql = 'SELECT user,message, time from shouts ORDER BY id DESC';
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}

				$shouts = getShouts($pdo);

				if (!empty($shouts)) {
					foreach ($shouts as $shout) {
						$user = htmlspecialchars($shout['user']);
						$message = htmlspecialchars($shout['message']);
						$time = date('g:i A', strtotime($shout['time']));

						echo ' <li class="shout">';
						echo ' <span>' . $time . '  - </span>';
						echo $user . ' : ' . $message . ' </li>';
					}
				}
				?>
			</ul>

		</div>
		<div id="input">
			<form method="post" action="process.php">
				<input type="text" name="user" placeholder="Enter Your Name" />
				<input type="text" name="message" placeholder="Enter A Message" />
				<br />
				<input class="shout-btn" type="submit" name="submit" value="Shout It Out" />
			</form>
		</div>
	</div>
</body>

</html>
