<?php


// Define global variables
$name = $_POST['name'];

// Read the JSON file contents
$json_data = file_get_contents('data.json');

// Decode the JSON data
$data = json_decode($json_data, true);

// Filter the entries that match the name
$matching_entries = array_filter($data, function($entry) use ($name) {
    return $entry['name'] === $name;
});

// Select a random matching hobby from the filtered entries
if (!empty($matching_entries)) {
    $random_entry = array_rand($matching_entries);
    $random_hobby = $matching_entries[$random_entry]['hobby'][array_rand($matching_entries[$random_entry]['hobby'])];
    echo $random_hobby;
} else {
    echo "No matching hobby found.";
}


?>