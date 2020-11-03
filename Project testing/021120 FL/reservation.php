<!DOCTYPE html>
<html lang="en">
<?php include './php/head.php'; ?>
<body class="debug o f d">
    <?php
        //Navigation and main category
        session_start();

        //Connect to database
        $conn = new mysqli("localhost", "f35ee", "f35ee", "f35ee");

        include './php/nav.php';

        if ($conn->connect_error) {
            //Fallback if unable to connect to database
            include_once ('./php/error.php');
            exit();
        }

        $conn->close();

        echo '
        <body>
<script>
        function checkInput() { //Form validation
            //Check name
            var name = document.getElementById("rsvName");
            var nameRegExp = /^[A-Za-z]+\s?[A-Za-z]*$/;
            var nameValid = nameRegExp.test(name.value);
            if (nameValid != true) {
                alert("The name is not valid.\n" + "It should contain only alphabet characters and space.");
                name.focus();
                name.select();
                return false;
            }
            //Check phone
            var phone = document.getElementById("rsvPhone");
            var phoneRegExp = /^\d+$/;
            var phoneValid = phoneRegExp.test(phone.value);
            if (phoneValid != true) {
                alert("The phone number is not valid.\n" + "It should contain only digits.");
                phone.focus();
                phone.select();
                return false;
            }
            //Check date
            var date = document.getElementById("rsvDate");
            var dateCurrent = new Date();
            var dateSelect = new Date(date.value);
            if (dateSelect <= dateCurrent) {
                alert("The date is not valid.\n" + "The start date cannot be from today and the past.");
                date.focus();
                date.select();
                return false;
            }
            //Check pax
            var pax = document.getElementById("rsvPax");
            if ((pax.value <= 0) || (pax.value > 8) || (pax.value % 1 != 0)) {
                alert("The age is not valid.\n" + "It must be a positive integer between 1-8.");
                pax.focus();
                pax.select();
                return false;
            }
        }
    </script>
    <link rel="stylesheet" href="css/reservation.css">
    <div id="reserve">
        <br><br><br>
        <div id="notice">
            <h2>Reservation Notice</h2>
            <p>Please read the following terms and conditions berfore making a reservation.</p>
            <ul>
                <li>Information with asterisk is mandatory in the form.</li>
                <li>If you have any special requests, please include in the comment.</li>
                <li>Reservation must be made at least 1 day before the actual dining day.</li>
                <li>The maximum pax allowed is 8. For dining of more pax, please directly approach to us by contact
                    form, email or telephone.</li>
                <li>Number of reservations is limited for each day.</li>
                <li>You will be informed upon successful reservation.</li>
                <li>In case of cancelation, please inform us at least 1 day in advance.</li>
            </ul>
            <p>By clicking submission button in reservation form, you acknowledge that you have read, understood and
                accepted the terms and conditions above.</p>
        </div>
        <div id="form">
            <h2>Reservation Form</h2>
            <form method="post" action="reserve.php" onsubmit="return checkInput();" id="info">
                <div id="left">
                    <label for="rsvSalulation">* Salulation:</label>
                    <select name="rsvSalulation" id="rsvSalulation">
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                    </select><br>
                    <label for="rsvName">* Name:</label>
                    <input type="text" name="rsvName" id="rsvName" required><br>
                    <label for="rsvPhone">* Phone:</label>
                    <input type="text" name="rsvPhone" id="rsvPhone" required><br>
                    <label for="rsvEmail">* E-mail:</label>
                    <input type="email" name="rsvEmail" id="rsvEmail" required><br>
                    <label for="rsvDate">* Date:</label>
                    <input type="date" name="rsvDate" id="rsvDate" required><br>
                </div>
                <div id="right">
                    <label for="rsvTime">* Time:</label>
                    <select name="rsvTime" id="rsvTime">
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                    </select><br>
                    <label for="rsvPax">* Pax:</label>
                    <input type="number" name="rsvPax" id="rsvPax" value="1" min="1" max="8" step="1" required><br>
                    <label for="rsvComment">Comment:</label>
                    <textarea name="rsvComment" id="rsvComment" rows="4" cols="18"></textarea><br>
                    <input type="submit" name="rsvSubmit" id="rsvSubmit" value="Submit" style="margin-left: 165px;">
                </div>
            </form>
        </div>
    </div>

</body>

        ';
        include './php/footer.php';
        echo '<script type="text/javascript" src="./js/global.js"></script>';

    ?>