<?php 
    include('config/database_connect.php');
    $username = $password = '';
    $errors = array('username' => '', 'password' => '');

    if(isset($_POST['submit'])) {
        if(empty($_POST['username'])){
			$errors['username'] = 'An email is required';
		} else {
            $username = $_POST['username'];
            if(!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $errors['username'] = 'Email is not valid'; 
            }
        }
        if(empty($_POST['password'])){
			$errors['password'] = 'A password is required';
		} else if(strlen($_POST['password']) < 6) {
            $errors['password'] = 'Password must be 6 characters or more';
        } else {
            $password = $_POST['password'];
        }
        
        if(!array_filter($errors)){
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
            $sql = "SELECT * FROM users WHERE username='$username' AND pwd='$password'";
            $result = mysqli_query($conn, $sql);
            $all_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if($_GET['action'] == "signup") {
                if(empty($all_users)) {
                    $sql2 = "INSERT INTO users(username,pwd) VALUES('$username','$password')";
                    if(mysqli_query($conn, $sql2)){
                        header('Location: index.php');
                    }
                    header('Location: index.php');
                } else {
                    $errors['username'] = "Email Already in Use";
                }
            } else {
                if(empty($all_users)) {
                    $errors['username'] = "Incorrect Email or Password";
                } else {
                    session_start();
                    $_SESSION['status'] = "Logged In";
                    $_SESSION['email'] = $username;
                    header('Location: index.php');
                }
            }
		}
    }
?>


<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
	<section class="container grey-text">
        <?php if($_GET['action'] == "signup"): ?>
            <h4 class="center">Sign Up</h4>
        <?php else:  ?>
            <h4 class="center">Log In</h4>
        <?php endif;?>
		<form class="white" action="login.php?action=<?php echo $_GET['action'] ?>" method="POST">
			<label>Email</label>
			<input type="text" name="username"?>
			<div class="red-text"><?php echo $errors['username']; ?></div>
			<label>Password</label>
			<input type="text" name="password"?>
			<div class="red-text"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
    <?php include('templates/footer.php'); ?>
<html>