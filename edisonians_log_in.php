<?php
    session_start();

    include "PHP/CLASSES/Data_functions.php";
    $execute = new Data_functions();

    if(isset($_SESSION['username_entered'])) {
        header("Location: edisonians.php");
    }else {
        if(isset($_POST['username_entered']) && isset($_POST['password_entered'])) {
            $valid = $execute->check_user($_POST['username_entered'], $_POST['password_entered']);
        }
    }
?>
<!Doctype html>
<html>
    <head>
        <title>EDISONIANS LOG IN</title>
        <script src="JS/jquery-1.8.2.min.js"></script>
        <script src = "JS/jquery-ui-1.9.0.custom.min.js"></script>
        <script src="JS/edisonians_script.js"></script>
        <script src="JS/page_functionality.js"></script>
        <link rel = "stylesheet" href = "CSS/jquery-ui-1.9.0.custom.min.css" />
        <link rel = "stylesheet" href="CSS/edisonians.css" />
        <link rel = "shortcut icon" href = "CSS/images/t.jpeg" />
    </head>
    <body id = "log_in_body">
        <!--<h1><marquee behavior="alternate"><span>EDISONIANS' </span>WORLD</marquee></h1>-->
        <h1 id="ourWorld"><span>EDISONIANS' </span>WORLD</h1>
        <form action = "edisonians_log_in.php" method = "POST">
            user name:<input type="text" id="username_entered" name = "username_entered" class="input1"/>
            password:<input type="password" id = "password_entered" name = "password_entered" class = "input1"/>
            <button id = "log_in">log in</button>
        </form>
        <?php
            if(isset($error_message)) {
                echo $error_message;
            }
        ?>
        <form id = "registration_form">
            <h2>CREATE YOUR ACCOUNT NOW!</h2>
            <fieldset>
                <legend>Personal Information</legend>
                <img src = "images/wew.jpg" id = "back_right">
                <p class="note"> note: for Edisonians Batch 2011-2012 only.</p>
                <table>
                    <tr>
                        <td>first name:</td>
                        <td><input type="text" id="firstname" name="firstname"/></td>
                    </tr>
                    <tr>
                        <td>middle name:</td>
                        <td><input type="text" id="middlename" name="middlename"/></td>
                    </tr>
                    <tr>
                        <td>last name:</td>
                        <td><input type="text" id="lastname" name="lastname"/></td>
                    </tr>
                    <tr>
                        <td>gender:</td><td>
                            <input type="radio" name = "gender" id = "female"/>Female<input type = "radio" name = "gender" id="male" />Male</td>
                    </tr>
                    <tr>
                        <td>age:</td>
                        <td><input type="number" age="age"  name = "age" id = "age" /></td>
                    </tr>
                    <tr>
                        <td>birthday:</td>
                        <td>
                            <?php
                            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                            $month_counter = 0;
                            echo "<select name = 'month' id = 'month'>";
                            while($month_counter < sizeof($months)) {
                                echo "<option>".$months[$month_counter]."</option>";
                                $month_counter++;
                            }
                            echo "</select>";

                            echo "<select name = 'day' id = 'day'>";
                            $day_counter = 1;
                            while($day_counter <= 31) {
                                echo "<option>".$day_counter."</option>";
                                $day_counter++;
                            }
                            echo "</select>";

                            echo "<select id = 'year' name = 'year'>";
                            $year_counter = 2013;
                            while($year_counter >= 1900) {
                                echo "<option>".$year_counter."</option>";
                                $year_counter--;
                            }
                            echo "</select>";


                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td> address:</td>
                        <td><input type="text" id="address" name = "address" /></td>
                    </tr>
                    <tr>
                        <td>Edisonians Code:</td><td><input type = "password" name = "code_entered" id = "code_entered" /></td>
                    </tr>
                    <tr>
                        <td>Your Username:</td><td><input type = "text" name = "new_username" id = "new_username" /></td>
                    </tr>
                    <tr>
                        <td>Your Password:</td><td><input type = "password" name = "new_password" id = "new_password" /></td>
                    </tr>
                    <tr>
                        <td>Password Confirmation:</td><td><input type = "password" name = "retyped_password" id = "retyped_password" /></td>
                    </tr>
                </table>
                <p id = "register_invalid_warning" class = 'warning'>There's something wrong! Bleehhh :P</p>
                <p id = "invalid_code" class = 'warning'>INVALID EDISONIANS CODE.</p>
                <br /><br />
                <input type = "button" id="continue" value = "REGISTER"> <input id="reset" type="reset" value="reset" />
            </fieldset>
        </form>
        <div id = "register_confirmation" class = 'confirmation_dialog' title = "REGISTRATION CONFIRMED!">
            Congratulations! You're already registered! You may now log in as <span id = "username_span"></span>.
        </div><!!!! registered confirmation !!!!>
        <div id = "container_div">
            <footer>	<tt>Edisonians<br /> in Balocawehay National High School<br /> Balocawehay Abuyog,Leyte Visayas Phillippines<br /> batch 2011-2012</tt></footer>
        </div><!!!!! container div !!!!!!!>

    </body>
</html>
