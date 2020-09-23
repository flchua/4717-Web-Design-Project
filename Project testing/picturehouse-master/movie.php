<!DOCTYPE html>
<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:400,700" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" type="text/css" href="movie.css">
  <title>PICTURE HOUSE</title>
</head>

<body>
  <?php include 'nav.php'; ?>
  
  <div class='content'>
    <?php include 'movie_details.php'; ?>
    <?php include 'movie_showtimes.php'; ?>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>