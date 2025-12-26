function confirmDelete(form) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¿Estás seguro de que deseas eliminar este sitio?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit();
      Swal.fire("Eliminado!", "El sitio ha sido eliminado.", "success");
    }
  });
}

$(document).ready(function () {
  $("#dataTable").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
    },
  });

  // Manejo del formulario de sitio
  $("#siteForm").on("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Swal.fire("Éxito!", response.message, "success").then(() => {
            window.location.href = window.BASE_URL + "home";
          });
        } else {
          Swal.fire("Error!", response.message, "error");
        }
      },
      error: function () {
        Swal.fire("Error!", "Ocurrió un error al guardar el sitio.", "error");
      },
    });
  });
});