<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restored Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .restore-button {
            background-color: #5cb85c;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .restore-button:hover {
            background-color: #4cae4c;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<a href="{{ route('profile') }}" style="margin-right: -76px;margin-left: 250px;margin-top: 50px" >
    <button>Back</button>
</a>
<h1>Restored Data</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number</th>
        <th>Address</th>
        <th>Email</th>
        <th>PAN</th>
        <th>Deleted At</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deletedData as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->number }}</td>
            <td>{{ $data->address }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->pan }}</td>
            <td>{{ $data->deleted_at }}</td>
            <td>
                <form method="POST" action="{{ route('restores', $data->id) }}">
                    @csrf
                    <button type="submit" class="restore-button" onclick="deleteConfirmation(event)">
                        <i class="bi bi-arrow-clockwise"></i> Restore
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function deleteConfirmation(event) {
        event.preventDefault();
        const form = event.target.closest('form'); // Find the closest form element
        const deleteUrl = form.action; // Get the action attribute of the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form
            }
        });
    }
</script>

</body>
</html>
