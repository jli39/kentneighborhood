<?php

require("PHP file.php");

//Get parameters from URL
//$center_lat = $_GET["lat"];
//$center_lng = $_GET["lng"];
//$radius = $GET["radius"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM `appartment`";
  //mysql_real_escape_string($center_lat);
  //mysql_real_escape_string($center_lng);
  //mysql_real_escape_string($center_lat);
  //mysql_real_escape_string($radius);
$result = mysql_query($query);

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  //$newnode->setAttribute("id",$row['id']);
  //$newnode->setAttribute("name",$row['name']);
  //$newnode->setAttribute("address", $row['address']);
   $newnode->setAttribute("room_num",$row['room_num']);
    $newnode->setAttribute("date",$row['date']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("bed_room", $row['bed_room']);
}
$result=mysql_query("select count(*) as max from `appartment`");
$re = mysql_fetch_object($result);
$max = $re->max;

echo $dom->saveXML();

?>