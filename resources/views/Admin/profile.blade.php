
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration List</title>
    <link href="{{ asset('/bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .alert {
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .close-btn {
        float: right;
        cursor: pointer;
        font-weight: bold;
    }

    /* Styles for action buttons */
    .action-btn {
        font-weight: bold;
        padding: 1px 12px;
        border-radius: 5px;
        color: #000000;
        text-decoration: none;
        margin-right: 8px;
    }

    .edit-btn {
        background-color: yellow;
    }

    .view-btn {
        background-color: deepskyblue;
    }

    .delete-btn {
        background-color: orangered;
    }

    .btn-icon {
        margin-right: 5px;
    }

    /* Styles for positioning table and buttons */
    .container {
        margin-top: 50px;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>

<body>

<div class="container" style="margin-left: 15px">
    @if (session('success'))
        <div id="successMessage" class="alert alert-success">
            {{ session('success') }}
            <span class="close-btn" onclick="closeAlert()">&times;</span>
        </div>
    @endif

    <h1 style="margin-left: 280px;">List of Users</h1>

    <!-- New button for registration -->
    <div style="margin-left: auto; margin-bottom: 10px;">
    <a href="{{ route('Register') }}" class="btn btn-primary btn-lg" style="margin-left:1060px;">+</a>
</div>
<li><a href="{{ route('restore') }}">Restore</a></li>



    <div class="table-container">
        <table class="table" border="5">
            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Email</th>
                <th>Pan</th>
                <th>Username</th>
                <th>image</th>


                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key=> $co)
            
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $co->name }}</td>
                    <td>{{ $co->number }}</td>
                    <td>{{ $co->address }}</td>
                    <td>{{ $co->email }}</td>
                    <td>{{ $co->pan }}</td>
                    <td>{{ $co->username }}</td>
                    
                    
                    <td>
                    <img src="{{ asset('uploads/students/' . $co->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;" /> 
                    </td>
                    <td>
                        <a href="{{ route('edit', $co->id) }}" class="action-btn edit-btn">
                            <i class="btn-icon bi bi-pencil"></i>Edit
                        </a>
                        <!-- <a href="{{ route('view', $co->id) }}" class="action-btn view-btn">
                            <i class="btn-icon bi bi-eye"></i>View
                        </a> -->
                        <a href="{{ route('delete', $co->id) }}" class="action-btn delete-btn" onclick="deleteConfirmation(event)">
                            <i class="btn-icon bi bi-trash"></i>Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script src="{{ asset('/bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>

<script>
    function deleteConfirmation(event) {
        event.preventDefault();
        const deleteUrl = event.target.href;

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    }

    function closeAlert() {
        document.getElementById("successMessage").style.display = "none";
    }
</script>
</body>
</html>

