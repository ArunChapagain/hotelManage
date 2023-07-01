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
    <title>Features and facilities</title>
    <?php require('inc/links.php'); ?>
</head>

<body>
    <?php require('inc/header.php'); ?>

    <!-- features section -->
    <div class="container-fluid" id="main-content">
        <h3 class="mt-4 mb-3">Features and Facilities</h3>
        <!--  section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">Feature</h5>
                        <button type="button" class="btn btn-dark shadow-none pop" data-bs-toggle="modal"
                            data-bs-target="#feature-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <!-- feature modal -->
                    <div class="modal" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="feature_s_form">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: black">
                                            Add Feature
                                        </h5>
                                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black; text-align: left">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="feature_name" id="feature_name_inp"
                                                class="form-control shadow-none" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-sm btn-outline-dark shadow-none"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button type="submit" name="add_feature" class="btn btn-dark shadow-none pop">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Table  -->
                    <div class="table-responsive-md mt-4" style="height: 350px; overflow-y: scroll">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">S.no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="features-data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- facilities section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">Facilities</h5>
                        <button type="button" class="btn btn-dark shadow-none pop" data-bs-toggle="modal"
                            data-bs-target="#facility-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <!-- facilities modal -->
                    <div class="modal" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="facility_s_form">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color: black">
                                            Add Facility
                                        </h5>
                                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color: black; text-align: left">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="facility_name" class="form-control shadow-none"
                                                required />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Icon</label>
                                            <input type="file" name="facility_icon" accept=".svg"
                                                class="form-control shadow-none" required />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="facility_desc" class="form-control shadow-none"
                                                rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-sm btn-outline-dark shadow-none"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button type="submit" name="add_facility" class="btn btn-dark shadow-none pop">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Table  -->
                    <div class="table-responsive-md mt-4" style="height: 350px; overflow-y: scroll">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">S.no</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="40%">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="facilities-data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/features_facilities.js"></script>
    

</body>

</html>