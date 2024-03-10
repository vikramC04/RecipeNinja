<?php
    include('config/database_connect.php');
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM recipe WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $recipes = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <div class="container center">
        <h4><?php echo htmlspecialchars($recipes['title']);?></h4>
        <p><?php echo "Created by: ".htmlspecialchars($recipes['email']);?></p>
        <p><?php echo "Post Date: ".htmlspecialchars($recipes['created_at']);?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($recipes['ingredients']);?></p>
        <h5>Recipe Instructions:</h5>
        <p><?php echo htmlspecialchars($recipes['procedure_steps']);?></p>
    </div>
    <?php include('templates/footer.php'); ?>
<html>