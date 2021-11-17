<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'bus');
$db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
if($db===false){
    die("Error: connection error.".mysql_connect_error());
}
if(isset($_POST['DeleteBus'])){
    echo "sucess";
    $bus_no =trim($_POST['bus_no']);
    if($deletebus = $db->prepare("DELETE from bus where bus_no =?")){
        header("location:adminhome.html");
    }
    else{
        echo "no";
    }
    $deletebus->bind_param('s',$bus_no);
    $deletebus->execute();
    $deletestops = $db->prepare("DELETE from stops where bus_no = ?");
    $deletestops->bind_param('s',$bus_no);
    $deletestops->execute();

    
    $deletestops = $db->prepare("DELETE from seats where bus_no = ?");
    $deletestops->bind_param('s',$bus_no);
    $deletestops->execute();
    
    


mysqli_close($db);
}