<style>
table, th, td {
  border: 1px solid black;
}
body{
    
    background:white;
    font-family: sans-serif;
    overflow: hidden;
    user-select: none;
  }
.tbl-content{
  height:600px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
td{
  padding: 15px;
  text-align: center;
  vertical-align:middle;
  
  font-size: 16px;
  color: black;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}
table{
  margin-left:330px;
  margin-top:40px;
  width:60%;

  
}
.a{
    text-transform:uppercase;
    font-weight: bold;

}
nav .logo{
    color: white;
    font-size: 33px;
    font-weight: bold;
    line-height: 70px;
    padding-left: 110px;
  }
  nav{
    height: 70px;
    background: #063247;
    box-shadow: 0 3px 15px rgba(0,0,0,.4);
  }
  nav ul{
    float: right;
    margin-right: 30px;
  }
  nav ul li{
    display: inline-block;
  }
  nav ul li a{
    text-decoration: none;
    
    color: white;
    display: block;
    padding: 0 15px;
    line-height: 50px;
    font-size: 20px;
    background: #063247;
    transition: .5s;
    top:0;
  }
  nav ul li a:hover{
    color: #23dbdb;
  }
  nav ul ul{
    position: absolute;
    top: 85px;
    border-top: 3px solid #23dbdb;
    opacity: 0;
    visibility: hidden;
  }
  nav ul li:hover > ul{
    top: 70px;
    opacity: 1;
    visibility: visible;
    transition: .3s linear;
  }
  nav ul ul li{
    width: 150px;
    display: list-item;
    position: relative;
    border: 1px solid #042331;
    border-top: none;
  }
  nav ul ul li a{
    line-height: 50px;
  }
</style>

<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
</head>
<body>
<nav>
    <label class="logo">RTC BUS TATKAL</label>
    <ul>
      <li>
        <a class="active" href="driver.php">Home</a>
      </li>
      <li><a href="index.html">Logout</a></li>
    </ul>
</nav>
</body>
</html>
<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'bus');
$db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
if($db===false){
    die("Error: connection error.".mysql_connect_error());
}
if(isset($_POST['search'])){
    $bookingid =trim($_POST['bookingid']);
    $search = "select * from customers where booking_id = $bookingid";
    $res = mysqli_query($db,$search);
    if($row = mysqli_fetch_row($res)){
       echo'<div class="tbl-content">';
       echo'<table cellpadding="0" cellspacing="0" border="0">';
       echo '<tr><td class="a">Name </td>';
       echo '<td >'.$row[1].'</td></tr>';
       echo  '<tr><td class="a">Gender</td>';
       echo '<td>'.$row[2].'</td></tr>';
       echo '<tr><td class="a">age</td>';
       echo '<td>'.$row[3].'</td></tr>';
       echo  '<tr><td class="a">mailid</td>';
       echo '<td>'.$row[4].'</td></tr>';
       echo '<tr><td class="a">journey_date</td>';
       echo '<td>'.$row[5].'</td></tr>';
       echo  '<tr><td class="a">Source_City</td>';
       echo '<td>'.$row[6].'</td></tr>';
       echo '<tr><td class="a">Destination_City</td>';
       echo '<td>'.$row[7].'</td></tr>';
       echo  '<tr><td class="a">Bus_no</td>';
       echo '<td>'.$row[8].'</td></tr>';
       echo '<tr><td class="a">Seat_no</td>';
       echo '<td>'.$row[9].'</td></tr>';  
       echo'</table>';   
       echo '</div>'; 
    }
    


mysqli_close($db);
}