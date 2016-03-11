<?php

function db_connect() {
		$db_host = "localhost"; 
		$db_name = "expense";
		$db_user = "root";
		$db_password = '';
		// Try and connect to the database, if a connection has not been established yet
	    $con = mysqli_connect($db_host,$db_user,$db_password,$db_name);
	    return $con;
	    // If connection was not successful, handle the error
	    if (mysqli_connect_errno($con)) {
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
//function for inserting item data to db
function insertItem($item_name, $item_price) {
	$con = db_connect();
	$result = mysqli_query($con,"INSERT INTO spent(item_name,item_price) VALUES ('$item_name','$item_price')");
	
	if($result === false) {
    // Handle failure - log the error, notify administrator, etc.
		echo "Query unseccessful";;
	} else {
	    // We successfully inserted a row into the database
	    echo "Go back to <a href=\"index.php\">Home page</a>";
	}
	mysqli_close($con);
}

//function for retriving item data from db
function retriveItem() {
	$con = db_connect();
	$sql = "SELECT id, item_name, item_price FROM spent";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo "UID: " . $row["id"]. ", Item: " . $row["item_name"]. ",  Spent: " . $row["item_price"]. "<br>";
	    }
	} else {
	    echo "0 results";
	}
}

//function for showing total expenditure
function totalExpenditure() {
	$con = db_connect();
	$result = mysqli_query($con,'SELECT SUM(item_price) AS value_sum FROM spent'); 
	$row = mysqli_fetch_assoc($result); 
	$sum = $row['value_sum'];
	echo "<b>".$sum."</b>";
}
?>
