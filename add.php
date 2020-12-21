<?php
// if (isset($_GET['submit'])) {
//     echo $_GET['email'];
//     echo $_GET['title'];
//     echo $_GET['ingredients'];
// }
if (isset($_POST['submit'])) {
    //check email
    if (empty($_POST['email'])) {
        echo 'An email is required <br />';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "Must be a valid email address"
        }
    }
    //check title
    if (empty($_POST['title'])) {
        echo 'A title is required <br />';
    } else {
        echo htmlspecialchars($_POST['title']);
    }
    //check ingredients
    if (empty($_POST['ingredients'])) {
        echo 'Ingredients are required <br />';
    } else {
        echo htmlspecialchars($_POST['ingredients']);
    }
} //end of POST check
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'templates/header.php'?>

<container class="container grey-text">
  <h4 class="center">Add a Pizza</h4>
  <form action="add.php" method="POST" class="white">
    <label>Your Email:</label>
    <input type="text" name="email">
    <label>Pizza Title:</label>
    <input type="text" name="title">
    <label>Ingredients (comma separated):</label>
    <input type="text" name="ingredients">
    <div class="center">
      <input type="submit" name="submit" class="btn brand z-depth-0">
    </div>
  </form>
</container>

<?php include 'templates/footer.php'?>


</html>