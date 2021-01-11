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
<meta name="keywords" content="BooksRUS, books, secondhand, geelong, best, Moorabool, order, delivery, payment, contact">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Aaron Pethybridge Student# 217561644">
<title>Order Processed - BooksRUs</title>
<link href="booksrus.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="orderformvalidate.js"></script> <!-- Javascript code in external file -->
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
			<a href="orders.html"><span id="currentpage">Orders</span></a>
			<a href="faqhelp.html"><span>FAQ / Help</span></a>
			<a href="contact.html"><span>Contact</span></a>
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
				
				// Obtain orders form values
				$otitle = $_POST['orderstitle'];
				$oauthor = $_POST['ordersauthor'];
				$oisbn = $_POST['ordersisbn'];
				$oquantity = $_POST['ordersquantity'];
				$ocustname = $_POST['orderscustname'];
				$ocustphone = $_POST['orderscustphone'];
				$ocustmobile = $_POST['orderscustmobile'];
				$ocustemail = $_POST['orderscustemail'];
				$odeliveryno = $_POST['ordersdeliveryno'];
				$odeliverystreet = $_POST['ordersdeliverystreet'];
				$odeliverycity = $_POST['ordersdeliverycity'];
				$odeliverystate = $_POST['ordersdeliverystate'];
				$odeliverycountry = $_POST['ordersdeliverycountry'];
				$opaytype = $_POST['orderspaytype'];
				$opayname = $_POST['orderspayname'];
				$opaycard = $_POST['orderspaycard'];
				$opayexpirymonth = $_POST['orderspayexpirymonth'];
				$opayexpiryyear = $_POST['orderspayexpiryyear'];
				$opayccv = $_POST['orderspayccv'];
				
				$count=0; // Init count var for new id for message table insertion
				// Obtain highest id value from Message table
				$sql_count = "SELECT IFNULL(MAX(orderid),0) AS maxid FROM bookorder";
				
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
				//echo('Count: '.$count);			
				
				// Create SQl statement to Insert order into table
				$sql = "INSERT INTO bookorder VALUES ($count, '$otitle', '$oauthor','$oisbn','$oquantity',
					'$ocustname','$ocustphone','$ocustmobile','$ocustemail',
					'$odeliveryno','$odeliverystreet','$odeliverycity','$odeliverystate','$odeliverycountry',
					'$opaytype','$opayname','$opaycard','$opayexpirymonth','$opayexpiryyear','$opayccv')";
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
					// Display order receipt details
					echo("<h1>Order processed</h1><br /><br />");
					echo('Thank you for placing your order. Your Order number is <span class="ordersresults">'.$count.'</span>.<br />');
					echo("Please see your receipt details below<br /><br />");
					echo("<table>");
					echo("<tr>");
					echo('<td class="ordersresults">Order Title: </td>');
					echo("<td>".$otitle."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Order Author: </td>');
					echo("<td>".$oauthor."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Order ISBN: </td>');
					echo("<td>".$oisbn."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Order Quantity: </td>');
					echo("<td>".$oquantity."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Name: </td>');
					echo("<td>".$ocustname."</td>");
					echo("</tr>");
					if (strlen($ocustphone) > 0) {
						echo("<tr>");
						echo('<td class="ordersresults">Phone no.: </td>');
						echo("<td>".$ocustphone."</td>");
						echo("</tr>");
					}
					if (strlen($ocustmobile) > 0) {
						echo("<tr>");
						echo('<td class="ordersresults">Mobile no.: </td>');
						echo("<td>".$ocustmobile."</td>");
						echo("</tr>");
					}
					echo("<tr>");
					echo('<td class="ordersresults">Email: </td>');
					echo("<td>".$ocustemail."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Delivery no.: </td>');
					echo("<td>".$odeliveryno."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Delivery street: </td>');
					echo("<td>".$odeliverystreet."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Delivery city: </td>');
					echo("<td>".$odeliverycity."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Delivery state: </td>');
					echo("<td>".$odeliverystate."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Delivery country: </td>');
					echo("<td>".$odeliverycountry."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Card type: </td>');
					echo("<td>".$opaytype."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Cardholder name: </td>');
					echo("<td>".$opayname."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Credit card no.: </td>');
					echo("<td>xxxxxxxxxxx");
					if (strlen($opaycard)==16)
						echo("x");	
					echo(substr($opaycard,strlen($opaycard)-4,4)."</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Card expiry: </td>');
					echo("<td>");
					if ($opayexpirymonth < 10)
						echo("0");
					echo($opayexpirymonth);
					echo("/");
					echo($opayexpiryyear);
					echo("</td>");
					echo("</tr>");
					echo("<tr>");
					echo('<td class="ordersresults">Card ccv: </td>');
					echo("<td>".$opayccv."</td>");
					echo("</tr>");
					echo("</table>");
				}
				
				// Close the connection
				$conn->close();
			?>
			<br /><br />
		</div>
		<div id="footer"> <!-- Footer container -->
			©Deakin University, School of Information Technology.<br /> This web page has been developed as a student assignment for the unit SIT104: Introduction to Web Development.<br />Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.
		</div>
	</div>

</body>
</html>
