<?php
$db_server="localhost";
$db_user="root";
$db_password="";
$db_name="user_db";

try{
    $conn=mysqli_connect($db_server,
                         $db_user,
                         $db_password,
                         $db_name
                        );
}
catch(mysqli_sql_exception)
{
    echo "Database couldn't connect";
}
if(!$conn)
{
    echo "Connection failed";
}
?>