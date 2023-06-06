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
    <title>Features and facilities</title>
    <?php require('inc/links.php'); ?>

</head>

<body>
    <?php require('inc/header.php'); ?>


    <div class="container-fluid" id="main-content">
        <h3 class="mt-4 mb-3">Team</h3>

        <!-- management  section -->
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

                    <div class="modal" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="feature_s_form">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:black;">Add Feature</h5>
                                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black; text-align: left;">
                                        <div class="mb-3">
                                            <!-- may conatin error accept=".jpg, .png, .webp, .jpeg"  -->
                                            <label class="form-label">Name</label>
                                            <input type="text" name="feature_name" id="feature_name_inp"
                                                class="form-control shadow-none" required>
                                            <!--  -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-sm btn-outline-dark shadow-none"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <!-- couls be error -->
                                        <button type="submit" class="btn btn-dark shadow-none pop">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row" id="team-data">
                    </div> -->





                    <div class="table-responsive-md mt-4" style="height:450px; overflow-y:scroll;">

                        <table class="table table-hover border">
                            <thead class="sticky-top">
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php

                                $q = "SELECT * FROM `features` ORDER BY `sr_no` DESC";
                                $data = mysqli_query($con, $q);
                                $i = 1;

                                while ($row = mysqli_fetch_assoc($data)) {
                                    echo <<<query
                                        <tr>
                                            <td>$i</td>
                                            <td>$row[name]</td>
                                            <td>$row[email]</td>
                                            <td>$row[message]</td>
                                        </tr>

                                    query;
                                    $i++;
                                }

                                ?> -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!--Management Team Modal -->





    <script>
        let feature_s_form = document.getElementById('feature_s_form');
        let feature_name_inp = document.getElementById('feature_name_inp');


        feature_s_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_feature();
        });
        function add_feature() {

            let data = new FormData();
            data.append('name', feature_name_inp.value);

            // data.append('name', feature_s_form.elements['feature_name'].value);
            data.append('add_feature', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');



            xhr.onload = function () {
                var myModal = document.getElementById('feature-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText==1) {
                    alert('Success', 'New feature added');
                    feature_s_form.elements['feature_name'].value = '';
                }

                else {
                    alert('error', 'Image upload failed.Server Down');
                }
            }
            xhr.send(data);
        }

        function get_feature() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('feature-data').innerHTML = this.responseText;
            }
            xhr.send('get_carousel');
        }



    </script>
</body>

</html>