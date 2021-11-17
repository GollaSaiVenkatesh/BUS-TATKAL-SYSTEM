<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'bus');
$db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
if($db===false){
    die("Error: connection error.".mysql_connect_error());
}
if(isset($_POST['seat'])){
    $bus_no =trim($_POST['bus_no']);
    $no_of_seats =trim($_POST['no_of_seats']);
    $a=4 ;
    $b=7;
    $insertQuery = $db->prepare("INSERT INTO seats VALUES(?,?,?)");
    $insertQuery->bind_param('sss',$bus_no,$seat_no,$seat_type);
    for($x=1;$x<=$no_of_seats;$x++){
       $seat_no =$x;
       if($x==$a){
        $seat_type='w';
        $a=$a+4;
       }
       elseif($x==$b and $x!=35){
        $seat_type='w';
        $b=$b+4;
       }
       elseif($x==1 || $x==3){
        $seat_type='w';
       }
       else{
        $seat_type='nw';
       }
       $insertQuery->execute();
    }
    header("location:adminhome.html");
}
