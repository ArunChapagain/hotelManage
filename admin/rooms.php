<?php
require('inc/db_config.php');
require('inc/essential.php');
adminLogin();
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rooms</title>
  <?php require('inc/links.php'); ?>
</head>

<body>
  <?php require('inc/header.php'); ?>


  <!-- Add Room modal -->
  <div class="modal" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="add_room_form">
          <div class="modal-header">
            <h5 class="modal-title" style="color: black">
              Add Room
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="color: black; text-align: left">
            <div class="row">

              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required />
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Area</label>
                <input type="number" min="1" name="area" class="form-control shadow-none" required />
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Price</label>
                <input type="number" min="1" name="price" class="form-control shadow-none" required />
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" min="1" name="quantity" class="form-control shadow-none"
                  placeholder="max no of similar rooms" required />
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Adult </label>
                <input type="number" min="1" name="adult" class="form-control shadow-none" required />
              </div>

              <div class="col-md-6 mb-3">

                <label class="form-label">Children</label>
                <input type="number" min="1" name="children" class="form-control shadow-none" required />
              </div>


              <div class="mb-3">
                <label class="form-label">Feature</label>
                <div class="row">
                  <?php
                  $res = selectAll('features');
                  while ($opt = mysqli_fetch_assoc($res)) {
                    echo "
                            <div class='col-md-3 mb-1'>
                            <label >
                              <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                            </label>
                          </div>
                            ";
                  }
                  ?>

                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Facilities</label>
                <div class="row">
                  <?php
                  $res = selectAll('facilities');
                  while ($opt = mysqli_fetch_assoc($res)) {
                    echo "
                            <div class='col-md-3 mb-1'>
                            <label >
                              <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                            </label>
                          </div>
                            ";
                  }
                  ?>
                </div>
              </div>
              <div class=" col-12 mb-3">

                <label class="form-label">Description</label>
                <textarea name="desc" class="form-control shadow-none" rows="4" require></textarea>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-sm btn-outline-dark shadow-none" data-bs-dismiss="modal">
              Cancel
            </button>

            <button type="submit" name="add_room" class="btn btn-dark shadow-none pop">
              Add
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container-fluid" id="main-content">
    <h3 class="mt-4 mb-3">Rooms</h3>
    <!--  section -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card text-center">
        <div class="card-body">
          <div class="text-end mb-4">
            <button type="button" class="btn btn-dark shadow-none pop" data-bs-toggle="modal"
              data-bs-target="#add-room">
              <i class="bi bi-plus-square"></i> Add
            </button>
          </div>

          <!-- Edit Room modal -->
          <div class="modal" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <form id="edit_room_form">
                  <div class="modal-header">
                    <h5 class="modal-title" style="color: black">
                      Edit Room
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="color: black; text-align: left">
                    <div class="row">



                      <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control shadow-none" required />
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Area</label>
                        <input type="number" min="1" name="area" class="form-control shadow-none" required />
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" min="1" name="price" class="form-control shadow-none" required />
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" min="1" name="quantity" class="form-control shadow-none"
                          placeholder="max no of similar rooms" required />
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Adult </label>
                        <input type="number" min="1" name="adult" class="form-control shadow-none" required />
                      </div>

                      <div class="col-md-6 mb-3">

                        <label class="form-label">Children</label>
                        <input type="number" min="1" name="children" class="form-control shadow-none" required />
                      </div>


                      <div class="mb-3">
                        <label class="form-label">Feature</label>
                        <div class="row">
                          <?php
                          $res = selectAll('features');
                          while ($opt = mysqli_fetch_assoc($res)) {
                            echo "
                            <div class='col-md-3 mb-1'>
                            <label >
                              <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                            </label>
                          </div>
                            ";
                          }
                          ?>

                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Facilities</label>
                        <div class="row">
                          <?php
                          $res = selectAll('facilities');
                          while ($opt = mysqli_fetch_assoc($res)) {
                            echo "
                            <div class='col-md-3 mb-1'>
                            <label >
                              <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                            </label>
                          </div>
                            ";
                          }
                          ?>
                        </div>
                      </div>
                      <div class=" col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="desc" class="form-control shadow-none" rows="4" require></textarea>
                      </div>
                    </div>
                    <input type="hidden" name="room_id">
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-sm btn-outline-dark shadow-none" data-bs-dismiss="modal">
                      Cancel
                    </button>

                    <button type="submit" name="add_room" class="btn btn-dark shadow-none pop">
                      Edit
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Table  -->
          <div class="table-responsive-md mt-4" style="height: 750px; overflow-y: scroll">
            <table class="table table-hover border text-center">
              <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">S.no</th>
                  <th scope="col">Name</th>
                  <th scope="col">Area</th>
                  <th scope="col">Guests</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="room-data"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Manage room images modal -->
  <div class="modal fade" id="room-images" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rooms Name</h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="border-bottom border-3 pb-3 mb-3">
            <form id="add_image_form">
              <label class="form-label">Add Image</label>
              <input type="file" name="image" class="form-control shadow-none mb-3" required>
              <button type="submit" class="btn btn-dark shadow-none pop">
                <i class="bi bi-plus-square"></i> Add
              </button>
              <input type="hidden" name="room_id">
            </form>
          </div>

          <div class="table-responsive-md mt-4" style="height: 350px; overflow-y: scroll">
            <table class="table table-hover border text-center">
              <thead>
                <tr class="bg-dark text-light sticky-top">
                  <th scope="col" width=60%>Image</th>
                  <th scope="col">Thumb</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody id="room-image-data"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="./scripts/room.js"></script>

</body>

</html>