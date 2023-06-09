<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2">YOYO</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis
        obcaecati odit officiis nostrum quibusdam et ipsam facere exercitationem
        quos fugit mollitia vero repellat recusandae illo a, quam quas quaerat
        officia.
      </p>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Links</h5>
      <a
        href="index.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
        >Home</a
      ><br />
      <a
        href="room.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
        >Rooms</a
      ><br />
      <a
        href="facilit.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
        >Facilities</a
      >
      <br />
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Follow us</h5>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-twitter me-1"></i>Twitter </a
      ><br />
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-facebook me-1"></i>Facebook </a
      ><br />
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-instagram"></i> Instagram </a
      ><br />
    </div>
    <div class="col-lg-4 p-4"></div>
  </div>
</div>
<h6 class="text-center bg-dark text-white p-3 m-0">
  Designed and developed by Arun Chapagain
</h6>

<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
  crossorigin="anonymous"
></script>

<script>
  function setActive() {
    let navbar = document.getElementById("nav-bar");
    let a_tags = navbar.getElementsByTagName("a");
    for (i = 0; i < a_tags.length; i++) {
      let file =a_tags[i].href.split('/').pop();
      let file_name =file.split('.')[0];
      if(document.location.href.indexOf(file_name)>=0)
      {
        a_tags[i].classList.add('active');
      }
    }
  }
  setActive();
</script>
