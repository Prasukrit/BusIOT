<?php 	
/*
 * PHP Sockets - How to create a TCP stream socket server 
 */

// Set time limit to indefinite execution
set_time_limit(0);

// Set the ip and port we will listen on
$address = '192.168.1.36';
$port = 3638;

// Create a TCP Stream socket
//$sock = socket_create(AF_INET, SOCK_STREAM, 0);
if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
				{
					$errorcode = socket_last_error();
					$errormsg = socket_strerror($errorcode);
					die("Couldn't create socket: [$errorcode] $errormsg \n");
				}
//or die("Could not create socket\n"); 
echo "Socket created \n";


// Bind the socket to an address/port
$result = socket_bind($sock, $address, $port) or die("Could not bind to socket\n");

/*----start Loop ---- */
while(1){

// Start listening for connections
	$result = socket_listen($sock) or die("Could not set up socket listener\n"); 

/* Accept incoming requests and handle them as child processes */
	$client = socket_accept($sock) or die("Could not accept incoming connection\n"); 

// Read the input from the client 1024 bytes
	$input = socket_read($client, 1024) or die("Could not read input\n");

	//Check divide variable
	if(isset($input)){

		list($busno, $distance, $time, $station) = sscanf($input, "%d/%d/%d/%s");
		echo $input;
		echo $distance;
		
		/*------ Connect DB -------*/

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bustable";

	// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";

	//SQL

		$sql = "INSERT INTO bussocket (bus_no, distance, next_time, station) VALUES ($busno,$distance,$time,'$station')";
		$status = mysqli_query($conn, $sql);
		if ($status === TRUE) {

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
/* -------- end loop -------- */

mysqli_close($conn);

// Close the master sockets
socket_close($sock);

?>