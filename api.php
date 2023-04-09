<?php

    // Custom function to reuse code for connection to database.
    function mysqliConnect(){
        // Server connection information
        $server = "localhost";
        $username = "root";
        $password = "kongmeng";
        $database = "crystld";
        
        // Use mysqli to connect to database with givien server connection information.
        $mysqli = new mysqli($server, $username, $password, $database);

        // Conditional statement to check if connection was made successfully.
        if($mysqli->connect_errno){
                printf("Connect failed: %s<br />", $mysqli→connect_error);
            exit();
        }

        // Output satement to confirm connection was successfull.
        /*printf('Connected successfully.<br />'); */

        //Return the connection to main program.
        return $mysqli;
    }

    // Custom function for reusable code to query database
    function sqlQuery(){
         $sql = "SELECT 
                    p.name,
                    p.height,
                    p.dob,
                    GROUP_CONCAT(DISTINCT i.name ORDER BY i.name SEPARATOR ', ') AS interests,
                    GROUP_CONCAT(DISTINCT h.hobbies_name ORDER BY RAND() SEPARATOR ', ') AS hobby
                FROM 
                    people p
                    JOIN person_interest pi ON p.id = pi.person_id
                    JOIN interests i ON pi.interest_id = i.id
                    JOIN hobby_interest hi ON i.id = hi.interest_id
                    JOIN hobbies h ON hi.hobby_id = h.id
                GROUP BY 
                    p.id";
        
        return $sql;
    }

?>