function confirmDelete(title) {
  bootbox.confirm({
    message: "<h3>Delete the movie from the database?</h3>",
    buttons: {
        confirm: {
            label: 'Delete',
            className: 'btn-danger'
        },
        cancel: {
            label: 'Cancel'
        }
    },
    backdrop: true,
    callback: function (result) {
      if (result) {
        console.log("delete movie");

      }
    }
  });
}
