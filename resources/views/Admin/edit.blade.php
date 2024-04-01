<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
        }

        button[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<div class="container">


    <h1>Edit Data</h1>
    <a href="{{ route('profile') }}" style="margin-right: -76px;margin-left: 351px;">
        <button>Back</button></a>


    <form method="POST" action="{{ route('update', $data['id']) }}"  enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $data['name'] }}">

        <label for="username">username:</label>
        <input type="text" id="username" name="username" value="{{ $data['username'] }}">
        
        <label for="password">password:</label>
        <input type="text" id="password" name="password" value="{{ $data['password'] }}">

        <label for="number">Number:</label>
        <input type="text" id="number" name="number" value="{{ $data['number'] }}">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="{{ $data['address'] }}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $data['email'] }}">

        <label for="pan">PAN:</label>
        <input type="text" id="pan" name="pan" value="{{ $data['pan'] }}">

        <label for="image">Current Image:</label>
        @if($data['image'])
            <img src="{{ asset('uploads/students/' . $data['image']) }}" alt="Current Image" style="max-width: 100px; max-height: 100px;">
        @else
            <p>No image available</p>
        @endif

        <label for="new_image">New Image:</label>
        <input type="file" id="new_image" name="new_image">

        <button type="submit">Update</button>
    </form>

</div>
</body>
</html>
