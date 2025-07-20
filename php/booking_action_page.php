<?php

// Variables set to empty values
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = $dateErr = $timeErr = "";
$firstname = $lastname = $email = $phone = $company = $date = $time = $error = $response = "";

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

    if (empty($_POST["company"])) {
        $company = "";
      } else {
        $company = test_input($_POST["company"]);
    }

    if (empty($_POST["date"])) {
      $dateErr = "Date and Time required";
      $error = 1;
    } else {
      $date = test_input($_POST["date"]);
      // $date = date('Y-m-d', strtotime($date));
      if (false === strtotime($date)){
        $dateErr = "Invalid date";
        $error = 1;
      }else {
        list($year, $month, $day) = explode('-', $date);
        $day = explode('T', $day)[0];
        $currentDate = date('Y-m-d');
        $inputDate = $year . "-" . $month . "-" . $day;
        if($inputDate < $currentDate){
            $dateErr = "Invalid date";
            $error = 1;
        }
      }
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = trim($data, "'");
  return $data;
}

if(!$error){
    // Server connection
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    $response = "<p>Connection failed: " . $conn->connect_error."</p><button type='button' value='OK' onclick='read()'>OK</button>";
    die($response);
    } 

    $sql = "INSERT INTO Booking (FirstName, LastName, Email, Phone, Company, Date)
    VALUES ('$firstname', '$lastname', '$email', '$phone', '$company', '$date')";

    if ($conn->query($sql) === TRUE) {
    $response = "<p>Your appointment was successfully registreted.</p><button type='button' value='OK' onclick='read()'>OK</button>";
    } else {
    $response = "<p>Error: " . $sql . "<br>" . $conn->error ."</p><button type='button' value='OK' onclick='read()'>OK</button>";
    }

    $conn->close();
}else {
    $response = "<p>Wrong input.</p><button type='button' value='OK' onclick='read()'>OK</button>";
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
        <meta http-equiv="Cache-control" content="public">
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
                            <form action="form_action_page.php" method="post" autocomplete="on">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="fname" name="firstname" placeholder="Your name.." autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="lname">Last Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="lname" name="lastname" placeholder="Your last name.." autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="f_email">Email:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" id="f_email" name="email" placeholder="email@hot.com" autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="phone">Phone number:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="tel" id="phone" name="phone" placeholder="123-45-67-890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}" autocomplete="on" required>
                                    </div>
                                    <span class="error">*</span>
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
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_fname">First Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="b_fname" name="firstname" placeholder="Your name.." value="<?php echo $firstname;?>" autocomplete="on" required>                                        
                                    </div>
                                    <span class="error">*<?php echo $firstnameErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_lname">Last Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="b_lname" name="lastname" placeholder="Your last name.." value="<?php echo $lastname;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $lastnameErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_email">Email:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" id="b_email" name="email" placeholder="email@hot.com" value="<?php echo $email;?>" autocomplete="on" required>
                                    </div>
                                    <span class="error">*<?php echo $emailErr;?></span>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="b_phone">Phone number:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="tel" id="b_phone" name="phone" placeholder="123-45-67-890" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}" value="<?php echo $phone;?>" autocomplete="on" required>
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
                                    <span class="error">*<?php echo $dateErr;?></span>
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