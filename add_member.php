<?php

  $firstName = filter_input(INPUT_POST, 'firstName');
  $lastName = filter_input(INPUT_POST, 'lastName');
  $email = filter_input(INPUT_POST, 'email');
  $streetAddress = filter_input(INPUT_POST, 'streetAddress');
  $city = filter_input(INPUT_POST, 'city');
  $stateProvince = filter_input(INPUT_POST, 'stateProvince');
  $postalZip = filter_input(INPUT_POST, 'postalZip');
  $country = filter_input(INPUT_POST, 'country');
  $website = filter_input(INPUT_POST, 'website');
  $membershipType = $_POST['membershipType'];

  

  $error_message = '';

  // validate firstName lastName
  if ($firstName === '') {
    $error_message .= 'First Name is a required field.<br>';
  }
  if ($lastName === '') {
    $error_message .= 'Last Name is a required field.<br>';
  }

  // validate email
  if  ($email === '') {
    $error_message .= 'Email is a required field.<br>';
  } else if ($email === FALSE) {
    $error_message .= 'Must enter a valid email.<br>';
  }

  // validate all address 
  if ($streetAddress === '') {
    $error_message .= 'Street Address is a required field.<br>';
  }
  if ($city === '') {
    $error_message .= 'City is a required field.<br>';
  }
  if ($stateProvince === '') {
    $error_message .= 'State / Province is a required field.<br>';
  }
  if ($postalZip === '') {
    $error_message .= 'Postal / Zip is a required field.<br>';
  }

  // validate website
  if ($website === '') {
    $error_message .= 'Website is a required field.<br>';
  }

  // print($membershipType);
  // validate membership
  if ($membershipType != "1" && $membershipType != "2") {
    $error_message .= 'Please select a membership.<br>';
  }


  // if error on submit, go to index page and show it
  if ($error_message != '') {
    include('index.php');
    exit();
  } else {
    require_once('database.php');

    // add member to the database
    $query = 'INSERT INTO members
                (firstName, lastName, email, website, streetAddress, city, st, zip, country, membershipType)
              VALUES
                (:firstName, :lastName, :email, :website, :streetAddress, :city, :stateProvince, :postalZip, :country, :membershipType)';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':website', $website);
    $statement->bindValue(':streetAddress', $streetAddress);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':stateProvince', $stateProvince);
    $statement->bindValue(':postalZip', $postalZip);
    $statement->bindValue(':country', $country);
    $statement->bindValue(':membershipType', $membershipType);
    $statement->execute();
    $statement->closeCursor();
  }

?>

<!DOCTYPE html>
<html class="html">

<head>
  <title>Membership Application</title>
  <link rel="stylesheet" href="main.css">
</head>

<body>
  <div class="card">
    <h1>Thank you for applying!</h1>
  </div>
</body>

</html>