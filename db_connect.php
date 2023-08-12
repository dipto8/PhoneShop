<?php 
    define("db_user","root");
    define("db_pwd","");
    define("DB_HOST","localhost");
    define("DATABASE","mobile_database");
    define("CHARSET","utf8mb4");
    
    if(defined("INITIALIZING_DATABASE")){
        $dbc = mysqli_connect(DB_HOST,db_user,db_pwd) or
        die("Could not connect".mysqli_connect_error());
    }
    else{
        $dbc = mysqli_connect(DB_HOST,db_user,db_pwd,DATABASE) or
        die("Could not connect".mysqli_connect_error());
    }
    mysqli_set_charset($dbc,CHARSET);
?>

