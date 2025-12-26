function deleteCategory(id) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¿Deseas eliminar esta categoría?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: window.BASE_URL + "categories/delete?id=" + id,
        type: "POST",
        dataType: "json",
        success: function (response) {
          if (response.success) {
            Swal.fire("Eliminado!", response.message, "success").then(() => {
              location.reload();
            });
          }

          if (response.error) {
            Swal.fire("Error!", response.message, "error");
          }
        },
        error: function () {
          Swal.fire(
            "Error!",
            "Ocurrió un error al eliminar la categoría.",
            "error"
          );
        },
      });
    }
  });
}

$(document).ready(function () {
  $("#categories").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
    },
  });

  $("#categoryForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    $.ajax({
      url: this.action,
      method: "POST",
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: response.message,
            timer: 1500,
            showConfirmButton: false,
          }).then(() => {
            window.location.href = BASE_URL + "categories";
          });
        } else {
          Swal.fire("Error", response.message, "error");
        }
      },
      error: function () {
        Swal.fire("Error", "Error del servidor", "error");
      },
    });
  });
});
