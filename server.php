<?php 
	
/*
 * PHP Sockets - How to create a TCP stream socket server 
 */

// Set time limit to indefinite execution
	set_time_limit(0);

// Set the ip and port we will listen on
	$address = '192.168.43.206';
	$port = 3639;

// Create a TCP Stream socket
	$sock = socket_create(AF_INET, SOCK_STREAM, 0);

// Bind the socket to an address/port
	$result = socket_bind($sock, $address, $port) or die("Could not bind to socket\n");

// Start listening for connections
	socket_listen($sock);

/*------ Connect DB -------*/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bustable";

// Create connection to DB
	$conn = mysqli_connect($servername, $username, $password, $dbname);


/*---- Main Program ---- */
	while(1){

		/* Accept incoming requests and handle them as child processes */
			$client = socket_accept($sock);
			if ($client){
			// Read the input from the client 1024 bytesz
				$input = socket_read($client, 2024); 

			//Check divide variable
				list($busno, $distance, $time, $station) = sscanf($input, "%d/%d/%d/%s");

			// Display output back to client 
	    		socket_write($client, "you wrote " . $input . "\n"); 
		
			//SQL Query
				$sql = "INSERT INTO bussocket (bus_no, distance, next_time, station) VALUES ($busno ,$distance ,$time , '$station') ";			

			//Query data to database
				$status = mysqli_query($conn, $sql);			
			}
			// Close the client (child) socket
				socket_close($client);	
	
	}

//Close connection to DB
	mysqli_close($conn);	
			



// Close the master sockets
	socket_close($sock);

?>