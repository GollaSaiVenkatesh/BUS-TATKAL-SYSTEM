<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'bus');
$db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
if($db===false){
    die("Error: connection error.".mysql_connect_error());
} 
$a=$_GET['names'];
$b=$_GET['genders'];
$c=$_GET['ages'];
$d=$_GET['emailids'];
$e=$_GET['seats'];
$names=explode(",",$a);
$genders=explode(",",$b);
$ages=explode(",",$c);
$emailids=explode(",",$d);
$bus_no=$_GET['bus_no'];
$date=$_GET['date'];
$source=$_GET['source'];
$destination=$_GET['destination'];
$seats=explode(",",$e);
$query = $db->prepare("SELECT max(booking_id) FROM customers");
for ($i=0;$i<count($names);$i++){
    if($genders[$i]=="male"){
        $genders[$i]="M";
    }
    else{
        $genders[$i]="F";
    }
    $insertQuery = $db->prepare("INSERT INTO customers (c_name,gender,age,cst_mailid,j_date,source_city,dst_city,bus_no,seat_no) VALUES(?,?,?,?,?,?,?,?,?)");
    $ages[$i]=(int)$ages[$i];
    $seats[$i]=(int)$seats[$i];
    $insertQuery->bind_param("ssisssssi",$names[$i],$genders[$i],$ages[$i],$emailids[$i],$date,$source,$destination,$bus_no,$seats[$i]);
    $result = $insertQuery->execute();
    if(!$result){
        echo "unsuccessful";
        
    }
}

$query->execute();
$query->bind_result($temp);
$row = $query->fetch(); 
$str='';
for ($i=$temp-count($names)+1;$i<=$temp;$i++){
    $str.=$i;
    $str.=" ";
}
echo '<div style="font-family:sans-serif;margin-top:10px">';
echo "<h1 style='text-align:center'>Booking successful\n</h1>";
printf("<h2 style='text-align:center'>Your Booking id(s): %s</h2>",$str);
echo "<div style='width:60%; text-align:justify;margin-left:300px'>";
echo "<p>On behalf of everyone at TATKALBUSBOOKING, we would like to thank you for using our services. We value the trust you have put in our services and would like to thank you for that. It's always a pleasure serving you and we certainly look forward to doing that in the future. Your feedback is very important as we are constantly looking for ways to improve our services.</p>";
echo "<p style='text-align:center'>Thank you very much.</p>";
echo "</div>";
echo "</div>";
?>

