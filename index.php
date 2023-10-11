<!DOCTYPE html>
<html lang="en">
<?php
include('config/db_connect.php');
//building my query
$query = 'SELECT id, email, pizza_title, ingredients from pizzas order by created_at';
//data retrieval
$result= mysqli_query($conn,$query);
//fetching data
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);


//free the memory of unused data
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>
<?php
include('template/header.php');
?>
<h4 class="center grey-text"> Pizzas
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza){?>
                <div class="col s6 md3">
                    <div class="card">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['pizza_title']); ?></h6>
                            <ul>
                                <?php foreach(explode(',',$pizza['ingredients'])as $ing){ ?>
                                    <li><h6><?php echo htmlspecialchars($ing); ?></h6></li>
                                    
                                <?php }?>
                                
                            </ul>
                        </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php ?id=<?php echo $pizza['id']?>">More info</a>
                    </div>
                    </div>
                    
                </div>

            <?php }?>
        </div>
</div> 
</h4>

<?php include('template/footer.php') ?>
</html>