<!DOCTYPE html>
<html>
<head>
	<title>Insert New Records</title>
</head>
<body>
	<centre>		
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
		    //Connect to Database
		    $conn = mysqli_connect("localhost", "root", "", "contact_form");
		    
		    //Check connection
		    if($conn === false){
		        die("ERROR: Could not connect. " . mysqli_connect_error());
		    }
		    
		    //Take data from the form and input them into the database
		    $First = $_POST['First'];
		    $Last = $_POST['Last'];
		    $Mobile = $_POST['Mobile'];
		    $Fax = $_POST['Fax'];
		    $Email = $_POST['Email'];
		    $Web = $_POST['Web'];
		    
		    //Query to insert data into the Contact_info table
		    $sql = "INSERT INTO contact_info (First, Last, Mobile, Fax, Email, Web) VALUES ('$First', '$Last', '$Mobile', '$Fax', '$Email', '$Web')";
		    
		    if(mysqli_query($conn, $sql)){
		        echo "<center><h3>Data stored in the database successfully.</h3></center>";
		    } else{
		        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		    }
		    mysqli_close($conn);
		}
		?>
	</centre>
</body>
</html>
