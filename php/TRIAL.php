<?php

// Variables set to empty values
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = $dateErr = $timeErr = "";
$firstname = $lastname = $email = $phone = $company = $date = $time = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["b_firstname"])) {
        $firstnameErr = "First Name is required";
      } else {
        $firstname = test_input($_POST["b_firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
          $firstnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["b_lastname"])) {
        $lastnameErr = "Last Name is required";
      } else {
        $lastname = test_input($_POST["b_lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
          $lastnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["b_email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["b_email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["b_phone"])) {
        $phoneErr = "Phone is required";
      } else {
        $phone = test_input($_POST["b_phone"]);
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        if(!preg_match('/^[0-9]{10}+$/', $phone)) {
          $phoneErr = "Invalid phone number";
        }
    }

    if (empty($_POST["company"])) {
        $company = "";
      } else {
        $company = test_input($_POST["company"]);
    }

    if (empty($_POST["date"])) {
        $date = "";
    } else {
        $date = test_input($_POST["date"]);
        list($year, $month, $day) = explode('-', $date);
        if (false === strtotime($date) || checkdate($month, $day, $year)){
            $dateErr = "Invalid date";
        }
    }

    if (empty($_POST["time"])) {
        $time = "";
    } else {
        $time = test_input($_POST["time"]);
        if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time)){
            $timeErr = "Invalid time";
        }
    }

}

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }

// // Server connection
// $servername = "panel.000webhost.com";
// $username = "id21201280_mycv";
// $password = "$123aBc$";
// $dbname = "id21201280_mydb";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// } 
// echo "Connected successfully";

echo $firstname;
echo $lastname;
echo $email;
echo $date;
echo $time;
?>

<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <title>Contact</title>

        <meta charset="utf-8">
        <meta name="keywords" content="Software Engineer, Education, CV, Portfolio">
        <meta name="description" content="Software Engineer Matteo Poire' presentation, education">
        <!--http-equiv simulates a HTTP Response Header-->
        <meta http-equiv="expires" content="18000">     <!--Page newly requested to the server every 5 hours-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="reised" content="27/05/2023">       <!--Last date when changes were done to the pages-->
        <meta name="rating" content="general">          <!--Identifying the kind of page's audience-->

        <link type="text/css" rel="stylesheet" href="./style/styleContact.css">
        <script src="./js/scriptContact.js"></script>
    </head>
    <body onload="media()">
        <header>
            <div class="header" id="header">
                <div class="name_square">
                    <div class="square"></div>
                    <div class="name">
                        <h1>Matteo Poir&eacute</h1>
                        <span class="slash">/</span><span>SOFTWARE ENGINEER</span>
                    </div>
                </div>
                <nav class="dropdown">
                    <button type="button" title="menu" class="dropbtn" onclick="menu()">
                        <hr><hr><hr>
                    </button>
                    <div class="dropdown-content" id="menu">
                        <a href="./index.html">HOMEPAGE</a>
                        <a href="./education.html">EDUCATION</a>
                        <a href="./skill.html">SKILLS</a>
                        <a href="./work.html">WORK</a>
                        <a class="active" href="#contact">CONTACT</a>
                    </div>
                </nav>
            </div>
        </header>
        <section>
            <div class="row">
                <div class="section">
                    <button type="button" value="DARK MODE" class="mode" id="mode" onclick="dark_light()">
                        <img src="./img/sun.svg" alt="light" id="sun_moon">
                    </button>
                    <div class="contact">
                        <div class="ct_square"></div>
                        <h1>Let's Talk</h1>
                    </div>
                    <div class="container">
                        <div class="form_container col-5">
                            <h3>Send me a message</h3>
                            <p><span class="error">* required field</span></p>
                            <form action="./php/form_action_page.php" method="post" autocomplete="on">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="fname" name="firstname" placeholder="Your name.." value="<?php echo $firstname;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $firstnameErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="lname">Last Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="<?php echo $lastname;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $lastnameErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="email">Email:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" id="email" name="email" placeholder="email@hot.com" value="<?php echo $email;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $emailErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="phone">Phone number:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="tel" id="phone" name="phone" placeholder="123-45-67-890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}" value="<?php echo $phone;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $phoneErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="country">Country</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="country" name="country" placeholder="Italy" autocomplete="on">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="subject">Subject</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="subject" name="subject" placeholder="Message Subject">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="message">Message</label>
                                    </div>
                                    <div class="col-9">
                                        <textarea type="text" id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                     <input type="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                        <div class="booking_container col-5" method="post">
                            <h3>Book an appointment</h3>
                            <p><span class="error">* required field</span></p>
                            <form action="./php/booking_action_page.php">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_fname">First Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="b_fname" name="firstname" placeholder="Your name.." autocomplete="on" required>                                        
                                    </div>
                                    <span class="error">*<?php echo $firstnameErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_lname">Last Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="b_lname" name="lastname" placeholder="Your last name.." autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $lastnameErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_email">Email:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" id="b_email" name="email" placeholder="email@hot.com" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $emailErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_phone">Phone number:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="tel" id="b_phone" name="phone" placeholder="123-45-67-890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $phoneErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="company">Company</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="company" name="company" placeholder="Company name" autocomplete="on">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="date">Date:</label> 
                                    </div>
                                    <div class="col-9">
                                        <input type="date" id="date" name="date" required>
                                    </div>
                                    <span class="error">*<?php echo $dateErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="time">Time:</label> 
                                    </div>
                                    <div class="col-9">
                                        <input type="time" id="time" name="time" required>
                                    </div>
                                    <span class="error">*<?php echo $timeErr;?></span>
                                </div>
                                <br>
                                <div class="row">
                                     <input type="submit" value="Book">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer">
                <p class="foot">&copy 2023 by Matteo Poir&eacute.</p>
                <ul class="foot">
                    <li class="foot">Call<br><span class="foot">+39 366 536 3515</span></li>
                    <li class="foot">Write<br><a href="mailto:teo16.96@gmail.com" id="email">teo16.96@gmail.com</a></li>
                    <li class="foot">Follow<br>
                        <ul>
                            <li><a href="https://www.facebook.com/matteo.poire.9" rel="external" target="_blank" title="facebook page"><img src="./img/facebook_icon.png" alt="facebook profile" id="facebook_foot"></a></li>
                            <li><a href="https://www.instagram.com/teo.poire/" rel="external" target="_blank" title="instagram page"><img src="./img/instagram_icon.png" alt="instagram profile" id="instagram_foot"></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </footer>
    </body>
</html>