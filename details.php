<!DOCTYPE html>
<html lang="en">
<?php 
include('config/db_connect.php');
if(isset($_POST['delete'])){
    $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
    if(mysqli_query($conn,$sql)){
        header("location:index.php");
    }else{
        echo 'this pizza is not found'. mysqli_error($conn);

    }
    
}
if(isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $sql="SELECT *FROM pizzas where id=$id";
    $query=mysqli_query($conn,$sql);
    $pizza=mysqli_fetch_assoc($query); 
    mysqli_free_result($query);
    mysqli_close($conn);
}

?>
<?php
include('template/header.php');
?>
<div class="container">
    <div class="card center">
        <ul>
            <?php if ($pizza):?>
            <?php foreach($pizza as $element): ?>
                <li class='center'><h5 class="grey-text"><?php echo htmlspecialchars($element) ?></h5></li>
                <?php endforeach?>
                <?php else:
                    echo "No such pizza exists";
                ?>
                <?php endif?>
                
        </ul>
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    </div>
</div>
<?php
include('template/footer.php');
?>


</html>