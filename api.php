<?php
    // Custom function to reuse code for connection to database.
    function mysqliConnect(){
        //Server connection information
        $server = "localhost";
        $username = "root";
        $password = "kongmeng";
        $database = "crystld";
        
        //Use mysqli to connect to database with givien server connection information.
        $mysqli = new mysqli($server, $username, $password, $database);

        //Conditional statement to check if connection was made successfully.
        if($mysqli->connect_errno){
                printf("Connect failed: %s<br />", $mysqli→connect_error);
            exit();
        }

        //Output satement to confirm connection was successfull.
        //printf('Connected successfully.<br />');

        //Return the connection to main program.
        return $mysqli;
    }
    
    // Function to query databse.
    function sqlQuery(){
        $sql = "SELECT * from people INNER JOIN person_interest ON people.id = person_interest.person_id 
                                              INNER JOIN hobby_interest ON person_interest.interest_id = hobby_interest.interest_id 
                                              INNER JOIN hobbies ON hobbies.id WHERE hobby_id = hobbies.id";
        return $sql;
    }
?>