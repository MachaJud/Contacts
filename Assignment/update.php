<?php
//declare variables to instantiate the database connection
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = "";
$dbName = 'contact';

//create database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$id = $_POST['id'];
$First = $_POST['First'];
$Last = $_POST['Last'];
$Mobile = $_POST['Mobile'];
$Fax = $_POST['Fax'];
$Email = $_POST['Email'];
$Web = $_POST['Web'];

// Prepare SQL statement to update record
$sql = "UPDATE contact_info SET First='$First', Last='$Last', Mobile='$Mobile', Fax='$Fax', Email='$Email', Web='$Web' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
