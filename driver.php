<?php

if(isset($_GET['bus_no'])){
  $bus_no=$_GET['bus_no'];
}else{
  echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="driver.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Driver Page</title>
</head>
<body>
  <nav>
    <label class="logo">RTC BUS TATKAL</label>
    <ul>
      <li>
        <a class="active" href="#">Home</a>
      </li>
      <li><a href="bookingid.html">View passenger details</a></li>
      <li><a href="index.html">Logout</a></li>
    </ul>
</nav>
<section>
<form class="box">
   <h1>See seats</h1>
   <input type="text" name="source" id="source" placeholder="Leaving from" required="required">
   <input type="text" name="destination" id="dest" placeholder="Going to" required="required">
   <input type="date" name="date" id="doj" min="" placeholder="Date of journey" required="required"> <br> <br>
   <input type="button" name="searchBtn" id="searchBtn" value="search">
</form>
</section>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    function datepick(){
      var today = new Date().toISOString().split('T')[0];
      document.getElementsByName("date")[0].setAttribute('min', today);
    }
    $("#doj").click(datepick);
    function submit(){
      var source=document.getElementById("source").value;
      var dest=document.getElementById("dest").value;
      var date=document.getElementById("doj").value;
      document.location="seatlayout1.php?bus_no="+"<?php echo $bus_no ?>"+"&source="+source+"&destination="+dest+"&date="+date;
    }
    $("#searchBtn").click(submit);

  });

</script>