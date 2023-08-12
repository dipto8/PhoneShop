<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Phoniest</h1>
<h3>Your mobile phone store</h3>
        </header>
        <?php 
            require_once("db_connect.php");
            if(empty($_GET['phone_id'])){
                echo"<p>Error: Phone ID could not be found</p>";
                 echo '<a href="mobile_phone.php"> See Phones List</a>';
                exit();
            }else {
                $phone_id = $_GET['phone_id'];
                $query = 'select * from phones where phone_id = ?';
                $stmt =  mysqli_prepare($dbc,$query);
                mysqli_stmt_bind_param($stmt,'i',$phone_id);
                $result = mysqli_stmt_execute($stmt);
                 echo '<a href="mobile_phone.php"> See Phones List</a>';
                if($result){
                    $result = mysqli_stmt_get_result($stmt);
                    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $brand=$row['brand'];
                    $model=$row['model'];
                    $quantity=$row['quantity'];
                    $price=$row['price'];
                    $description=$row['description'];
                  
                }
            }
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $errors = array();

                

                //  Fields Validation
                if (empty($_POST['brand'])) {
                    $errors['brand'] = "Phone Brand can not be an empty field";
                }

               
                if (empty($_POST['model'])) {
                    $errors['model'] = "Model Can not be an Empty field";
                }

                if (empty($_POST['quantity'])) {
                    $errors['quantity'] = "Quantity field should be a number and should not be empty field";
                }
                
                if (empty($_POST['price'])) {
                    $errors['price'] = "Price can not be empty field";
                } elseif (!preg_match("/^\d+(,\d{3})*(\.\d{1,2})?$/", $_POST['price'])) {
                    $errors['price'] = "Dec format should be used for price field(999.99)";
                }
  
  if (empty($_POST['description'])) {
                    $errors['description'] = "A description should be added";
                }

                if (count($errors) == 0) {
                    
                    require_once('db_connect.php');
                    $query = "UPDATE phones SET brand=?, model=?, quantity=?, price=?, description=? WHERE phone_id=?";
                    $stmt = mysqli_prepare($dbc, $query);
                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssissi",
                        $_POST['brand'],
                        $_POST['model'],
                        $_POST['quantity'],
                        $_POST['price'],
                        $_POST['description'],
                        $phone_id
                    );
                    $result = mysqli_stmt_execute($stmt);
                    if($result){
    
                        header('Location: mobile_phone.php');
                        exit();
                    }
                    else{
                        echo "<h3 class='error'> Error found during processing the data ".mysqli_error($dbc);
                    }
                        }
            }
        ?>
    <form method="POST" enctype="multipart/form-data">
           <h3> Mobile Phone to be modified in system </h3>    
            <div>
            <label for="phone brand" >Brand</label>
            <input type="text"  id="brand" name="brand" value="<?php echo $brand;?>"/>
            <span><?php echo isset($errors['brand']) ? $errors['brand'] : ''; ?></span>                
            </div>

            
            <div>
            <label for="phone model" >Model:</label>
            <input type="text"  id="model" name="model" value="<?php echo $model;?>"/>
            <span><?php echo isset($errors['model']) ? $errors['model'] : ''; ?></span>
            </div>
            
            <div>
            <label for="Phone Quantity" >Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $quantity;?>"/>
            <span><?php echo isset($errors['quantity']) ? $errors['quantity'] : ''; ?></span>
            </div>
            <div>    
            <label for="phone price" >Price:</label>
            <input type="text" id='price' name='price' value="<?php echo $price;?>"/>
            <span><?php echo isset($errors['price']) ? $errors['price'] : ''; ?></span>
            </div>
            <div>
            <label for="description" >Description:</label>
            <textarea rows=4 cols=40 id="description" name="description"><?php echo $description;?></textarea>
            <span><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
            </div>
            
            <div>
            <input type="submit" value="Modify - Confirm"/>               
            </div>

        </form>
    </body>
</html>











