import Swal from 'sweetalert2';

console.log("Script eliminar.js cargado");

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("eliminarRegistroBtn")) {
        let boton = e.target;
        let url = boton.getAttribute("data-url");
        let registro = boton.getAttribute("data-entidad");

        Swal.fire({
            title: "¿Estás seguro?",
            text: `Vas a eliminar este ${registro}. No podrás revertir esto.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "green",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement("form");
                form.method = "POST";
                form.action = url;
                form.style.display = "none";

                form.innerHTML = `
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                    <input type="hidden" name="_method" value="DELETE">
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
});
