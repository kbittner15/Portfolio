

<html>
<head>
	<title>People</title>
	<link rel="stylesheet" href="assets/Styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
</head>


	<body>

	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="Profile.html">My Profile</a>
  <a href="HomePage.html">Home</a>
  <a href="People.html">People</a>

</div>

<div id="main">
 <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
</div>

<script src="assets/JavaScript.js"></script>


<table>
    <tr>
<th>FirstName</th>
<th>LastName</th>
<th>Email</th>
</tr>

<?php
$conn = mysqli_connect("127.0.0.1", "user", "12345678", "MyBook");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  FirstName,LastName,Email FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"] . "</td><td>"
. $row["Email"]. "</td></tr>";
}
echo "</table>";

} else { echo "0 results"; }
$conn->close();
?>

</table>
</body>
</html>