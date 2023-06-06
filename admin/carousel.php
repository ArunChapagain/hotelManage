<?php
require('inc/db_config.php');
require('inc/essential.php');
adminLogin();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel</title>
    <?php require('inc/links.php'); ?>

</head>

<body>
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <h3 class="mt-4 mb-3">Carousel</h3>

        <!-- Carousel section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">

                        <h5 class="card-title m-0">Images</h5>
                        <button type="button" class="btn btn-dark shadow-none pop" data-bs-toggle="modal"
                            data-bs-target="#carousel-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="row my-3" id="carousel-data">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel model  -->
    <!-- Modal -->
    <div class="modal" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="carousel_s_form">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:black;">Add Images</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color:black;">
                        <div class="mb-3">
                            <label class="form-label">Picture</label>
                            <input type="file" name="carousel_picture" id="carousel_picture_inp"
                                class="form-control shadow-none" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="carousel_picture.value=''"
                            class="btn btn-sm btn-outline-dark shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_image" class="btn btn-dark shadow-none pop">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./scripts/carousel.js"></script>




</body>

</html>