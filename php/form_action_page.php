<?php
// Variables set to empty values
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = "";
$firstname = $lastname = $email = $phone = $country = $subject = $message = "";
$error = $response = "";
$mymail = "teo16.96@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First Name is required";
        $error = 1;
      } else {
        $firstname = test_input($_POST["firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
          $firstnameErr = "Only letters and white space allowed";
          $error = 1;
        }
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last Name is required";
        $error = 1;
      } else {
        $lastname = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
          $lastnameErr = "Only letters and white space allowed";
          $error = 1;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $error = 1;
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
          $error = 1;
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
        $error = 1;
      } else {
        $phone = test_input($_POST["phone"]);
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        if(!preg_match('/^\d{3}-\d{2}-\d{2}-\d{3}+$/', $phone)) {
          $phoneErr = "Invalid phone number";
          $error = 1;
        }
    }

    if (empty($_POST["country"])) {
        $country = "";
      } else {
        $country = test_input($_POST["country"]);
    }

    if (empty($_POST["subject"])) {
        $subject = "";
      } else {
        $subject = test_input($_POST["subject"]);
    }

    if (empty($_POST["message"])) {
        $message = "";
      } else {
        $message = test_input($_POST["message"]);
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// echo "<h2>Your Input:</h2>";
// echo $firstname;
// echo "<br>";
// echo $lastname;
// echo "<br>";
// echo $email;
// echo "<br>";
// echo $phone;
// echo "<br>";
// echo $country;
// echo "<br>";
// echo $subject;
// echo $message;
// echo "<br>";

if($error) {
    $response .= "<p>The message can't be sent correctly.</p><button type='button' value='OK' onclick='read()'>OK</button>";
}else {
    // Using wordwrap() for lines longer than 70 characters
    $msg = wordwrap($message,70);
    $header = "From: " . $email;

    // For Windows
    $msg = str_replace("\n.", "\n..", $msg);

    // send email
    if (mail($mymail,$subject,$msg, $header) === false) {
    $response .= "<p>The message can't be sent correctly.</p><button type='button' value='OK' onclick='read()'>OK</button>";
    }else {
    mail($mymail,$subject,$msg, $header);
    $response .= "<p>The message was sent correctly, you'll get an answer as soon as possible.</p><button type='button' value='OK' onclick='read()'>OK</button>";
    }
}
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

        <link type="text/css" rel="stylesheet" href="../style/styleFormAction.css">
        <script src="../js/scriptFormAction.js"></script>
    </head>
    <body onload="media()">
        <header>
            <div class="header" id="header">
                <div class="name_square">
                    <div class="square"></div>
                    <div class="name">
                        <h1>Matteo Poir&eacute;</h1>
                        <span class="slash">/</span><span>SOFTWARE ENGINEER</span>
                    </div>
                </div>
                <nav class="dropdown">
                    <button type="button" title="menu" class="dropbtn" onclick="menu()">
                        <hr><hr><hr>
                    </button>
                    <div class="dropdown-content" id="menu">
                        <a href="../index.html">HOMEPAGE</a>
                        <a href="../education.html">EDUCATION</a>
                        <a href="../skill.html">SKILLS</a>
                        <a href="../work.html">WORK</a>
                        <a class="active" href="#contact">CONTACT</a>
                    </div>
                </nav>
            </div>
        </header>
        <section>
            <div class="row">
                <div class="section">
                    <button type="button" value="DARK MODE" class="mode" id="mode" onclick="dark_light()">
                        <img src="../img/sun.svg" alt="light" id="sun_moon">
                    </button>
                    <div class="contact">
                        <div class="ct_square"></div>
                        <h1>Let's Talk</h1>
                    </div>
                    <div class="response">
                        <?php echo $response?>
                    </div>
                    <div class="container">
                        <div class="form_container col-5">
                            <h3>Send me a message</h3>
                            <p><span class="error">* required field</span></p>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="on">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="fname" name="firstname" placeholder="Your name.." value="<?php echo $firstname;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<script><?php echo $firstnameErr; ?></script></span>
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
                                        <label for="f_email">Email:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" id="f_email" name="email" placeholder="email@hot.com" value="<?php echo $email;?>" autocomplete="on" required>
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
                            <form action="./booking_action_page.php" method="post">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_fname">First Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="b_fname" name="firstname" placeholder="Your name.." autocomplete="on" required>                                        
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_lname">Last Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="b_lname" name="lastname" placeholder="Your last name.." autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_email">Email:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" id="b_email" name="email" placeholder="email@hot.com" autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_phone">Phone number:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="tel" id="b_phone" name="phone" placeholder="123-45-67-890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}" autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="company">Company</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="company" name="company" placeholder="Company name" autocomplete="on">
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-3">
                                        <label for="date">Date:</label> 
                                    </div>
                                    <div class="col-9">
                                        <input type="date" id="date" name="date" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="time">Time:</label> 
                                    </div>
                                    <div class="col-9">
                                        <input type="time" id="time" name="time" required>
                                    </div>
                                    <span class="error">*</span>
                                </div> -->
                                <div class="row">
                                    <div class="col-3">
                                        <label for="date">Date & Time:</label> 
                                    </div>
                                    <div class="col-9">
                                        <input type="datetime-local" id="date" name="date" required>
                                    </div>
                                    <span class="error">*</span>
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
                            <li><a href="https://www.facebook.com/matteo.poire.9" rel="external" target="_blank" title="facebook page"><img src="../img/facebook_icon.png" alt="facebook profile" id="facebook_foot"></a></li>
                            <li><a href="https://www.instagram.com/teo.poire/" rel="external" target="_blank" title="instagram page"><img src="../img/instagram_icon.png" alt="instagram profile" id="instagram_foot"></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </footer>
    </body>
</html>