<?php include "../scripts/initialize.php"?>
<!DOCTYPE html>
<html lang="en">
<?php include "../scripts/linksandscripts.php"?>
<script>
  $(document).ready(function () {
    $('#users').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'scripts/users.php',
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'alert',
          text: 'My button 1'
        },
        {
          extend: 'alert',
          text: 'My button 2'
        },
        {
          extend: 'alert',
          text: 'Export to .CSV'
        }
        ]
    });
  });
$.fn.dataTable.ext.buttons.alert = {
  className: 'buttons-alert',
 
  action: function ( e, dt, node, config ) {
    alert( this.text() );
  }
};



/* Formatting function for row details - modify as you need */
function format(d) {
    // `d` is the original data object for the row
    return (
        '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        '<tr>' +
        '<td>Full name:</td>' +
        '<td>' +
        d.name +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Extension number:</td>' +
        '<td>' +
        d.extn +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Extra info:</td>' +
        '<td>And any further details here (images etc)...</td>' +
        '</tr>' +
        '</table>'
    );
}
 
$(document).ready(function () {
    var table = $('#example').DataTable({
        ajax: '../scripts/users.php',
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            { data: 'name' },
            { data: 'position' },
            { data: 'office' },
            { data: 'salary' },
        ],
        order: [[1, 'asc']],
    });
 
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
});








































</script>
<style>
  body {
    background-image: url('img/background.jpg');
    overflow: auto;
  }
  .main{
    border: 0.1em solid #ffffff;
    margin: 5em;
    padding: 1.5em;
    border-radius: 1em;
    background: rgba(255, 255, 255, 0.9);
  }
  
  img{
    float: left;
    position: relative;
    block-size: 3em;
    margin-left: 18px;
    margin-right:24px;
  }

  .navbar {
    overflow: hidden;
    background-color: rgb(0, 0, 0);
    padding: -1em;
  } 

</style>
<body>
<?php include "./customer/assets/header.php"?>
<div class="main">
<table id="users" class="display" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Username</th>
                <th>Access Type</th>
            </tr>
        </thead>
    </table>
</div>
<body>
</html>