<!DOCTYPE html>
<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:400,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" type="text/css" href="booking.css">
  <title>Booking</title>
</head>

<body>
  <?php include 'nav.php'; ?>
  <div class="content">
    <div class='background-img'></div>
    <?php include "booking_select.php"; ?>
    <form action="confirm.php" method="post">
      <div class="seats-container center width-wrap">
        <?php include 'booking_seats.php'; ?>
        <div id='legend'>
          <div class='seat booked'></div> Reserved
          <div class='seat'></div> Available 
          <div class='seat selected'></div> Selected
        </div>
      </div>
      <div class='payment'>
        <h1 class="center">Payment</h1>
        <div class="table-container">
          <?php
            echo "<input type='hidden' name='showtime_id' value='".$_GET['id']."'>";
          ?>
          <input type="hidden" name="qty" value="0">
          <input type="hidden" name="total_price" value="0">
          <table>
            <tr>
              <th>Ticket type</th>
              <th>Price</th>
              <th>Seats</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
            <tr>
              <td id="type">Weekday</td>
              <td id="price">$10</td>
              <td id="seats">-</td>
              <td id="qty">0</td>
              <td id="subtotal">$0</td>
            </tr>
            <tr>
              <td colspan="4" class="alignRight">Booking Fee:</td>
              <td>$1.50</td>
            </tr>
            <tr>
              <td colspan="4" class="alignRight">Total:</td>
              <td id="total">$0.00</td>
            </tr>
          </table>
          <div class="signup">
            <br />
            <?php
              if (!isset($_SESSION['user_email'])) {
                echo '  <label>Email</label>';
                echo '  <input type="text" name="email" required> <br/>';
                // echo '  <label>Name</label>';
                // echo '  <input type="text" name="name" required> <br/>';
                // echo '  <label>Password</label>';
                // echo '  <input type="password" name="password" required> <br/>';
                // echo '  <label>Enter password again</label>';
                // echo '  <input type="password" name="password2" required> <br/>';
              }
            ?>
            <input id='booker' type="submit" value="Book now">
          </div>
        </div>
      </div>
    </form>
  </div>

  <?php include 'footer.php'; ?>

  <script>
    $(document).ready(function () {
      let type = isWeekend ? 'Weekend' : 'Weekday'; // isWeekend = true/false
      let price = isWeekend ? 13 : 9.5;
      
      $("#type").text(type);
      $("#price").text("$" + price.toFixed(2));

      let countChecked = function() {
        let seats = $("input:checked").map(function() {
          return this.value;
        }).get().join(", ");
        let qty = $("input:checked").length;
        console.log(qty + " seat(s) selected: " + seats);

        let subtotal = price*qty;
        let total = subtotal + 1.5;

        $("#seats").text(seats || "-");
        $("#qty").text(qty);
        $("#subtotal").text("$" + subtotal.toFixed(2));
        $("#total").text("$" + total.toFixed(2));

        $('input[name="qty"]').val(qty);
        $('input[name="total_price"]').val(total.toFixed(2));
        $('#booker').prop('disabled', (qty < 1));
      };
      countChecked();
      $("input[type=checkbox]").on("click", countChecked);
    });
  </script>
</body>

</html>