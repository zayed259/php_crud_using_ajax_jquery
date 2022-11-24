<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD using AJAX and jQuery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">PHP CRUD using AJAX and jQuery</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Add New Record</h3>
                <form id="addForm">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Add Record</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">All Records</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add Record
            $('#addForm').on('submit', function(e) {
                e.preventDefault();
                let name = $('#name').val();
                let email = $('#email').val();
                let phone = $('#phone').val();
                $.ajax({
                    url: 'add.php',
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        phone: phone
                    },
                    success: function(response) {
                        $('#addForm')[0].reset();
                        alert(response);
                        showAllRecords();
                    }
                });
            });

            // Show All Records
            showAllRecords();

            function showAllRecords() {
                $.ajax({
                    url: 'show.php',
                    type: 'GET',
                    data: {
                        show: 1
                    },
                    success: function(response) {
                        $('#tbody').html(response);
                    }
                });
            }

            // Delete Record
            $('body').on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                let deleteId = $(this).attr('id');
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: {
                        id: deleteId
                    },
                    success: function(response) {
                        alert(response);
                        showAllRecords();
                    }
                });
            });

            // Edit Record
            $('body').on('click', '.editBtn', function(e) {
                e.preventDefault();
                let editId = $(this).attr('id');
                $.ajax({
                    url: 'edit.php',
                    type: 'POST',
                    data: {
                        id: editId
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone);
                        $('#addForm').attr('id', 'editForm');
                        $('#editForm').append(`<input type="hidden" name="id" id="id" value="${data.id}">`);
                        $('#editForm').append(`<button type="submit" class="btn btn-primary">Update Record</button>`);
                    }
                });
            });

            // Update Record
            $('body').on('submit', '#editForm', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let name = $('#name').val();
                let email = $('#email').val();
                let phone = $('#phone').val();
                $.ajax({
                    url: 'update.php',
                    type: 'POST',
                    data: {
                        id: id,
                        name: name,
                        email: email,
                        phone: phone
                    },
                    success: function(response) {
                        $('#editForm')[0].reset();
                        $('#editForm').attr('id', 'addForm');
                        $('.btn-primary').remove();
                        alert('Record Updated Successfully');
                        showAllRecords();
                    }
                });
            });
        });
    </script>
</body>

</html>