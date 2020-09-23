<?php
    // Get name
    $sql = 'SELECT name FROM users WHERE email = \''.$email.'\'';
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        // echo $name;
    } else {
        $name = 'customer';
    }

    $to      = 'f31im@localhost, '.$email;
    $subject = 'Booking confirmed!';
    $message =

    "Hi ".$name." (".$email."),

    Your booking has been confirmed.

    Movie: \t".$title."
    Date: \t".$showdate."
    Time: \t".$showtime."
    Cinema: ".$cinema_name."
    Seats: \t".$seats."

    Total paid: \$".$total_price."

    - PICTURE HOUSE";

    $headers = 'From: f31im@localhost' . "\r\n" .
        'Reply-To: f31im@localhost' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers,'-ff31im@localhost');
?> 