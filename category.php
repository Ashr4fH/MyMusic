<?php
// If the user requested logout go back to login.php
if ( isset($_POST['logout']) ) {
    header('Location: login.php');
    return;
}
?>
<!DOCTYPE HTML>
<html>
  <head>
  <title>category page</title>
  <?php require_once "bootstrap.php"; ?>
  </head>

<body>
  <form method="post" >
    <input type="submit" name="logout" value="Logout">

<center>
  <?php
  //forward login user name
  if ( isset($_REQUEST['name']) ) {
      echo "<p><h2>Welcome: ";
      echo htmlentities($_REQUEST['name']);
      echo "</h2></p>\n";
  }
  ?>
<tr><td><h1><strong>CATEGORIES</strong></h1></td></tr>

<style>
input{
  background-color: navy;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px 2px;
  cursor: pointer;
}
table, th, td {
  border-spacing: 5px;
}
button {
  background-color: navy;
  border: none;
  color: white;
  height:100px;
  width:200px;
}
body {
  background-image: url('b.jpg');
}
</style>

<table border = "1">

<tr>
<form action="" method = "get" target = "_blank" onsubmit></form>

<form action="index.php" method = "get" onsubmit>
<td><button type = "submit">ENGLISH</button></td></form>

<form action="index1.php" method = "get"  onsubmit>
<td><button type = "submit">MALAY</button></td></form>
</tr>

<tr>
<form action="index2.php" method = "get" onsubmit>
<td><button type = "submit">K-POP</button></td></form>

<form action="index3.php" method = "get" onsubmit>
<td><button type = "submit">OTHERS</button></td></form>
</tr>

</body>
</html>
