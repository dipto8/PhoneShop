<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="phones.css">
    </head>
    <body>
    <header>
        <h1>Phoniest</h1>
<h3>Your mobile phone store</h3>
    </header>
    <body>
        <?php 
            require_once("db_connect.php");
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $errors = array();

                // Form fields
                if (empty($_POST['phonebrand'])) {
                    $errors['phonebrand'] = "Mobile Brand Name";
                    
                }

                if (empty($_POST['model'])) {
                    $errors['model'] = "Phone Model";
                    
                }

                if (empty($_POST['quantity'])) {
                    $errors['quantity'] = "Quantity";
                }

                if (empty($_POST['price'])) {
                    $errors['price'] = "Phone Price";
                    
                } 
                if (empty($_POST['description'])) {
                    $errors['description'] = "Brief description";
                    
                } 
                

//Fields validation
elseif (!preg_match("/^\d+(,\d{3})*(\.\d{1,2})?$/", $_POST['price'])) {
                    $errors['price'] = "Value entered is not a valid format";
                    
                }
                

                if (count($errors) == 0) {
                    
//if no errors found, fields should be inserted into mobile_phone Table in database
                    require_once('db_connect.php');
                    $query = "insert into phones (brand,model,quantity,price,description) 
                    values (?,?,?,?,?)";
                    $stmt = mysqli_prepare($dbc,$query);
                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssiss",
                        $_POST['phonebrand'],
                        $_POST['model'],
                        $_POST['quantity'],
                        $_POST['price'],
                        $_POST['description']
                        
                    );
                    $result = mysqli_stmt_execute($stmt);
                    if($result){
    
                        header('Location: mobile_phone.php');
                        exit();
                    }
                    else{
                        echo "<h3 class='error'> Errors Found during processsing the data: ".mysqli_error($dbc);
                    }
                        }
            }
        ?>
        
    <form method="POST" enctype="multipart/form-data">
        <h3> Add a new mobile Phone </h3>
            <div>
            <label for="Brand Name">Brand</label>
            <input type="text"  id="phonebrand" name="phonebrand"/>
            <span><?php echo isset($errors['phonebrand']) ? $errors['phonebrand'] : ''; ?></span>                
            </div>

            
            <div>
            <label for="model" >Model:</label>
            <input type="text"  id="model" name="model"/>
            <span><?php echo isset($errors['model']) ? $errors['model'] : ''; ?></span>
            </div>
            
            <div>
            <label for="quantity" >Quantity:</label>
            <input type="number" id="quantity" name="quantity"/>
            <span><?php echo isset($errors['quantity']) ? $errors['quantity'] : ''; ?></span>
            </div>
            <div>    
            <label for="price" >Price:</label>
            <input type="text" id='price' name='price' />
            <span><?php echo isset($errors['price']) ? $errors['price'] : ''; ?></span>
            </div>
            <div>
            <label for="description" >Description:</label>
            <textarea rows=4 cols=23 id="description" name="description"></textarea>
            <span><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
            </div>
            <div>
            <input type="submit" value="Create device"/>               
            </div>

        </form>
        <a href="mobile_phone.php"> See Phones List</a>
    </body>
</html>















