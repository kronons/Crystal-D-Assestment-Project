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

?>