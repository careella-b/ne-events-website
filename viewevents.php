<!doctype html>
<html lang="en">
<!-- Start of Header -->
<head>
<meta charset="UTF-8"/>
<link rel="icon" type="image/png" href="favicon/favicon32.png" sizes="32x32"/>
<link rel="icon" type="image/png" href="/favicon/favicon16.png" sizes="16x16"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="viewevents.css"/>
<!-- Title -->
<title>North East Events</title>
</head>
<body>
<div id="gridContainer">
  <header> 
    <!-- Navigation -->
    <nav>
      <ul>
        <li><a href="index.html" accesskey="h">HOME</a></li>
        <li><a class="active" href="viewevents.php" accesskey="e">VIEW EVENTS</a></li>
        <li><a href="admin.html" accesskey="a">ADMIN</a></li>
        <li><a href="credits.html" accesskey="c">CREDITS</a></li>
        <li><a href="wireframe/wireframe.pdf" accesskey="w">WIREFRAME</a></li>
      </ul>
    </nav>
    <!-- End of Navigation --> 
    
    <!-- Logo --> 
    <img src="img/neEvents-logo.png" alt="north east events" id="logo"> 
    <!-- H1 tag -->
    <h1>EVENTS</h1>
    <!-- Separator -->
    <hr class="headerLine">
  </header>
  <main> 
    
    <!-- Set the table with appropriate headings -->
    <table>
      <thead>
        <tr>
          <th>Event Title</th>
          <th>Event Description</th>
          <th>Venue</th>
          <th>Category</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Price</th>
        </tr>
      </thead>
      <?php


      include 'database_conn.php'; // make database connection

      // Perform SQL command to pull the information from database. Using inner join command to link the 3 tables together.
      $sql = "select eventTitle, eventDescription, venueName, catDesc, eventStartDate, eventEndDate, eventPrice
		from NEE_events 
		inner join NEE_category 
		on NEE_category.catID = NEE_events.catID
		inner join NEE_venue
		on NEE_venue.venueID = NEE_events.venueID";

      $queryResult = $dbConn->query( $sql );

      // If the query failed, it will display "Query failed" and terminates the connection 
      if ( $queryResult === false ) {
        echo "<p>Query failed: " . $dbConn->error . "</p>\n</body>\n</html>";
        exit;

      }


      // Otherwise fetch all the rows returned by the query one by one using Row Object function. Fetching in the following order: Event Title, Event Description, Venue Name, Cateory Description, Event Start Date, Event End Date and Event Price
      else {
        while ( $rowObj = $queryResult->fetch_object() ) {
          echo "<tr><td class='one' data-label='Event Title:'>{$rowObj->eventTitle}</td> 
	<td class='two' data-label='Event Description:'>{$rowObj->eventDescription}</td>
	<td class='three' data-label='Venue Name:'>{$rowObj->venueName}</td> 
	<td class='four' data-label='Category:'>{$rowObj->catDesc}</td>
	<td class='five' data-label='Start Date:'>{$rowObj->eventStartDate}</td>
	<td class='six' data-label='End Start:'>{$rowObj->eventEndDate}</td>
	<td class='seven' data-label='Price:'>{$rowObj->eventPrice}</td>
	</tr>\n";
        }


      }
      $queryResult->close(); // Ends query result once it fetched all data
      $dbConn->close(); // Close database connection

      ?>
      <!-- End of PHP  -->
    </table>
  </main>
  <!-- Start of Footer -->
  <footer>
    <h2>Contact us</h2>
    <hr class="contactLine">
    <p>Hoults Yard, Newcastle upon Tyne, NE6 2HL <br>
      hello@northeastevents.co.uk <br>
      0191 12345678</p>
    <!-- Social media icons -->
    <div class="social">
      <ul>
        <li><a href="https://en-gb.facebook.com"><img class="facebook" src="img/facebook.png" alt="facebook icon"></a></li>
        <li><a href="https://twitter.com"><img class="twitter" src="img/twitter.png" alt="twitter icon"></a></li>
        <li><a href="https://uk.linkedin.com"><img class="linkedin" src="img/linkedin.png" alt="linkedin icon"></a></li>
        <li><a href="https://www.instagram.com"><img class="instagram" src="img/Instagram.png" alt="instagram icon"></a></li>
      </ul>
    </div>
    <!-- Copyright -->
    <p class="copyright">&copy;Copyright 2020. <br>
      All rights reserved. Powered by North East Events.</p>
  </footer>
  <!-- End of Footer --> 
</div>
</body>
</html>