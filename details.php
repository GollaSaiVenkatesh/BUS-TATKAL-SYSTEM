<body style="background:#34495e">
    <style type="text/css">
        legend { 
            width: 170px; 
            padding: 2px; 
            margin-left: calc(50% - 100px - 8px); 
            font-weight:bold;
            font-family:sans-serif;
            color:white;
            
        } 
        .title {
            font-size: 24px;
            color: white;
            font-weight: 400;
            margin-bottom: 40px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 22px;
        }
    
    .label {
        font-size: 16px;
        font-weight:bold;
        font-family:sans-serif;
        color: white;
        text-transform: capitalize;
        display: block;
        margin-bottom: 5px;
    }
    
    .input-style {
        line-height: 30px;
        background: #fafafa;
        
        border-radius: 5px;
        padding: 0 20px;
        font-size: 16px;
        color: #666;
        
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
    $drp8="DROP TABLE bookfinal";
    mysqli_query($db,$drp8);
    $bus_no=$_GET['bus_no'];
    $source=$_GET['source'];
    $destination=$_GET['destination'];
    $seats=$_GET['test'];
    $date=$_GET['date'];
    $arr=explode(",",$seats);
    $i=1;

    echo '<h2 class="title" style="text-align:center;">Passenger Information</h2>';
    echo '<form name="myform"  >';
    foreach ($arr as &$value) {
        echo "<div style='margin-left:250px; margin-top:20px; width:800px'>";
        
        printf("<fieldset ><legend> &nbsp;Passenger %u | Seat %u </legend>",$i,$value);
        $a="gender";
        $a.=$i;
        echo '<div style="margin-left:100px" >';
        echo '<br>';
        echo '<div class="input-group">
                <label class="label">Name</label>
                <input class="input-style" type="text" name="name[]" id="c_name" size="50" required="required">
            </div>';
        echo '<div class="input-group">
                <label class="label"> Email ID</label>
                <input class="input-style" size="50" name="emailid[]" type="text" >
            </div>';

        echo '<div class="input-group">
                <label class="label" >Gender</label>
                <input type="radio" id="male" name="'.$a.'" value="male">
                <label style="color:white" for="male">Male</label>
                <input type="radio" id="female" name="'.$a.'" value="female">
                <label  style="color:white" for="female">Female</label>
            </div>';
        echo '<div class="input-group">
                <label class="label"> Age</label>
                <input class="input-style" name="age[]"  type="number" pattern="/^[1-9]?[0-9]{1}$|^150$/"  data-validation-msg="Please enter valid Age" >
            </div>';
        echo'</div>';
        $i=$i+1;
        echo '</fieldset>';
        echo "</div>";
    }

    echo '</form>';
    echo '<button style="margin-left:600px;padding:10px 20px;font-weight:bold;font-family:sans-serif" id="submit"  name="submit" value="submit">Submit</button>';
    ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        function submitForm() {
            var name=document.getElementsByName('name[]');
            count=name.length;
            var gender = [];
            
            for (var i=1;i<count+1;i++){
                var g='gender'+i;
                var k=$(document.getElementsByName(g)).serialize()
                var t=k.replace('gender'+i+'=', "");
                gender[i-1]=t;
                }
                
            var age=document.getElementsByName('age[]');
            var emailid=document.getElementsByName('emailid[]');
            var NAME=[] ,GENDER=[],AGE=[],EMAILID=[];
            count=name.length;
            for (var i=0;i<count;i++){
                NAME[i]=name[i].value;
                GENDER[i]=gender[i];
                AGE[i]=age[i].value;
                EMAILID[i]=emailid[i].value;

            }
            console.log(NAME);
            console.log(GENDER);
            console.log(AGE);
            console.log(EMAILID);
            document.location="final1.php?names="+NAME+"&bus_no="+"<?php echo $bus_no ?>"+"&source="+"<?php echo $source ?>"+"&destination="+"<?php echo $destination ?>"+"&genders="+GENDER+"&ages="+AGE+"&emailids="+EMAILID+"&date="+"<?php echo $date ?>"+"&seats="+"<?php echo $seats ?>";
        }
        $("#submit").click(submitForm);
    });
    
    
</script>



