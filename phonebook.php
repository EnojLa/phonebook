<?php


class Connection {


	function conn($servername, $username, $password, $db_name) {
		// Create connection
		$conn = new mysqli($servername, $username, $password, $db_name);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
			// echo "Connected successfully";
			return $conn;

	}

	function create_contacts($contact_name, $contact_number) { // creating Contacts
		
		$stmt = $GLOBALS['db_conn']->prepare("INSERT INTO contacts (contact_name, contact_number) VALUES (?, ?)");
			$stmt->bind_param("ss", $contact_name, $contact_number);
		if ($contact_name == null){

			echo "Input Contact name!";
		}
		else if ($contact_number == null) {

			echo "Input Contact number";
		}
		else{

			$stmt->execute();

			echo "New Contacts succesfully added!";

			$stmt->close();
			$GLOBALS['db_conn']->close();
		}
	}

	function select_contacts() { // selecting contacts

	$sql = "SELECT * FROM contacts";
	$result = $GLOBALS['db_conn']->query($sql);

		if ($result->num_rows > 0) {
		    echo "<table border='1'><tr><th>Contact Name</th><th>Contact Number</th><th>Action</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td><input type='text' onkeypress='return /[a-z ]/i.test(event.key)' class='cname".$row["id"]."' value=".$row["contact_name"]." disabled>
		        		</td><td><input type='text' maxlength='11' onkeypress='return /[0-9]/i.test(event.key)' class='cnumber".$row["id"]."' value=".$row["contact_number"]." disabled>
		        			</td><td><input type='button' class='btnedit' index='".$row["id"]."' value='Edit'><input type='button' class='btndelete deleted".$row['id']."' deletes='".$row['id']."' value='Delete' disabled><input type='button' class='btnupdate updated".$row['id']."' updates='".$row['id']."' value='Update' disabled></td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
	$GLOBALS['db_conn']->close();

	}

	function update_contacts($contact_name, $contact_number, $id) { // update contacts

		$sql = "UPDATE contacts SET contact_name = '$contact_name', contact_number = '$contact_number' WHERE id = '$id'";

			if ($contact_name == null) {

				echo "Enter contact name";
			}

			else if($contact_number == null) {

				echo "Enter contact number";
			}

			else if ($GLOBALS['db_conn']->query($sql) === TRUE) {
			    echo "Contacts successfully updated";
			} else {
			    echo "Error updating record: " . $conn->error;
			}

		$GLOBALS['db_conn']->close();

		}

	function delete_contacts($id_number) { // deleting contacts

		$sql = "DELETE FROM contacts WHERE id = '$id_number'";

			if ($GLOBALS['db_conn']->query($sql) === TRUE) {
			    echo "Contacts successfully deleted";
			} else {
			    echo "Error deleting contacts: " . $conn->error;
			}

		$GLOBALS['db_conn']->close();
		
		}
}

$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'phoneBook';

$button = $_POST['button'];

$db = new Connection();
$db_conn = $db->conn($servername, $username, $password, $db_name);


if ($button == 'create') {

	$contact = $_POST['contactName'];
	$contactNum = $_POST['contactNumber'];

	$db->create_contacts($contact, $contactNum);
}

else if ($button == 'view') {

	$db->select_contacts();
}

else if ($button == 'delete') {

	$id_number = $_POST['idNumber'];

	$db->delete_contacts($id_number);
}

else if ($button == 'update') {
	
	$contact = $_POST['contactName'];
	$contactNum = $_POST['contactNumber'];
	$id_number = $_POST['idNumber'];

	$db->update_contacts($contact, $contactNum, $id_number);
}



?>