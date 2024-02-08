<?php
//craete variables to hold and store the data from the form
//Take data from the form and input them into the database
$id = $_POST['id'];
$First = $_POST['First'];
$Last = $_POST['Last'];
$Mobile = $_POST['Mobile'];
$Fax = $_POST['Fax'];
$Email = $_POST['Email'];
$Web = $_POST['Web'];

if (!empty($id) || !empty($First) || !empty($Last) || !empty($Mobile) || !empty($Fax) || !empty($Email) || !empty($Web)){

	//declare variables to instantiate the database connection
	$host = 'localhost';
	$dbUsername = 'root';
	$dbPassword = "";
	$dbName = 'contact' ;

	//create databse connection
	$conn = new mysqli($host, $dbUsername, 	$dbPassword , $dbName);

	if(mysqli_connect_error()){
		die('Connect Error('.mysqli_connect_errorno().')'.mysqli_connect_error());
	}else{
		//create two variables, SELECT(onlys checks for the email address of the person) and INSERT(to add form data into the databse)
		$SELECT = "SELECT Email From contact_info Where Email = ? Limit 1"; //checks the email address since it is not shared among users
		$INSERT = "INSERT Into contact_info (id, First, Last, Mobile, Fax, Email, Web) VALUES (?, ?, ?, ?, ?, ?, ?)";

		//prepares statement sort of a loop to keep checking whether the same email address has been repeated with another user
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $Email);//  binds email to the prepare staement
		$stmt->execute();
		$stmt->bind_result($Email);
		$stmt->store_result();
		$rnum = $stmt->num_rows; //check the number of rows in the table for the stored email address.

		if ($rnum==0){
			$stmt-> close(); //stop looping if the email is not present in any of the rows
			$stmt = $conn->prepare($INSERT); //then insert the form data
			$stmt->bind_param("issssss" , $id, $First, $Last, $Mobile, $Fax, $Email, $Web);
			$stmt->execute();
			echo "Record stored successfully";
			}else{
				echo "Email Exists;Enter new email";
			}
			$stmt->close(); //close connection to the prepare and bind statement
			$conn->close();// close connection to mysql
		}
	}else{
			echo "All fields are required";
			die();
}   
	    
?>