


function get_users() {


  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/user_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


  xhr.onload = function () {

    document.getElementById('users-data').innerHTML = this.responseText;

  }
  xhr.send('get_users');
}

function user_images(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/user_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


  xhr.onload = function () {
    document.getElementById('user-image-data').innerHTML = this.responseText;
  }
  xhr.send('get_user_images=' + id);
}



function toggleStatus(id, val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/user_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'status toggled');
      get_users();
    }
    else {
      alert('error', 'server down');
    }
  }
  xhr.send('toggle_status=' + id + '&value=' + val);
}


window.onload = function () {
  get_users();
}