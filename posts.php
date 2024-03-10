<?php
    session_start();
    include('config/database_connect.php');
    $username = mysqli_real_escape_string($conn, $_SESSION['email']);
    $sql = "SELECT * FROM recipe WHERE email='$username'";
    $result = mysqli_query($conn, $sql);
    $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);  
?>
<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>
	<h4 class="center grey-text">Recipes!</h4>
	<div class="container">
		<div class="row">
			<?php foreach($recipes as $recipe): ?>
				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($recipe['title']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $recipe['ingredients']) as $items): ?>
									<li><?php echo htmlspecialchars($items); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="info.php?id=<?php echo $recipe['id'] ?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php include('templates/footer.php'); ?>
</html>
