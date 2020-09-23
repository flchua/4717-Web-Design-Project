<!DOCTYPE html>
<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:400,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" type="text/css" href="cinemas.css">
  <title>Cinemas</title>
</head>

<body>
  <?php include 'nav.php'; ?>
  
  <div class='content'>
    <div class='width-wrap'>
      <h1>CINEMAS</h1>
      <div class='movieContainer'>
        <?php
          include "db_connect.php";

          $sql = 'SELECT * FROM cinemas';       
          $result = mysqli_query($conn, $sql);  

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $name = $row['name'];
              $location = $row['location'];

              echo "<div class='cinema-card'>";
              echo "  <div class='cinema-details'>";
              echo "    <h2>$name</h2>";
              echo      str_replace(',', ',<br/>', $location);
              echo "   </div>";
              echo "  <img class='map' src='maps/{$name}.png' />";
              echo "</div>";

            }
          }

        ?>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>