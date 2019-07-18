<?php
   include('session.php');
   $mail="<input type='text' value='$user_check' readonly/>";
?>

<html>
<head>
<style>
body {
	margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.bg {
  /* The image used */
  background-image: url("wall.png");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.navbar {
  overflow: hidden;
  border: 1px;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}


/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}


input[type=text] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  color: black;
}

input[type=text]:focus {
  width: 100%;
}


</style>
</head>
<body>



<div class="navbar">
  <a class="tablinks" onclick="openCity(event, 'Search-trains')">Search-trains</a>
  <a class="tablinks" onclick="openCity(event, 'Book-Tickets')">Book-Tickets</a>
  <div class="dropdown">
    <button class="dropbtn"><?php echo $user_check; ?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a onclick="openCity(event, 'profile')">Profile</a>
      <a onclick="openCity(event, 'Bookings')">My-Bookings</a>
      <a href="logout.php">Signout</a>
    </div>
  </div> 
</div>



<center><div id="Search-trains" class="tabcontent">
  <form method = "POST" action = "#">
    <h1>Search Trains</h1>
  <p>From:</p>
  <input type="text" name="From" >
  <p>To:</p>
  <input type="text" name="To" ><br /><br />
  <input type="submit" value="Search" name="search">
  </form>
</div></center>
 

<center><table border="3">
<?php
if(isset($_POST['search'])){
    $from=$_POST['From'];
    $to=$_POST['To'];

    $sql = "SELECT * FROM Train_info WHERE FROM1 = '".$from."' AND TO1='".$to."' limit 0,1 ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
   // output data of each row   
      echo "<tr><th>FROM</th><th>To</th><th>Train_No</th><th>Train_Name</th><th>Availability</th></tr>";
     while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["FROM1"]. "</td><td>" . $row["TO1"] . "</td><td>". $row["TRAIN_NO"]. "</td><td>". $row["TRAIN_NAME"]. "</td><td>". $row["AVAILABILITY"]. "</td></tr>";
      }
    echo "</table>";
      } 
    else { echo "<tr><th>Sorry Trains are not available for these locations ".$from." and ".$to.".</th></tr>"; }
}
?>
</table></center>



<center><div id="Book-Tickets" class="tabcontent">
  <form method = "POST" action = "#">
    <p>Enter Train Number:</p>
  <input type="text"  name="Train_no" ><br /><br />
  <h1>Payment_Option:</h1>
  <input type="radio" name="Card" value="Card" /> Card<br /><br />
  <input type="submit" value="Submit" name=Submit>
</form>
</div></center>

<?php
if(isset($_POST['Submit'])){
  $Card=$_POST['Card'];
  $trno=$_POST['Train_no'];
  if($Card){
    #$sql1="SELECT TRAIN_NAME FROM Train_info WHERE TRAIN_NO = '".$trno."' ";
   #if ($conn->query($sql1) === TRUE) {
     // do stuff...
  		$_SESSION['trainno'] = $trno;
    	header("location:payment.php");
		
	#}
  }
  else
  {
  	$pay_error = "Choose a payment method";
  }
}
?>


<center><div id="profile" class="tabcontent">
  <form method = "POST" action = "#">
    <h1>User Information</h1>
  <p>Name</p>
  <input type="text" name="Name" readonly>
  <p>Mail id</p>
  <!--
  <input type="text" name="Mailid" readonly><br /><br /> !-->
  <?php echo $mail; ?>
  <p>DOB</p>
  <input type="text" name="DOB" ><br /><br />
  <p>Address</p>
  <input type="text" name="Address" ><br /><br />
  <p>Contact</p>
  <input type="text" name="Contact" ><br /><br />
  <input type="submit" value="Update" name="Update">
  </form>
</div></center>

<?php
if(isset($_POST['Update'])){
    $name=$_POST['Name'];
    $mailid=$_POST['Mailid'];
    $dob=$_POST['DOB'];
    $address=$_POST['Address'];
    $contact=$_POST['Contact'];
    $success="Updation Successful";
    $sql = "UPDATE user_data SET DOB = '".$dob."', Address = '".$address."', Contact = '".$contact."' WHERE User = '".$user_check."'";
	if ($conn->query($sql) === TRUE) {
    	echo '<script type="text/javascript">alert('.$success.')</script>';
	 } else {
    	$error = "Error: " . $sql . "<br>" . $conn->error;
      echo '<script type="text/javascript">alert('.$error.')</script>';
	 }
}
?>

<center><div id="Bookings" class="tabcontent">
  <form method = "POST" action = "#">
    <h1>Your Bookings</h1>
  <center><table border="3">
 <?php
    $sql = "SELECT FROM1, TO1, TRAIN_NO, TRAIN_NAME,time,date FROM Train_info WHERE TRAIN_NO = (SELECT Bookings FROM user_data WHERE User='".$user_check."') limit 0,1 ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
   // output data of each row   
      echo "<tr><th>FROM</th><th>To</th><th>Train_No</th><th>Train_Name</th><th>Date</th><th>Time</th></tr>";
     while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["FROM1"]. "</td><td>" . $row["TO1"] . "</td><td>". $row["TRAIN_NO"]. "</td><td>". $row["TRAIN_NAME"]. "</td><td>". $row["date"]. "</td><td>". $row["time"]. "</td></tr>";
      }
    echo "</table>";
      } 
    else { echo "<tr><th>There are no booking yet.</th></tr>"; }
?>
</table></center>
  
  </form>
</div></center>




<div class="bg"></div>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>



</body>
</html>