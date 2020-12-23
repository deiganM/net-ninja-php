<?php

include 'config/db_connect.php';

$title = $email = $ingredients = '';

$errors = [
    'email' => '',
    'title' => '',
    'ingredients' => '',
];

if (isset($_POST['submit'])) {
    //check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Must be a valid email address";
        }
    }

    //check title
    if (empty($_POST['title'])) {
        $errors['title'] = 'A title is required <br />';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }
    //check ingredients
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'Ingredients are required <br />';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'ingredients must be a comma separated list';
        }
    }
    if (array_filter($errors)) {
        // echo 'Errors in the form';
    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        // create sql
        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title', '$email', '$ingredients')";

        // save to bd
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php');
        } else {
            // error
            echo 'query error: ' . mysql_error($conn);
        }

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
    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
    <div class="red-text"><?=$errors['email'];?></div>

    <label>Pizza Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
    <div class="red-text"><?=$errors['title'];?></div>

    <label>Ingredients (comma separated):</label>
    <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
    <div class="red-text"><?=$errors['ingredients'];?></div>

    <div class="center">
      <input type="submit" name="submit" class="btn brand z-depth-0">
    </div>
  </form>
</container>

<?php include 'templates/footer.php'?>


</html>