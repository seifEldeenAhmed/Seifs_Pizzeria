<?php
//error handling
include('config/db_connect.php');
$errors = ['email' => '', 'pizza_title' => '', 'ingredients' => ''];
$email = $pizza_title = $ingredients = '';
// form validation 

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'enter a valid email format';
        }
    }
    //title check contains upper and lower cases + spaces only 
    if (empty($_POST['pizza_title'])) {
        $errors['pizza_title'] = 'enter the pizza title';
    } else {
        $pizza_title = $_POST['pizza_title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $pizza_title)) {
            $errors['pizza_title'] = "enter valid title";
        }
    }
    //ingredients check comma-separated
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'enter at least one ingredient';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = "enter correct ingredient format";
        }
    }
    

    if (array_filter($errors)) {
        // Handle errors here, you can display an error message if needed.
    } else {
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);
        $pizza_title=mysqli_real_escape_string($conn,$_POST['pizza_title']);
        $query="INSERT INTO pizzas(email, ingredients, pizza_title) values('$email', '$ingredients', '$pizza_title')";
        $sql=mysqli_query($conn,$query);

        header('Location: index.php');
        exit; // Make sure to exit to prevent further code execution.
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("template/header.php"); ?>
<section class="container grey-text">
    <h4 class='center'>Add your pizza</h4>
    <form class="white" action="add.php" method="POST">
        <label>Add your email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Pizza title</label>
        <input type="text" name="pizza_title" value="<?php echo htmlspecialchars($pizza_title) ?>">
        <div class="red-text"><?php echo $errors['pizza_title']; ?></div>
        <label>Ingredient(comma separated)</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        <div class='center'>
            <input type="submit" name='submit' value="submit" class='btn brand z-depth-0'>
        </div>
    </form>
</section>
<?php include("template/footer.php"); ?>
</html>
