<!--
 SIT104 Introduction to Web Development
 Assignment 2 Part 2
 Aaron Pethybridge #217561644
-->
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta tags - keywords tailored for each page -->
<meta charset="utf-8">
<meta name="description" content="BooksRUS. Best Secondhand Book Shop in Geelong.">
<meta name="keywords" content="BooksRUS, books, secondhand, geelong, best, Moorabool, contact, phone, email, feedback">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Aaron Pethybridge Student# 217561644">
<title>Thank You - BooksRUs</title>
<link href="booksrus.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="container"> <!-- Page container -->
		<div id="header"> <!-- Heading container -->
			<a class="headeranchor" href="ass1.html">
			<span id="banner"><span id="bannerbooks">Books</span>R<span id="bannerus">Us</span></span><br />
			<span id="blurb">Best Secondhand Book Shop in Geelong.</span>
			</a>		
		</div>
		<div id="nav"><!-- Navigation container -->
			<a href="ass1.html"><span>Home</span></a>
			<a href="books.html"><span>Books</span></a>
			<a href="orders.html"><span>Orders</span></a>
			<a href="faqhelp.html"><span>FAQ / Help</span></a>
			<a href="contact.html"><span id="currentpage">Contact</span></a>
			<a href="search.html"><span>Search</span></a>
		</div>
		<div id="contents"> <!-- Contents container -->
			<br />
			<br />
			
				<?php
					// DB login details
					$user = "metaphor_uni_user";
					$pass = "K42Z9q6_";
					$db = "metaphor_uni";
					$conn = new mysqli("localhost", $user, $pass, $db);
				
					if (!$conn) {
						echo "Unable to connect to the database. Please try again shortly.";
						exit;
					}
					//ini_set(SMTP,"mail.deakin.edu.au"); // SMTP mail server

					// Obtain email message values from contact form
					$to = "contact@BooksRUS.com.au";
					$from = $_POST['contactemail'];
					$name = $_POST['contactname'];
					$message = $_POST['contactmsg'];

					// Modify formatting of email message values
					$fromfield = "From: " . $from;
					$subjectfield = "Query / feedback from : " . $name . " <" . $from . ">";
					$message = wordwrap($message,70); // wrap lines if > chars long
					//mail($to, $subjectfield, $message, $fromfield);
					$msg = str_replace("\'","''", $message); // Replace incorrect escape characters to process
					
					$count=0; // Init count var for new id for message table insertion
					// Obtain highest id value from Message table
					$sql_count = "SELECT IFNULL(MAX(messageid),0) AS maxid FROM message";
					
					/* check the sql statement for errors and if errors report them */
					$result = $conn->query($sql_count);
					
					//$stmt = oci_parse($connect, $sql_count);
					//echo "SQL: $sql<br>";
					if(!$result) {
						echo "Unable to read from the database. Please try again shortly.\n";
						exit;
					}
					
					// if results found apply to count variable
					while ($row = $result->fetch_assoc())
					{
						$count = $row['maxid'];
					}	
					
					$count++; // Increment value new message record id
				
					// Create SQL query to Insert message into table
					$sql = "INSERT INTO message VALUES ($count, '$to', '$fromfield','$subjectfield','$msg')";
				
					/* check the sql statement for errors and if errors report them */
					if ($conn->query($sql) != TRUE)
					//$stmt = oci_parse($connect, $sql);
					//echo "SQL: $sql<br>";
					//if(!$stmt) {
					{
						echo "Error sending query / feedback. Please try again shortly.\n";
						exit;
					}
					else
					{
						//if (oci_execute($stmt)) {
						// Display original message and "Thank you"
						echo('<h1>Thank You</h1><br />');
						echo("Thanks for your query / feedback.<br />");
						echo("Your message details are<br /><br />");
						echo('<span class="highlight">Your name: </span><br />');
						echo($name);
						echo("<br /><br />");
						echo('<span class="highlight">Your email: </span><br />');
						echo($from);
						echo("<br /><br />");
						echo('<span class="ordersresults">Your message: </span><br />');
						$msg = str_replace("\\","", $msg); // Remove '\' escape for display
						$msg = str_replace("''","'", $msg); // Remove escape single quote for display
						echo($msg);
						echo("<br /><br /><br />");
						echo("We have received your email and will respond promptly.<br /><br />");
					}
					
					// Close the connection
					$conn->close();
				?>
		</div>
		<div id="footer"> <!-- Footer container -->
			©Deakin University, School of Information Technology.<br /> This web page has been developed as a student assignment for the unit SIT104: Introduction to Web Development.<br />Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.
		</div>
	</div>

</body>
</html>
