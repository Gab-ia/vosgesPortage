function deleteButtonF(itemText, itemId, path) {
  Swal.fire({
    html: 'Etes vous certain de vouloir effacer <b>\'' + itemText + '</b>\' ?',
    icon: 'warning',
    iconColor: '#ea5455',
    showCancelButton: true,
    confirmButtonText: 'EFFACER',
    cancelButtonText: 'ANNULER',
    customClass: {
      confirmButton: 'btn btn-danger me-2',
      cancelButton: 'btn btn-primary'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {

      const deleteForm = document.createElement("form");
      const id_item = document.createElement("input");

      deleteForm.method = "POST";
      deleteForm.action = path;

      id_item.value = itemId;
      id_item.name = "item_id";
      deleteForm.appendChild(id_item);

      document.body.appendChild(deleteForm);

      deleteForm.submit();
    }
  });
}