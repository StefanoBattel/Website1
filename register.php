<!Doctype html>
<?php
session_start();

if( isset($_SESSION['user'])!="" ){
header("Location: login.php");
}

include_once 'connect.php';

if ( isset($_POST['sca']) ) {
  $username = trim($_POST['username']);
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $pass = trim($_POST['pass']);
  $password = hash('sha256', $pass);

  $query = "insert into people(username,fname,lname,pass) values(?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$username,$fname,$lname,$password]);
  $rowsAdded = $stmt->rowCount();

  if ($rowsAdded == 1) {
    $message = "Success! Proceed to login";
    unset($fname);
    unset($lname);
    unset($pass);
    header("Location: login.php");
  }
  else
  {
    $message = "Failed! For some reason";
  }
}
?>
<html>
<head>
<title>Registration</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style type="text/css">
  body {
    background-color: #404092;
    margin: 0;
    padding: 0;
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  }
  div {
    width: 600px;
    margin: 5em auto;
    padding: 50px;
    background-color: #d35252;
    border-radius: 1em;
  }
  a:link, a:visited {
    color: #38488f;
    text-decoration: none;
  }
  @media (max-width: 700px) {
    body {
      background-color: #fff;
    }
    div {
      width: auto;
      margin: 0 auto;
      border-radius: 0;
      padding: 1em;
    }
  }
</style>

<script>
function Validate() {
    var w = document.forms["accountcreate"]["username"].value;
    if (w == "") {
        alert("Please choose a username");
        return false;
    }
    var x = document.forms["accountcreate"]["fname"].value;
    if (x == "") {
        alert ("Please provide your First Name");
        return false;
    }
    var y = document.forms["accountcreate"]["lname"].value;
    if (y == "") {
        alert ("Please provide your Last Name");
        return false;
    }
    var z = document.forms["accountcreate"]["email"].value;
    if (z == "") {
        alert ("Please provide your email address");
        return false;
    }
    var p = document.forms["accountcreate"]["password"].value;
    if (p == "") {
        alert ("Please provide your password");
        return false;
    }
    plength = p.length;
    if (plength < 10) {
        alert("Your password is not long enough");
        return false;
    }
}
</script>
</head>
<body>
  <div>
    <h1>Account Registration</h1>
    <p>Please create your account</p>
    <br />
    <form action="" method="post" name="accountcreate" onsubmit="return Validate()">
      Username: <input type="text" name="username"><br />
      First Name: <input type="text" name="fname"><br />
      Last Name: <input type="text" name="lname"><br />
      Password: <input type="password" name="password"><br />
      <input type="submit" Value="Create Account" />
    </form>
  </div>
</body>
</html>