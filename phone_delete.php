<?php 
    require_once('db_connect.php');

//Validate if the value entered exists into the database
    if(empty($_GET['phone_id'])){
     echo '<p> The phone Id you are trying that you are looking for does not exist</p>';
     echo '<a href="mobile_phone.php"> See Phones List</a>';
    }
    else{
        $phone_id=(int)htmlspecialchars($_GET["phone_id"]);
        $sql = "delete from phones where phone_id=?";
        $stmt = mysqli_prepare($dbc,$sql);
        mysqli_stmt_bind_param($stmt,
        "i",
        $phone_id);
        $result=mysqli_stmt_execute($stmt);
        if($result){
            header("Location: mobile_phone.php");
            exit();
        }
        else{
            echo "<h3> Error:".mysqli_error($dbc)."</h3>";
        }
    }
?>





