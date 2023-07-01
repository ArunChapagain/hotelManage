


function get_booking() {


  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/booking_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


  xhr.onload = function () {

    document.getElementById('booking-data').innerHTML = this.responseText;

  }
  xhr.send('get_booking');
}




function toggleStatus(id, val, rid) {
  let data= new FormData();
  data.append('toggle_status','');
  data.append('id',id);
  data.append('value',val);
  data.append('room_id',rid);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/booking_crud.php", true);

  xhr.onload = function () {
    if (this.responseText) {
      alert('success', 'status toggled');
      get_booking();
    }
    else {
      alert('error', 'server down');
    }
  }
  xhr.send(data);
}

function remove_booking(id,status) {
  {
    if (confirm("Do you want to delete Booking?")) {
      let data = new FormData();
      data.append('id', id);
      data.append('status', status);
      data.append('remove_booking', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/booking_crud.php", true);
      xhr.onload = function () {
        if (this.responseText==1) {
          alert('success', 'Booking Removed');
          get_booking();
        }
        else {
          alert('Room is booked cannot delete booking details!');
        }
      }
      xhr.send(data);
    }
  }
}

window.onload = function () {
  get_booking();
}