<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <title>Appointment</title>

        <meta charset="utf-8">
        <meta name="keywords" content="Software Engineer, Education, CV, Portfolio">
        <meta name="description" content="Software Engineer Matteo Poire' presentation, education">
        <!--http-equiv simulates a HTTP Response Header-->
        <meta http-equiv="expires" content="18000">     <!--Page newly requested to the server every 5 hours-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="reised" content="27/05/2023">       <!--Last date when changes were done to the pages-->
        <meta name="rating" content="general">          <!--Identifying the kind of page's audience-->

        <link type="text/css" rel="stylesheet" href="../style/styleAppointment.css">
    </head>
    <body>
        <header>
            <div class="header" id="header">
                <div class="name_square">
                    <div class="square"></div>
                    <div class="name">
                        <h1>Matteo Poir&eacute</h1>
                        <span class="slash">/</span><span>SOFTWARE ENGINEER</span>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="row">
                <div class="section">
                    <div class="container">
                        <table id="customers">
                            <tr>
                                <th>ID</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Date</th>
                            </tr>
                            <?php
                                // Server connection
                                $servername = "localhost";
                                $username = "root";
                                $password = "root";
                                $dbname = "mydb";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                                }

                                $query = "SELECT * FROM Booking";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                            
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td></tr>";
                                    }
                                    echo "</table>";
                                }else {
                                    echo "No result";
                                }

                                $conn->close();
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer">
                <p class="foot">&copy; 2023 by Matteo Poir&eacute;.</p>
            </div>
        </footer>
    </body>
</html>