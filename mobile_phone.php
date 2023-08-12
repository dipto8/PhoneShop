<!DOCTYPE html>
<html>
    <head>
        <title> Registered Phones</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
             <h1>Phoniest</h1>
<h3>Your mobile phone store</h3>
        </header>
        <table>
             <?php
                    require_once("db_connect.php");
                    $query = 'SELECT * FROM phones;';
                    $results = @mysqli_query($dbc,$query);
                    $serie=0;
                    echo "<caption>
                    <h3> mobile phones available on system</h3>
                    </caption>";
                    echo "<thead>";
                    echo "<tr> ";
                    echo "<th> log #  </th>";
                    echo "<th>  ID  </th>";
                    echo "<th>  Brand  </th>";
                    echo "<th>  Model  </th>";
                    echo "<th>  Quantity  </th>";
                    echo "<th>  Price </th>";
                    echo "<th>  Description </th>";
                    echo "<th>  Created By  </th>";
                    echo "<th> Action  </th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row=mysqli_fetch_array($results,MYSQLI_ASSOC))
                    {
                        $serie++;
                        echo "<tr> ";
                        echo "<td> $serie </td>";
                        echo "<td> {$row['phone_id']}  </td>";
                        echo "<td>  {$row['brand']}  </td>";
                        echo "<td>  {$row['model']}  </td>";   
                 echo "<td>  {$row['quantity']}  </td>";
                        echo "<td>  {$row['price']} CAD </td>";
                        echo "<td>  {$row['description']}  </td>";

                        echo "<td>  {$row['created_by']}  </td>";
                        echo "<td> 
                        <a href='edit_phone.php?phone_id={$row['phone_id']}'> Edit </a>
                        &nbsp - &nbsp
                        <a href='phone_delete.php?phone_id={$row['phone_id']}'> Delete </a>
                        </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    ?>
        </table>
        <div class="button">
        <a href='add_phone.php'><button> Click here to add a new Phone</button> </a>            
        </div>
    </body>
</html>



