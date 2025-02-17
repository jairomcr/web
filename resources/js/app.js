import "./bootstrap";
import Alpine from "alpinejs";
//import "./main";

window.Alpine = Alpine;
Alpine.start();

/* function confirmation(ev) {
    ev.preventDefault();
    var form = ev.currentTarget.closest("form"); // Get the form closest to the button

    swal({
        title: "¿Estás seguro de eliminar esto?",
        text: "No podrás revertir esta acción",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit(); // Send the form if the user confirms
        }
    });
} */
