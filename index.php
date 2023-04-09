<!DOCTYPE html>
<html lang="en">
    <head>
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crystal D Code Test</title>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="scriptButon.js"></script> 
        
        <link rel="stylesheet" href="style.css">

    </head>

        <?php 

            // Import external php file to use reusable code.
            require "api.php";

            // Call reusable mysqli connect code from external file.
            $mysqli = mysqliConnect();

        ?>

        <body>
            
        <?php

        // Query database for list of people and their hobbies, sorted by the selected column

        $sql = sqlQuery();

        // Save the query results in to result variable
        $result = $mysqli->query($sql);

        // Check to make sure result variable is not empty
        if ($result->num_rows > 0) {
            
            // Instantiate the $rows array variable
            $rows = array();

            // Loop throught the associated array
            while($row = $result->fetch_assoc()) {
                //Save associated $row array to the $rows array variable
                $rows[] = $row;
            }

            // Passes and stores $rows array into json file
            $json = json_encode($rows, JSON_PRETTY_PRINT);
            file_put_contents('data.json', $json);

            // Read the JSON file contents
            $json_data = file_get_contents('data.json');

            // Decode the JSON data
            $data = json_decode($json_data, true);

            // Sort the data based on the selected column and order
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
            $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

            if ($sort) {
                usort($data, function($a, $b) use ($sort, $order) {
                    return ($order == 'ASC') ? strcmp($a[$sort], $b[$sort]) : strcmp($b[$sort], $a[$sort]);
                });
            } 

            // Generate the HTML table heders
            echo '<table>';

                echo '<thead>';
                    echo '<tr>';
                        echo '<th><a href="?sort=name&order=' . ($sort == 'name' && $order == 'ASC' ? 'DESC' : 'ASC') . '">Name</a></th>';
                        echo '<th><a href="?sort=height&order=' . ($sort == 'height' && $order == 'ASC' ? 'DESC' : 'ASC') . '">Height</a></th>';
                        echo '<th><a href="?sort=dob&order=' . ($sort == 'dob' && $order == 'ASC' ? 'DESC' : 'ASC') . '">Date of Birth</a></th>';
                        echo '<th><a href="?sort=hobby&order=' . ($sort == 'hobby' && $order == 'ASC' ? 'DESC' : 'ASC') . '">Hobby</a></th>';
                    echo '</tr>';
                echo '</thead>';
                
                // Generate the HTML table rows
                echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['height'] . '</td>';
                        echo '<td>' . $row['dob'] . '</td>';
                        echo '<td class="hobby">' . explode(', ', $row['hobby'])[0] . '</td>'; // display the first value in the hobby array
                        echo '<td><button class="change-btn">Change Hobby</button></td>'; 
                        echo '</tr>';
                    }
                echo '</tbody>';

            echo '</table>';

        } 
        
        else 
            {
                echo "0 results";
            }

        echo '</table>';

        $mysqli->close();
        ?>

    </body>
</html>