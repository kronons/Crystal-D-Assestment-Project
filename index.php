<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crystal D Code Test</title>
        <script src="script.js"></script> 
        
        <style>
            table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
            }

            th, td {
            text-align: left;
            padding: 16px;
            }

            tr:nth-child(even) {
            background-color: #f2f2f2;
            }
        </style>

    </head>
        <body>
            <?php
            //Import external php file to use reusable code.
            require "api.php";

            // Call reusable mysqli connect code from external file.
            $mysqli = mysqliConnect();

            //Instantiate the action variable.
            $action = '';    
            
            $sql =  

            //Instantiate the variable.
            $where = '';

            //Check to see if we have an ID.
            if(isset($_GET["id"]))
            {
            
                $id     = $_GET["id"];      //geting id value which we are passing from table headers
                $action = $_GET["action"];  //geting action value which we are passing from table headers
                
                //We are checking condition if $action value is ASC then $action will set to DESC otherwise it will remain ASC
                if($action == 'ASC')
                { 
                    $action='DESC';
                }
                else  
                { 
                    $action='ASC';
                }
                if($_GET['id']=='name') 
                {
                    $id = "name";
                }
                elseif($_GET['id']=='height') 
                {
                    $id = "height";
                }
                elseif($_GET['id']=='dob') 
                {
                    $id="dob";
                }
                elseif($_GET['id']=='hobbies_name') 
                {
                    $id="hobbies_name";
                }

                $where = " ORDER BY  $id $action ";

                //SQL query to get certain data from database.
                $sql = "SELECT * from people INNER JOIN person_interest ON people.id = person_interest.person_id 
                                             INNER JOIN hobby_interest ON person_interest.interest_id = hobby_interest.interest_id 
                                             INNER JOIN hobbies ON hobbies.id WHERE hobby_id = hobbies.id" . $where;
            }
        
        ?>
        <html>
        <body>
            <!-- Create table with headings to store information from database. --> 
            <table border="1">
                <tr>
                <th><a href="index.php?id=<?php echo 'name';?>&action=<?php echo $action;?>">Name</a></th>
                <th><a href="index.php?id=<?php echo 'height';?>&action=<?php echo $action;?>">Height</a></th>
                <th><a href="index.php?id=<?php echo 'dob';?>&action=<?php echo $action;?>">Date of Birth</a></th>
                <th><a href="index.php?id=<?php echo 'hobbies_name';?>&action=<?php echo $action;?>">Hobbies</a></th>
            </tr>
            
        <?php
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) { 

/*
        // Fetch a result row as an associative array
            while($row = $result->fetch_assoc()) { ?>

                <tr>
                    <td> <?php echo $row['name'];           ?> </td>
                    <td> <?php echo $row['height'];         ?> </td>
                    <td> <?php echo $row['dob'];            ?> </td>
                    <td> <?php echo $row['hobbies_name'];   ?> </td>
                    <td> <?php echo "<button id='changeButton' onClick='changeHobby()'>Change Hobby</button>";?> </td>
                </tr>
  */              
            $hold = '';
             while($row = $result->fetch_assoc()) { 

               echo "<tr>";
               if ($hold != $row['name']) {
                    echo "<td>" . $row['name']           . "</td>";
                    echo "<td>" . $row['height']         . "</td>";
                    echo "<td>" . $row['dob']            . "</td>";
                    echo "<td>" . $row['hobbies_name']   . "</td>";
                    echo "<td>" . "<button id='changeButton' onClick='changeHobby()'>Change Hobby</button>" . "</td>";
               echo "</tr>";
                    $hold = $row['name'];
                }
             }
        ?>

        <?php 
                
            
                echo '</table>';
                echo '</div>';
            } 
            else 
            {
            echo "0 results";
            }
                
        $mysqli->close();
        ?>
    </body>
</html>