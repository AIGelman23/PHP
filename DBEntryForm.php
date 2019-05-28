<?php
$servername = "localhost";
$database = "ContactDB";
$username = "ContactDB_admin";
$password = "Superman0777";

// Create connection to mySQL server

$conn = mysqli_connect ($servername, $username, $password, $database);

// Check to make sure connection is stable

if (!$conn) {
		die("Connection failed to your database: " . mysqli_connect_error());
}

echo "Connected successfully to your database!";

?>

<?php

$firstname_error = $lastname_error = $choice_error = $comment_error = "";
$firstname = $lastname = $choice = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["firstname"])) {
$firstname_error = "First name is required";

} else {

$firstname = check_firstNameInput($_POST["firstname"]);

if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {

$firstname_error = "Only letters and white space allowed";
  }
}

if (empty($_POST["lastname"])) {
$lastname_error = "Last name is required";

} else {

$lastname = check_lastNameInput($_POST["lastname"]);

if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {

$lastname_error = "Only letters and white space allowed";
  }
}

if (empty($_POST["comment"])) {
$comment_error = "Comment is required";

} else {

$comment = check_commentInput($_POST["comment"]);

if (!preg_match("/^[a-zA-Z]*$/", $comment)) {

$comment_error = "Only letters and white space allowed";
  }
}

}

// functions that run the code and match to see if their only letters and numbers

function check_firstNameInput($firstname) {
$fname= preg_replace("/[^a-zA-Z]/", "", $firstname);
/*$fname= md5($firstname);  */
$firstname = $fname;
return $firstname;  
}

function check_lastNameInput($lastname) {
$lname= preg_replace("/[^a-zA-Z]/", "", $lastname);
$lastname = $lname;
return $lastname;  
}

function check_commentInput($comment) {
$cment= preg_replace("/[^a-zA-Z]/", "", $comment);
$comment = $cment;
return $comment;  
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leoclipse - Contact Us</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Crimson+Text|Open+Sans|Playfair+Display|Dancing+Script|Promixma-Nova" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="style.css"/>
<link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon"/>

<nav></nav>

<body style="margin: 0 auto; margin-top: 50px;">
<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >  
  <div class="row">
      <div class="col-10" style="padding: 10px;">
       </div>
      <h4>Tell us about your interests today!</h4>
          <div class="col-55" style="padding: 10px;">
      <fieldset>
        <input type="text" id="fname" name="firstname" placeholder="Your name.." tabindex="1" required autofocus>
        <span class="error"><?php echo $firstname_error;?></span>
        </fieldset>
      </div>
    </div>
    <div class="row">
      <div class="col-10">
  
      <div class="col-20" style="padding: 10px;">
        <fieldset>
        <input type="text" id="lname" name="lastname"   placeholder="Your last name.." tabindex="2" required autofocus>
         <span class="error"><?php echo $lastname_error;?></span>
        </fieldset>
      </div>
    </div>
    <div class="row">
      </div>
      <div class="col-55" style="padding: 10px;">
      <fieldset>
        <select id="choice"  name="choice" rows="30"  tabindex="3" required autofocus>
          <option value="Web Design">Web Design</option>
          <option value="Java Programming">Java Programming</option>
          <option value="Career Opportunities">Career Opportunities</option>
        </select>
        <span class="error"><?php echo $choice_error;?></span>
        </fieldset>
      </div>
    </div>
    <div class="row">
      <div class="col-10" style="padding: 10px;">
      <div class="col-35">
      <fieldset>
        <textarea id="subject" name="comment" placeholder="Write something.." tabindex="4" style="height:200px" required autofocus></textarea>
        <span class="error"><?php echo $comment_error;?></span>
        </fieldset>
      </div>
    </div>
    <div class="row">
     <div class="col-10" style="padding: 20px;">
     <input type="submit" onclick="sendFunction()" value="Submit" style="width: 100%;">
    </div>
  </form>
</div>
		</div>
			</div>
         </div>   
         
     
</body>

    <script> 
    function sendFunction() {
  alert("Successfully sent!");
   }
    </script>


<?php 

if (!$_POST['Submit']) {

$fname= preg_replace("/[^a-zA-Z]/", "", $firstname);
/* $fname = md5($firstname); */
$fname = $_POST['firstname'];
$lname= preg_replace("/[^a-zA-Z]/", "", $lastname);
$lname = $_POST['lastname'];
$choice= $_POST['choice'];
$cment = preg_replace("/[^a-zA-Z]/", "", $comment);
$cment= $_POST['comment'];

if (!empty($firstname) && !empty($lastname) && !empty($choice) && !empty($comment)) {

$firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
$lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
$choice = filter_var($choice, FILTER_SANITIZE_STRING);
$comment = filter_var($comment, FILTER_SANITIZE_STRING);

}

$sql = "INSERT INTO Persons (LastName, FirstName, Comments, InquiryType) VALUES ('$lastname', '$firstname', '$comment', '$choice')";

if (mysqli_query($conn, $sql)) {
 echo "<br>";
 echo "<h2>My Input: </h2>" . "First name: " . $firstname . "Last name:  " . $lastname . "Inquiry: " . $choice . "Comments: " . $comment;

mysqli_close($conn);
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}


?>

</html>