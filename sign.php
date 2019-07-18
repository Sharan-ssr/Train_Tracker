<?php
include("config.php");
if(isset($_POST['name'])){

  $name=$_POST['name'];
  $uname=$_POST['mail'];
  $passwd=$_POST['password'];
  $passwd1=$_POST['psw-repeat'];
  if($passwd == $passwd1){
   $sql = "INSERT INTO user_data (Name, User, Pass) VALUES ( '".$name."','".$uname."', '".$passwd."')";

	 if ($conn->query($sql) === TRUE) {
    	 header("location:index.php");
	 } else {
    	$error = "Error: " . $sql . "<br>" . $conn->error;
      echo '<script type="text/javascript">alert('.$error.')</script>';
	 }
  }
  else{
  $error =  "Please Enter the Password Correctly";
}
}

$conn->close();
?> 


<html>
<title>SignUp</title>
<head>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
  color:black;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
  color: black;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form method = "POST" action = "#">
  <div class="container">
    <center><h1>Register</h1></center>
    <center><p>Please fill in this form to create an account.</p></center>
    <hr>
    
    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Your Name" name="name" required>

    <label for="email"><b>Mail-id</b></label>
    <input type="text" placeholder="Enter Mail-id" name="mail" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    <p>By creating an account you agree to our <a href="term.php">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="index.php">Sign in</a>.</p>
  </div>
</form>
<center><div style = "font-size:11px; color:red; margin-top:10px"><h3><?php echo $error; ?></h3></div></center>
</body>
</html>