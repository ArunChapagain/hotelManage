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
        setTimeout(remAlert(), 2000);
    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }