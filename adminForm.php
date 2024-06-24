<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link href="adminForm.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="favicon/favicon32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon/favicon16.png" sizes="16x16">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Title -->
<title>Creating an event</title>
</head>
<!-- End of Header -->

<!-- Start of Body -->
<body>
<header> 
  <!-- Navigation -->
  <nav>
    <ul>
      <li><a href="index.html" accesskey="h">HOME</a></li>
      <li><a href="viewevents.php" accesskey="e">VIEW EVENTS</a></li>
      <li><a class="active" href="admin.html" accesskey="a">ADMIN</a></li>
      <li><a href="credits.html" accesskey="c">CREDITS</a></li>
      <li><a href="wireframe/wireframe.pdf" accesskey="w">WIREFRAME</a></li>
    </ul>
  </nav>
  <!-- End of Navigation --> 
  
  <!-- Logo --> 
  <img src="img/neEvents-logo.png" alt="north east events" id="logo"> 
  <!-- H1 tag -->
  <h1>CREATING AN EVENT.</h1>
  <!-- Separator -->
  <hr class="headerLine">
</header>
<main>
  <?php

  // make a connection to the database.php in order to access database on myphpadmin 
  include 'database_conn.php';

   
  // isset() function lets you check if a variable is set - meaning that the user have to declare something in them and that no fields are null. The isset function will return false if each field contains a NULL value.
  $eventTitle = isset( $_REQUEST[ 'eventTitle' ] ) ? $_REQUEST[ 'eventTitle' ] : null;
  $eventDesc = isset( $_REQUEST[ 'eventDesc' ] ) ? $_REQUEST[ 'eventDesc' ] : null;
  $eventCat = isset( $_REQUEST[ 'eventCat' ] ) ? $_REQUEST[ 'eventCat' ] : null;
  $eventVenue = isset( $_REQUEST[ 'eventVenue' ] ) ? $_REQUEST[ 'eventVenue' ] : null;
  $startDate = isset( $_REQUEST[ 'startDate' ] ) ? $_REQUEST[ 'startDate' ] : null;
  $endDate = isset( $_REQUEST[ 'endDate' ] ) ? $_REQUEST[ 'endDate' ] : null;
  $price = isset( $_REQUEST[ 'price' ] ) ? $_REQUEST[ 'price' ] : null;


  // If the user failed to complete each field on the form (fields are empty), an error message will appear along with a link back to the form to fill it out again
  if ( empty( $eventTitle ) || empty( $eventDesc ) || empty( $eventCat ) || empty( $eventVenue ) || empty( $startDate ) || empty( $endDate ) || empty( $price ) ) {
    echo "<p>Please complete all required fields.";
    echo "<a href='adminForm.php'>Go back</a> to the form.</p>\n";
  }
  // Otherwise add the information that user provided into the database called NEE_events  
  else {
    // real_escape_String allows special characters such as !, ?, ". ', etc. in a string for use in an SQL statement
    $eventTitle = $dbConn->real_escape_string( $eventTitle );
    $eventDesc = $dbConn->real_escape_string( $eventDesc );
    $eventVenue = $dbConn->real_escape_string( $eventVenue );

    // Insert the information that the user provided into the database
    $insertSQL = "INSERT INTO NEE_events (eventTitle, eventDescription, venueID, catID, eventStartDate, eventEndDate, eventPrice) VALUES ('$eventTitle', '$eventDesc', '$eventVenue', '$eventCat', '$startDate', '$endDate', '$price')";


    // execute the query using mysqli::query()
    $success = $dbConn->query( $insertSQL );

    // close mysqli 
    mysqli_close( $dbConn );

    // If the connection to the database fails then display a message and provide a link to the admin page where the user can try again
    if ( $success == false ) {
      echo "<p>Sorry, something went wrong."; // Error message
      echo "<a href='admin.html'>Please try again.</a></p>\n"; // Link to the form
    }
    // Otherwise show the successful message and a link to the Homepage
    else {
      echo "<img class='tick' src='img/greenTick.png' alt='green tick'><p class='successful'>Success! Your submission was successful.</p>\n"; // Successful message
      echo "<p class='return'>Return to the <a href='index.html'>Homepage.</a></p>\n"; // Link to the homepage
    }

    // form variables
    $eventTitle = $_POST[ 'eventTitle' ]; // Event Title
    $eventDesc = $_POST[ 'eventDesc' ]; // Event Description
    $eventCat = $_POST[ 'eventCat' ]; // Event Category
    $eventVenue = $_POST[ 'eventVenue' ]; // Event Venue
    $startDate = date( 'l jS F Y', strtotime( $_POST[ 'startDate' ] ) ); // Start Date. Display the date in the following format: l = the full name of the day, j = day of the month without a leaddig zero, S = the english ordinal suffix for the day of the month, F = the full name of the month, Y = the year as a 4-digit number. For example, Monday 31st January 2015.  
    $endDate = date( 'l jS F Y', strtotime( $_POST[ 'endDate' ] ) ); // Same as above
    $price = $_POST[ 'price' ]; // Event Price
	  
	// Detecting the event category and display an image that is relevant to the selected choice. Each category has been assigned a specific value, for example Carnival category value is c1, Theatre is c2, Comedy is c3, and so on. 
	
	//if event category = c1 then displays a carnival image. 
	if ($eventCat == 'c1') {
		
		echo '<p><img src="img/carnival.jpg" alt="carnival"  class="catImg"></p>';
	} // else display theatre image
	  else if ($eventCat == 'c2') {
		  echo '<p><img src="img/theatre.jpg" alt="theatre"  class="catImg"></p>';
	  } // else display comedy image
	  else if ($eventCat == 'c3') {
		  echo '<p><img src="img/comedy.jpg" alt="comedy" class="catImg"></p>';
	  } // else display exhibition image
	  else if ($eventCat == 'c4') {
		  echo '<p><img src="img/exhibition.jpg" alt="exhibition"  class="catImg"></p>';
	  } // else display festival image
	  else if ($eventCat == 'c5'){
		  echo '<p><img src="img/festival.jpg" alt="festival" class="catImg"></p>';
	  } // else display family image
	  else if ($eventCat == 'c6') {
		  echo '<p><img src="img/family.jpg" alt="family"  class="catImg"></p>'; 
	  } // else display concert image
	  else if ($eventCat == 'c7') {
		  echo '<p><img src="img/concert.jpg" alt="concert"  class="catImg"></p>';
	  } // else display sport image
	  else if ($eventCat == 'c8') {
		  echo '<p><img src="img/sport.jpg" alt="sport"  class="catImg"></p>';
	  } // else display dance image
	  else if ($eventCat == 'c9') {
		  echo '<p><img src="img/dance.jpg" alt="dance"  class="catImg"></p>';
	  }
 

    // Present the information to the user. Group them using Div tag
    echo "<div class = 'createEvent'>";
    echo "<h3>Event Title:</h3><hr><p>$eventTitle</p>";
    echo "<h3>Event Description:</h3><hr><p>$eventDesc</p>";
    echo "<h3>Event Category:</h3><hr><p>$eventCat</p>"; 
    echo "<h3>Event Venue:</h3><hr><p>$eventVenue</p>";
    echo "<h3>Event Starts:</h3><hr><p>$startDate</p>";
    echo "<h3>Event Ends:</h3><hr><p>$endDate</p>";
    echo "<h3>Price:</h3><hr><p>$price</p>";
	echo "</div>";

 }
	
  

  ?>
  <!-- End of PHP --> 
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
</body>
</html>