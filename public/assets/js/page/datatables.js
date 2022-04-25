"use strict";

$("[data-checkboxes]").each(function () {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function () {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if (role == 'dad') {
      if (me.is(':checked')) {
        all.prop('checked', true);
      } else {
        all.prop('checked', false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop('checked', true);
      } else {
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable();
$("#table-2").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [0, 2, 3] }
  ],
  order: [[1, "asc"]] //column indexes is zero based

});
$("#table-3").dataTable();
$("#table-4").dataTable();
$("#table-5").dataTable();
$('#save-stage').DataTable({
  "scrollX": true,
  stateSave: true
});
$('#tableExport').DataTable({
  dom: 'Bfrtip',
  buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
  ]
});

$('#tableExport1').DataTable({
  dom: 'Bfrtip',
  buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
  ]
});

$(".decline").click(function () {
  var id = $(this).data("id");
  swal({
    title: 'Are you sure?',
    text: 'Once declined, you will not be able to recover this withdraw request!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "/transactions/withdraw/decline",
          method: "POST",
          data: { 
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            id : id 
          },
          success: function(response) {
            swal('Poof! Withdraw request has been declined!', {
              icon: 'success',
            });
            setTimeout(() => {
              location.reload();
            }, 1000);
          }
        });
      } else {
        swal('The withdraw request is still pending!');
      }
    });
});

$(".delete").click(function () {
  var id = $(this).data("id");
  swal({
    title: 'Are you sure?',
    text: 'Once deleted, you will not be able to recover this question!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: delete_url,
          method: "DELETE",
          data: { 
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            id : id 
          },
          success: function(response) {
            swal('Poof! Question is deleted successfully', {
              icon: 'success',
            });
            setTimeout(() => {
              location.reload();
            }, 1500);
          }
        });
      } else {
        swal('The question is safe!');
      }
    });
});
