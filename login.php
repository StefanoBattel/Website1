<!Doctype html>
<?php
session_start();

if( isset($_SESSION['user'])!="" ){
   header("Location: index.php");
}
include_once 'connect.php';

if ( isset($_POST['sca']) ) {
    $username = trim($_POST['username']);
    $pass = trim($_POST['pass']);
    $password = hash('sha256', $pass);
    
    $query = "select userid, username, pass from people where username=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if( $count == 1 && $row['pass']==$password ) {
        $_SESSION['user'] = $row['userid'];
        header("Location: profile.php");
    }
    else {
        $message = "Invalid Login";
    }
    $_SESSION['message'] = $message;
}
?>
<html>
<head>
  <title>Login</title>
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
    text-align: center
    }
    p2 {
      text-align:center;
      color: white;
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
<body> 
  <div>     
<h1><b>LOG IN<b></h1>
<?php
  if ( isset($message) ) {
    echo $message;
  }
?>

<form action="login.php" method="post">
Username: <input type="text" name="username" /><br /><br />
Password: <input type="password" name="pass" /><br /><br />
<input type="submit" name="sca" value="Login" /> <br />
<h2>Welcome!</h2>
<h3>What hotel are you booking today?<h3>
</form>
<p1> If you require any assistance during your booking
  process, please feel free to reach out to one of customer
  representative agents via chat. We will be more than happy
  to assist you.</p1>
 </div>
  <div style="text-align:center"><img src="https://cache.marriott.com/content/dam/marriott-renditions/MIAEB/miaeb-oceanfront-0001-hor-clsc.jpg?output-quality=70&interpolation=progressive-bilinear&downsize=1215px:*"
        width="600px" height="500px" align="center"> <br><br> </div>
   </div>   
   <p2>SPECIAL OFFER ENDS SEPTEMBER 25TH<br><br>
      55% off Regular Rate for Oceanview Room at THE EDITION Miami Beach!!! Book Today</p2>
</body>
</html>