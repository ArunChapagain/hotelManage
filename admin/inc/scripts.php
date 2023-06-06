<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function alertMessage(type, msg) {
    $bs_class = (type == 'success') ? "alert-sucess" : "alert-danger";
    let element = document.createElement('div');
    element.innerHTML = `

    <div class="alert ${bs_class} alert-dismissible show fade custom-alert" role="alert">
       <strong class="me-3">${msg}</strong> 
       <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" ></button>
    </div>
    `;
    document.body.append(element);
    setTimeout(remAlert, 2000);
  }

  function remAlert() {
    document.getElementsByClassName('alert')[0].remove();
  }



  function setActive() {
    let navbar = document.getElementById("nav-bar");
    let a_tags = navbar.getElementsByTagName("a");
    for (i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];
      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }
    }
  }
  setActive();
</script>