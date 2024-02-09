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

    $sql = "SELECT id, First, Last, Mobile, Fax, Email, Web FROM contact_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row within a table
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Mobile</th><th>Fax</th><th>Email</th><th>Web</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["First"] . "</td>";
            echo "<td>" . $row["Last"] . "</td>";
            echo "<td>" . $row["Mobile"] . "</td>";
            echo "<td>" . $row["Fax"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["Web"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
?>
