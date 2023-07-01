
let add_room_form = document.getElementById('add_room_form');

add_room_form.addEventListener('submit', function (e) {
  e.preventDefault();
  add_room();
});

function add_room() {

  let data = new FormData();

  data.append('add_room', '');
  data.append('name', add_room_form.elements['name'].value);
  data.append('type', add_room_form.elements['rtype'].value);
  data.append('location', add_room_form.elements['loc'].value);
  data.append('gmap', add_room_form.elements['gmap'].value);
  data.append('price', add_room_form.elements['price'].value);
  data.append('adult', add_room_form.elements['adult'].value);
  data.append('children', add_room_form.elements['children'].value);
  data.append('desc', add_room_form.elements['desc'].value);

  let features = [];
  add_room_form.elements['features'].forEach(el => {
    if (el.checked) {
      features.push(el.value);
    }
  });

  let facilities = [];
  add_room_form.elements['facilities'].forEach(el => {
    if (el.checked) {
      facilities.push(el.value);
    }
  });

  data.append('features', JSON.stringify(features));//converts into arry string
  data.append('facilities', JSON.stringify(facilities));//converts into arry string



  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById('add-room');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText = 1) {
      alert('Success', 'New room added!');
      add_room_form.reset();
      get_all_rooms();

    }

    else {
      alert('error', 'Image upload failed.Server Down');
    }
  }
  xhr.send(data);
}


function get_all_rooms() {


  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


  xhr.onload = function () {

    document.getElementById('room-data').innerHTML = this.responseText;


  }
  xhr.send('get_all_rooms');
}
//edit room section

let edit_room_form = document.getElementById('edit_room_form');


edit_room_form.addEventListener('submit', function (e) {
  e.preventDefault();
  edit_room();
});

function edit_details(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


  xhr.onload = function () {
    let data = JSON.parse(this.responseText);
    edit_room_form.elements['name'].value = data.roomdata.name;
    edit_room_form.elements['rtype'].value = data.roomdata.type;
    edit_room_form.elements['loc'].value = data.roomdata.location;
    edit_room_form.elements['gmap'].value = data.roomdata.gmap;
    edit_room_form.elements['price'].value = data.roomdata.price;
    edit_room_form.elements['adult'].value = data.roomdata.adult;
    edit_room_form.elements['children'].value = data.roomdata.children;
    edit_room_form.elements['desc'].value = data.roomdata.description;
    edit_room_form.elements['room_id'].value = data.roomdata.id;

    edit_room_form.elements['features'].forEach(el => {

      if (data.features.includes(Number(el.value))) {
        el.checked = true;
      }
    });

    edit_room_form.elements['facilities'].forEach(el => {
      if (data.facilities.includes(Number(el.value))) {
        el.checked = true;
      }
    });

  }
  xhr.send('get_room=' + id);
}


function edit_room() {
  let data = new FormData();

  data.append('edit_room', '');
  data.append('room_id', edit_room_form.elements['room_id'].value);
  data.append('name', edit_room_form.elements['name'].value);
  data.append('type', edit_room_form.elements['rtype'].value);
  data.append('location', edit_room_form.elements['loc'].value);
  data.append('gmap', edit_room_form.elements['gmap'].value);
  data.append('price', edit_room_form.elements['price'].value);
  data.append('adult', edit_room_form.elements['adult'].value);
  data.append('children', edit_room_form.elements['children'].value);
  data.append('desc', edit_room_form.elements['desc'].value);

  let features = [];
  edit_room_form.elements['features'].forEach(el => {
    if (el.checked) {
      features.push(el.value);
    }
  });

  let facilities = [];
  edit_room_form.elements['facilities'].forEach(el => {
    if (el.checked) {
      facilities.push(el.value);
    }
  });

  data.append('features', JSON.stringify(features));//converts into arry string
  data.append('facilities', JSON.stringify(facilities));//converts into arry string



  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);

  xhr.onload = function () {
    console.log(this.responseText);
    var myModal = document.getElementById('edit-room');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText = 1) {
      alert('Success', 'Room edited!');
      edit_room_form.reset();
      get_all_rooms();

    }

    else {
      alert('error', 'Image upload failed.Server Down');
    }
  }
  xhr.send(data);
}


function toggleStatus(id, val) {

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {

    if (this.responseText) {
      alert('success', 'status toggled');
      get_all_rooms();

    }
    else if (this.response == 0) {

      alert('Room is booked');
    }
    else {
      alert('error', 'server down');
    }
  }
  xhr.send('toggleStatus=' + id + '&value=' + val);
}


let add_image_form = document.getElementById('add_image_form');

add_image_form.addEventListener('submit', function (e) {
  e.preventDefault();
  add_image();
});

function add_image() {
  let data = new FormData();
  data.append('image', add_image_form.elements['image'].files[0]);
  data.append('room_id', add_image_form.elements['room_id'].value);
  data.append('add_image', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);



  xhr.onload = function () {

    if (this.responseText == 'inv_img') {
      alert('error', 'Only JPG and PNG images are allowed');
    }
    else if (this.responseText == 'inv_size') {
      alert('error', 'Img should be less than 2MB');
    }
    else if (this.responseText == 'upd_failed') {
      alert('error', 'Image upload failed.Server Down');
    }
    else {
      alert('Success', 'New Image added');
      document.querySelector("#room-images .modal-title").innerText = rname;
      room_images(add_image_form.elements['room_id'].value, rname);
      add_image_form.reset();
    }
  }
  xhr.send(data);
}


function room_images(id, rname) {
  document.querySelector("#room-images .modal-title").innerText = rname;
  add_image_form.elements['room_id'].value = id;
  add_image_form.elements['image'].value = '';

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('room-image-data').innerHTML = this.responseText;

  }
  xhr.send('get_room_images=' + id);

}



function rem_image(img_id, room_id) {


  let data = new FormData();
  data.append('image_id', img_id);
  data.append('room_id', room_id);
  data.append('rem_image', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);


  xhr.onload = function () {

    if (this.responseText) {
      alert('success', 'Image removed!');
    }
    else {
      alert('error', 'Server Down');
    }
  }
  xhr.send(data);
}

function thumb_image(img_id, room_id) {


  let data = new FormData();
  data.append('image_id', img_id);
  data.append('room_id', room_id);
  data.append('thumb_image', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/room_crud.php", true);


  xhr.onload = function () {

    if (this.responseText) {
      alert('success', 'Image thumbnail changed!');
      room_images();
    }
    else {
      alert('error', 'Server Down');
    }
  }
  xhr.send(data);
}

function remove_room(room_id) {
  {
    if (confirm("Do you want to delete room?")) {
      let data = new FormData();
      data.append('room_id', room_id);
      data.append('remove_room', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/room_crud.php", true);
      xhr.onload = function () {
        if (this.responseText) {
          alert('success', 'Room Removed');
          get_all_rooms();
        }
        else {
          alert('error', 'Server Down');
        }
      }
      xhr.send(data);
    }
  }
}

window.onload = function () {
  get_all_rooms();
}