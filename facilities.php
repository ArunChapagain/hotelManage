<html lang="en">
<!-- //mg-lg-1  margin for the large device -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookIn-icons</title>
  <?php require('inc/links.php'); ?>

  <link rel="stylesheet" href="style.css">
</head>

</html>
<style>
  .pop {
    border-top-color: gainsboro !important;
  }

  .pop:hover {
    border-top-color: black !important;
    transform: scale(1.03);
    transition: all;
  }
</style>

<body class="bg-light">

  <!-- navbar -->
  <?php require('inc/header.php'); ?>

  <div class="my-5" px-4>
    <h2 class="fw-bold h-font text-center">Our Facilities</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptates sunt
      provident laborum at, harum omnis, soluta ullam voluptate laudantium totam dolores nisi,
      doloribus assumenda dolore ab asperiores ad eum?</p>
  </div>
  <div class="container">
    <div class="row">
      <?php
      $res = selectAll('facilities');
      $path = ICONS_IMG_PATH;

      while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
        <div class="col-lg-4 col-md-6 mb-5 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 pop">
            <div class="d-flex align-items-center mb-2"> <img src="$path$row[icon]" width="40px">
              <h5 class="m-0 ms-3">$row[name]</h5>
            </div>
            <p>$row[description]</p>
          </div>
        </div>

        data;
      }

      ?>
      <div class="container text-center py-4">
        </div>


    </div>
  </div>

  <!-- footer -->
  <?php require('inc/footer.php'); ?>
</body>

</html>