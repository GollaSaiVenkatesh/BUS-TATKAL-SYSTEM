<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'bus');
$db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
if($db===false){
    die("Error: connection error.".mysql_connect_error());
}
if(isset($_POST['AddStop'])){
    echo "sucess2";
    $stop_id =trim($_POST['stop_id']);
    $stop_name =trim($_POST['stop_name']);
    $bus_no =trim($_POST['bus_no']);
    $arrival_time =trim($_POST['arrival_time']);
    $fare =trim($_POST['Fare']);
    if($query = $db->prepare("SELECT * FROM stops where bus_no = ? and stop_id = ?")){
        $error = '';
        $query->bind_param('ss', $bus_no, $stop_id);
        $query->execute();
        $query->store_result();
        if($query->num_rows>0){
            $error='<p class="error">A stop with same stop_id already registered</p>';
        }else{
        
           //adding data of stop into bus table
                if(empty($error)){
                    echo "success3";
                    $insertQuery = $db->prepare("INSERT INTO stops VALUES(?,?,?,?,?)");
                    $insertQuery->bind_param("sssss",$bus_no,$stop_id,$stop_name,$arrival_time,$fare);
                    $result = $insertQuery->execute();
                    if($result){
                        header("location:addstop.html");
                    }else{
                        $error='<p class="error">Something went wrong</p>';
                    }
                }
            
        }
    }
else{
    echo "error";
}
$query->close();
$insertQuery->close();
mysqli_close($db);
}