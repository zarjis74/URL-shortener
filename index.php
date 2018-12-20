<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="style.css">
  
		
	<title>URL Shortening Service </title>   
<head>
 
<body>
	<center>

		<h1>URL Shortening Service</h1>
		<form method="POST"  action="index.php">    <!-- pst method used and its action to index.php file -->
		 <input type="text" name="urlshort" size="70"  placeholder="Enter link..." > <br><br> <!--url paste box -->
		<input type="submit" name="submit" style="color: black">  <!-- create button and its name-->
		<body style="background-color:coral;">   <!--set the backgorund color-->
        
		<style>
		
.footer {    
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 10%;
    background-color: black;
   
    color: white;
    text-align: center;
}
</style>

<div class="footer">
  <p> About   |  Blog   |  Support  |  Contact  |  Developers  |  Privacy  |  Policy  |  Terms Of Service </p>   
  

</div>

<?php

if (isset($_POST["submit"])){
	$conn = mysqli_connect('localhost','zarjis','123456','url');   // database connection
	
	
	
	$longurl = $_POST ["urlshort"];
	if(strlen($longurl)<=5){
		echo "Invalid URL";
	}
	else{
	$shorturl = substr(md5( microtime()), rand(0,26),5);       //substr convert array string , md5 will incript the time , rand function will create string 0 to 26 ,5 
	$query = "INSERT INTO shorturl (shorturl,longurl) VALUES ('$shorturl','$longurl')";    // inserting to database
	

	$result = mysqli_query($conn,$query);   // shorturl 
	if ($result) {
		echo "Your Short Url Link is ::  http://localhost/url/$shorturl";     // showing converted short url
		$con = mysqli_connect('localhost','zarjis','123456','url');   // connecting t db
if(mysqli_connect_errno()){     // condition if fails
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
$sql = "SELECT * FROM shorturl";  // taking value from shrturl table from database
$result = mysqli_query($con, $sql);  
echo '<table>';   // histry table
echo '<tr><th>ID</th><th>Long URL</th><th>Short URL</th></tr>';   //printing
while($row = mysqli_fetch_assoc($result)){  // show data frm database t table rowwise
    echo '<tr><td>'.$row['id'].'</td><td>'.$row['longurl'].'</td><td>'.$row['shorturl'].'</td></tr>';
}
echo '</table>';
		
}
	else{
		echo "We are facing some problems"; //if not work
	}
}

if (isset($_GET["link"])) {  
	while ($row = mysqli_fetch_assoc($fetchresult)) { //udating the table
		$visitlongurl = $row ["longurl"];
		$con = mysqli_connect('localhost','zarjis','123456','url');
if(mysqli_connect_errno()){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
$sql = "SELECT * FROM shorturl";
$result = mysqli_query($con, $sql);
echo '<table>'; 
echo '<tr><th>ID</th><th>Long URL</th><th>Short URL</th></tr>';
while($row = mysqli_fetch_assoc($result)){
    echo '<tr><td>'.$row['id'].'</td><td>'.$row['longurl'].'</td><td>'.$row['shorturl'].'</td></tr>';  
}
echo '</table>';}
	
		header ("Location: $visitlongurl");  
		exit();
	}
}
?>