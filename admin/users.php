<?php
require('inc/db_config.php');
require('inc/essential.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team</title>
    <?php require('inc/links.php'); ?>

</head>

<body>
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <h3 class="mt-4 mb-3">Registered Users</h3>

        <div class="table-responsive-md mt-4" style="height: 350px; overflow-y: scroll">
            <table class="table table-hover border">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">S.no</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">DoB</th>
                        <th scope="col">Status</th>
                        <th scope="col">Registered Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="users-data"></tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="modal fade" id="user-images" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Profile and Document Image</h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div id="user-image-data">
          </div>
        </div>
      </div>
    </div>
  </div>

   


    <script src="./scripts/user.js"></script>
</body>

</html>