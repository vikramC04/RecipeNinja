<?php
    include('config/database_connect.php');
    $email = $title = $ingredients = $procedure = '';
	$errors = array('email' => '', 'title' => '', 'ingredients' => '', 'procedure' => '');
    if(isset($_POST['submit'])){
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email address is not valid';
			}
		}
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] = 'At least one ingredient is required';
		} else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}
        $procedure = trim($_POST['procedure'], " ");
        if(strlen($procedure) == 0){
			$errors['procedure'] = 'Steps to prepare are necessary.';
		} 
		if(!array_filter($errors)){
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
            $procedure = mysqli_real_escape_string($conn, $_POST['procedure']);
			$sql = "INSERT INTO recipe(title,email,ingredients,procedure_steps) VALUES('$title','$email','$ingredients','$procedure')";
			if(mysqli_query($conn, $sql)){
				header('Location: index.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
	<section class="container grey-text">
		<h4 class="center">Add a Recipe</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Recipe Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label>ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
			<div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <label>Procedure</label>
            <textarea id="procedure" type="text" name="procedure" rows="4" cols="50" >
                <?php echo htmlspecialchars($procedure) ?>
            </textarea>
            <div class="red-text"><?php echo $errors['procedure']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>