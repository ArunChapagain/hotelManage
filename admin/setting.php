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
        <h3 class="mt-4 mb-3">Team</h3>

        <!-- management  section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">

                        <h5 class="card-title m-0">Management Team</h5>
                        <button type="button" class="btn btn-dark shadow-none pop" data-bs-toggle="modal"
                            data-bs-target="#team-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="row" id="team-data">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Management Team Modal -->
    <div class="modal" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="team_s_form">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:black;">Add Team Member</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color:black;">
                        <div class="mb-3">
                            <!-- may conatin error accept=".jpg, .png, .webp, .jpeg"  -->
                            <label class="form-label">Name</label>
                            <input type="text" name="member_name" id="member_name_inp"
                                class="form-control shadow-none">
                            <!--  -->
                        </div>
                        <div class="mb-3">
                            <!-- may conatin error accept=".jpg, .png, .webp, .jpeg"  -->
                            <label class="form-label">Picture</label>
                            <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg"
                                class="form-control shadow-none">
                            <!--  -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick=""
                            class="btn btn-sm btn-outline-dark shadow-none" data-bs-dismiss="modal">Cancel</button>
                            <!-- couls be error -->
                        <button name="add_image" type="submit" class="btn btn-dark shadow-none pop">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
 <script>
        
let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

team_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_member();
});




function get_general() {
    let site_title;
    let site_about;

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function () {
        general_data= this.responseText;
        console.log(general_data);
    }
    
    xhr.send('get_general');
}

function add_member() {
    let data = new FormData();
    data.append('name', member_name_inp.value);
    data.append('picture', member_picture_inp.files[0]);
    data.append('add_member', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/member_crud.php", true);

    xhr.onload = function () {
        console.log(this.responseText);
        // var myModal = document.getElementById('team-s');
        // var modal = bootstrap.Modal.getInstance(myModal);
        // modal.hide();

        // if (this.responseText == 'inv_img') {
        //     alert('error', 'Only JPG and PNG images are allowed');
        // }
        // else if (this.responseText == 'inv_size') {
        //     alert('error', 'Img should be less than 2MB');
        // }
        // else if (this.responseText == 'upd_failed') {
        //     alert('error', 'Image upload failed.Server Down');
        // }
        // else {
        //     alert('Success', 'New Image added');
        //     member_picture_inp.value = '';
        //     get_member();
        // }
    }
    xhr.send(data);
}

window.onload = function () {
    get_general();
}

    </script>



</body>

</html>