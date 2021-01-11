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
<title>Books - Search Results - BooksRUs</title>
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
			<a href="contact.html"><span>Contact</span></a>
			<a href="search.html"><span id="currentpage">Search</span></a>
		</div>
		<div id="contents"> <!-- Contents container -->
			<br />
			<br />
			<h1>Search Results</h1><br />
			
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
						
			// Obtain search values from search form
			$skeyword = $_POST['searchkeyword'];
			$stitle = $_POST['searchtitle'];
			$sauthor = $_POST['searchauthor'];
			$sisbn = $_POST['searchisbn'];
			
			// if empty search fields, build SQL query to return no results
			if ($skeyword=="" && $stitle=="" && $sauthor=="" && $sisbn=="")
				$sql = "SELECT * FROM book"; // WHERE bookid=0";
			else {
				// Create SQL query to obtain search results
				$sql = "SELECT * FROM book WHERE ";
				// Add to query depending on which search fields were used
				if ($stitle != "")
					$sql = $sql."LOWER(booktitle) LIKE LOWER('%$stitle%') ";
				
				if ($stitle == "" && $sauthor != "")
					$sql = $sql."LOWER(bookauthor) LIKE LOWER('%$sauthor%') ";
				else if ($stitle != "" && $sauthor != "")
					$sql = $sql."AND LOWER(bookauthor) LIKE LOWER('%$sauthor%') ";
				
				if ($stitle == "" && $sauthor == "" && $sisbn != "")
					$sql = $sql."LOWER(bookisbn) LIKE LOWER('%$sisbn%') ";
				else if (($stitle != "" || $sauthor != "") && $sisbn != "")
					$sql = $sql."AND LOWER(bookisbn) LIKE LOWER('%$sisbn%') ";
				
				if ($stitle == "" && $sauthor == "" && $sisbn == "" && $skeyword != "")
					$sql = $sql."LOWER(bookshortdesc) LIKE LOWER('%$skeyword%') OR LOWER(booktitle) LIKE LOWER('%$skeyword%') OR LOWER(bookauthor) LIKE LOWER('%$skeyword%') ";
				else if (($stitle != "" || $sauthor != "" || $sisbn != "") && $skeyword != "")
					$sql = $sql."AND (LOWER(bookshortdesc) LIKE LOWER('%$skeyword%') OR LOWER(booktitle) LIKE LOWER('%$skeyword%') OR LOWER(bookauthor) LIKE LOWER('%$skeyword%')) ";
			}
			
			//echo('SQL: '.$sql);
			/* check the sql statement for errors and if errors report them */
			$result = $conn->query($sql);
			
			//echo "SQL: $sql<br>";
			if(!$result) {
			echo "Unable to read from the database. Please try again shortly.\n";
			exit;
			}
			
			$flag = 0; // flag to determine if any search results found
			$row_no=0; // stores count of rows being displayed
			// Display all the values in the retrieved records, one record per row, in a loop
			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					if ($flag == 0) { // First iteration so add results headings
						echo('<table class="searchresultstable">');
						echo('<tr>');
						echo('<td class="searchresultstitle">TITLE</td>');
						echo('<td class="searchresultstitle">AUTHOR</td>');
						echo('<td class="searchresultstitle">GENRE</td>');
						echo('<td class="searchresultstitle">ISBN</td>');
						echo('<td class="searchresultstitle">SHORT DESCRIPTION</td>');
						echo('<td class="searchresultstitle">PRICE</td>');
						echo('</tr>');
					}
					$flag = 1; // set flag to 1 as > 0 results returned
					// Start a row for each record
					echo("<tr>");
										
					// Obtain result elements
					$btitle = $row["booktitle"];
					$bauthor = $row["bookauthor"];
					$bgenre = $row["bookgenre"];
					$bisbn = $row["bookisbn"];
					$bshortd = $row["bookshortdesc"];
					$bprice = $row["bookprice"];
					$blink = $row["booklink"];
					
					// Display each returned row as a table row
					if ($row_no % 2 == 0) // Print even numbered result row in one colour
						$row_display="searchresultseven";
					else // Print odd numbered result row in another colour
						$row_display="searchresultsodd";
					echo('<td class="'.$row_display.'">');
					if ($blink != "") // if record has a link value ...
						echo('<a href="books.html#'.$blink.'">'.$btitle.'</a>'); // ... add a link to title cell value
					else
						echo ($btitle);
					echo("</td>");
					echo('<td class="'.$row_display.'">');
					echo($bauthor);
					echo("</td>");
					echo('<td class="'.$row_display.'">');
					echo($bgenre);
					echo("</td>");
					echo('<td class="'.$row_display.'">');;
					echo($bisbn);
					echo("</td>");
					echo('<td class="'.$row_display.'">');
					echo ($bshortd);
					echo("</td>");
					echo('<td class="'.$row_display.'">$');
					echo ($bprice);
					echo("</td>");
					// End the row
					echo("</tr>");
					$row_no++;
				}
			
				if ($flag ==1) // if flagged that > 0 results returned ...
					echo("</table>"); // ... close off results table
			}
			
			if ($flag == 0) // No search results returned.
				echo('No items were found for your query. Please <a href="search.html">search</a> again');
			
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
