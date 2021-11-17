<body style="background-color:#e7eae5">
    <style type="text/css">
        .sty{ 
                padding-left:300px;
                width:30%;
                height: 500px;
                float:left;
        }
        .border{
            border-left: 1px solid gray;
            position: absolute;
            margin-left:600px;
            height: 450px;
            
        }
        .container {
        display: inline;
        position: relative;
        padding-left: 32px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        
        }
        .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        }
        .checkmark-green {
        position: absolute;
        left: 0;
        height: 30px;
        width: 34px;
        background-color: green;
        text-align:center;
        border: 1px solid green;
        border-radius: 7px;
        color:white;
        font-family:sans-serif;
        font-size:16px;
        font-weight:bold;
        padding-top:4px;
        }
        .container:hover input ~ .checkmark-green {
        background-color: #ccc;
        }
        .container input:checked ~ .checkmark-green {
        background-color: #2196F3;
        }

        .checkmark-green:after {
        content: "";
        position: absolute;
        display: none;
        }
        .container input:checked ~ .checkmark-green:after {
        display: block;
        }

        .checkmark-red {
        position: absolute;
        left: 0;
        height: 30px;
        width: 34px;
        background-color: red;
        text-align:center;
        border: 1px solid red;
        border-radius: 7px;
        color:white;
        font-family:sans-serif;
        font-size:16px;
        font-weight:bold;
        padding-top:4px;
        }

        .button {
        background-color: lightgray;
        border: none;
        color: black;
        padding: 15px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        }

        .button1:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
    </style>

    <?php
    define('DBSERVER', 'localhost');
    define('DBUSERNAME', 'root');
    define('DBPASSWORD', '');
    define('DBNAME', 'bus');
    $db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);
    if($db===false){
        
        die("Error: connection error.".mysql_connect_error());
    } 
    $bus_no=$_GET['bus_no'];
    $source=$_GET['source'];
    $destination=$_GET['destination'];
    $date=$_GET['date'];
    $i0="create table t0(j_date varchar(10))";
    mysqli_query($db, $i0);
    $sqlinsert0 = $db->prepare("INSERT INTO t0 VALUES(?)");
    $sqlinsert0->bind_param('s',$date);
    $result0 = $sqlinsert0->execute();
    $i1="create table t2(bus_no varchar(10),src_city char(15),dst_city char(15))";
    mysqli_query($db, $i1);
    $sqlinsert1 = $db->prepare("INSERT INTO t2 VALUES(?,?,?)");
    $sqlinsert1->bind_param('sss', $bus_no,$source,$destination);
    $result1 = $sqlinsert1->execute();
    $i2="CREATE view src as SELECT t2.bus_no,t2.src_city,t2.dst_city,stops.stop_id 'src_id' FROM t2 INNER JOIN stops ON stops.bus_no =t2.bus_no and t2.src_city=stops.stop_name";
    mysqli_query($db, $i2);
    $i3="CREATE view dst as SELECT t2.bus_no,t2.src_city,t2.dst_city,stops.stop_id 'dst_id' FROM t2 INNER JOIN stops ON stops.bus_no =t2.bus_no and t2.dst_city=stops.stop_name";
    mysqli_query($db, $i3);
    $i4="ALTER TABLE t2 ADD COLUMN dst_id TINYINT UNSIGNED NOT NULL DEFAULT 0";
    mysqli_query($db, $i4);
    $i5="UPDATE t2 INNER JOIN dst ON t2.bus_no=dst.bus_no SET t2.dst_id = dst.dst_id";
    mysqli_query($db, $i5);
    $i6="ALTER TABLE t2 ADD COLUMN src_id TINYINT UNSIGNED NOT NULL DEFAULT 0";
    mysqli_query($db, $i6);
    $i7="UPDATE t2 INNER JOIN src ON t2.bus_no=src.bus_no SET t2.src_id = src.src_id";
    mysqli_query($db, $i7);
    $i8="CREATE VIEW booked AS SELECT seats.bus_no,seats.seat_no,customers.source_city,customers.dst_city FROM customers INNER JOIN seats INNER JOIN t0 ON customers.seat_no=seats.seat_no and customers.bus_no=seats.bus_no and customers.j_date=t0.j_date";
    mysqli_query($db, $i8);
    $i9="CREATE TABLE booke select * from booked";
    mysqli_query($db, $i9);
    $i10="ALTER TABLE booke ADD COLUMN src_id TINYINT UNSIGNED NOT NULL DEFAULT 0";
    mysqli_query($db, $i10);
    $i11="UPDATE booke INNER JOIN stops ON booke.bus_no=stops.bus_no and booke.source_city=stops.stop_name SET booke.src_id = stops.stop_id";
    mysqli_query($db, $i11);
    $i12="ALTER TABLE booke ADD COLUMN dst_id TINYINT UNSIGNED NOT NULL DEFAULT 0";
    mysqli_query($db, $i12);
    $i13="UPDATE booke INNER JOIN stops ON booke.bus_no=stops.bus_no and booke.dst_city=stops.stop_name SET booke.dst_id = stops.stop_id";
    mysqli_query($db, $i13);
    $i14="CREATE view book as SELECT booke.bus_no, booke.seat_no FROM booke INNER JOIN t2 ON booke.bus_no=t2.bus_no and  (t2.src_id = booke.src_id or (t2.src_id > booke.src_id and t2.src_id<booke.dst_id))";
    mysqli_query($db, $i14);
    $i15="CREATE view book1 as select seats.* from seats left join book on seats.seat_no =book.seat_no and seats.bus_no=book.bus_no  where book.seat_no IS NULL";
    mysqli_query($db, $i15);
    $i16="CREATE TABLE bookfinal as select seat_no,seat_type from book1 inner join t2 on t2.bus_no=book1.bus_no";
    mysqli_query($db, $i16);


    $drp0="DROP TABLE t0";
    $drp1="DROP TABLE t2";
    $drp2="DROP VIEW src";
    $drp3="DROP VIEW dst";
    $drp4="DROP VIEW book";
    $drp5="DROP VIEW book1";
    $drp6="DROP TABLE booke";
    $drp7="DROP VIEW booked";

    mysqli_query($db,$drp0);
    mysqli_query($db,$drp1);
    mysqli_query($db,$drp2);
    mysqli_query($db,$drp3);
    mysqli_query($db,$drp4);
    mysqli_query($db,$drp5);                   
    mysqli_query($db,$drp6);
    mysqli_query($db,$drp7);

    $query = $db->prepare("SELECT seat_no FROM bookfinal WHERE seat_no=?");
    echo "<div class='sty' style='padding-top:100px;padding-bottom:10px'>";
    echo "<h1 style='font-family:sans-serif; font-size:40px'>Select your seat</h1>";
    echo '<form id="myform" class="myform " style="padding-left:30px" method="post" name="myform">';
    for($x=1;$x<=36;$x++){
        $query->bind_param('s',$x);
        $query->execute();
        $row = $query->fetch();
        if($row){
            $checkmark="checkmark-green";
            $disable='';
        }
        else{
            $checkmark="checkmark-red";
            $disable='disabled="true"';
        }
        if($x==1){
            echo '<div>';
            echo '<label class="container">&nbsp;
                    <input type="checkbox" '.$disable.' name="myCheckboxes[]" value="'.$x.'">
                    <span class="'.$checkmark.'" >1</span>
                </label>';
            echo '<label class="container">&nbsp;
                    <input type="checkbox" >
                    <span class="'.$checkmark.'" style="background-color:white ;border: 2px solid white; border-radius: 7px;"></span>
                </label>';
            echo '<label class="container">&nbsp;
                    <input type="checkbox"  >
                    <span class="'.$checkmark.'" style="background-color:white ;border: 2px solid white; border-radius: 7px;"></span>
                </label>';   
        }
        elseif($x==2 || $x==3){
            
            echo '<label class="container">&nbsp;
                    <input type="checkbox" '.$disable.' name="myCheckboxes[]" value="'.$x.'">
                    <span class="'.$checkmark.'">'.$x.'</span>
                </label>';
            if($x==3){
                echo '</div>';
            }
        }
        else{
            if($x%4==3){

                echo '<label class="container">&nbsp;
                    <input type="checkbox" '.$disable.' name="myCheckboxes[]" value="'.$x.'">
                    <span class="'.$checkmark.'" >'.$x.'</span>
                </label>';
                if($x==35){
                    
                }
                else{
                    echo '</div>';
                }
                
            }
            else if($x%4==1 && $x!=33){
                echo '<label class="container">&nbsp;
                    <input type="checkbox" '.$disable.' name="myCheckboxes[]" value="'.$x.'">
                    <span class="'.$checkmark.'">'.$x.'</span>
                </label>';
                echo '<label class="container">&nbsp;
                    <input type="checkbox" '.$disable.' name="myCheckboxes[]" value="'.$x.'">
                    <span class="'.$checkmark.'" style="background-color:white ;border: 2px solid white; border-radius: 7px;"></span>
                </label>';
            }
            else{
                if($x%4==0 && $x!=36){
                    echo '<div style="margin-top:20px">';
                }
                echo '<label class="container">&nbsp;
                    <input type="checkbox" '.$disable.' name="myCheckboxes[]" value="'.$x.'">
                    <span class="'.$checkmark.'">'.$x.'</span>
                </label>';
            }
        }
    }
    echo "</div>";
    echo '<div style="padding-top:40px;">
        <button id="submit" type="button">Book Seats</button>
        </div>';
    echo '</form>';
    echo "</div>";
    $query->close();
    include 'drop1.php';
    mysqli_close($db);
    ?>
    <div style='padding-top:180px;height:400px;'>
        <div class="border">
            <div style="padding-left:30px">
                <h1 style="padding-bottom:px">Booking Details</h1>
                <h2>Selected Seats (<span id="length"></span>): <span id="seats"></span></h3>
                <?php
                echo'<button id="checkout" class="button button1">Checkout</button>';
                ?>
                <span class="checkmark-green" style=" margin-left:40px;margin-top: 90px;background-color:green ;border: 2px solid green; border-radius: 7px;"></span>
                <span style="font-family:sans-serif;position:absolute;color:black;margin-top: 98px;margin-left:-40px">Available Seats</span>
                <span class="checkmark-green" style=" margin-left:40px;margin-top: 150px;background-color:red ;border: 2px solid red; border-radius: 7px;"></span>
                <span style="font-family:sans-serif;position:absolute;color:black;margin-top: 154px;margin-left:-40px">Already Booked</span>
                <span class="checkmark-green" style=" margin-left:40px;margin-top: 210px;background-color:#2196F3; border: 2px solid #2196F3; border-radius: 7px;"></span>
                <span style="font-family:sans-serif;position:absolute;color:black;margin-top: 214px;margin-left:-40px">Selected Seats</span>
                
                
                
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        function submitForm() {
            var form = document.myform;
            var dataString = $(form).serialize();
            var a=dataString.replace(/myCheckboxes%5B%5D=/g, "");
            var arr = a.split("&"); 
            var count=arr.length;
            document.getElementById("length").innerHTML = count;
            var str="";
            for (var i=0;i<count;i++){
                str=str+arr[i]+", ";
            }
            
    
        document.getElementById("seats").innerHTML = str.substring(0, str.length - 2);
        sessionStorage.setItem("arr", JSON.stringify(arr));
        }
        $("#submit").click(submitForm);
        function checkout(){
            arr = JSON.parse(sessionStorage.getItem("arr"));
            document.location="details.php?test=" + arr +"&bus_no="+"<?php echo $bus_no ?>"+"&source="+"<?php echo $source ?>"+"&destination="+"<?php echo $destination ?>"+"&date="+"<?php echo $date ?>";
        }
        $("#checkout").click(checkout);
    });
    
    
</script>


