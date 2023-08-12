<!doctype html>
<html>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                define("INITIALIZING_DATABASE",1);
                require_once("db_connect.php");
                
                mysqli_query($dbc,"drop database if exists mobile_database");
                mysqli_query($dbc,"create database mobile_database");
                mysqli_query($dbc,"use mobile_database");
                
                mysqli_query($dbc,"create table phones (phone_id int(8) unsigned NOT NULL AUTO_INCREMENT,
                                                        brand varchar(30) NOT NULL,
       model varchar(30) NOT NULL,
       quantity mediumint(10) NOT NULL, 
                                                        price decimal(8,2) NOT NULL,                                                        
       description varchar(200) NOT NULL,
                                                        created_by varchar(25) NOT NULL default '8818891 - Diego',
                                                        PRIMARY KEY(phone_id)
                                                        ) Engine=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4");
                echo "<h3>Database Connected Successfully</h3>";
            }
        ?>
        <form method="POST">
            <input type="submit" Value="Initialized DataBase"/>
        </form>
    </body>
</html>


