<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Registration form</title>
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
        input[type="email"],
        input[type="password"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
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
        .navbar-brand {
            font-size: 1.5em;
            font-weight: bold;
            color: #007bff; /* blue */
        }

        .navbar-nav .nav-link {
            color: #007bff; /* blue */
        }

        .navbar-nav .nav-link:hover {
            color: #0056b3; /* darker blue */
        }
        .jumbotron {
            background-color: #007bff; /* blue */
            padding: 100px 20px;
            text-align: center;
            margin-top: 20px;
            color: #fff; /* white */
        }


    </style>
</head>
<body>
        <!-- Navigation Bar -->
        <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ambition Guru Team</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        </div>
<div class="container">

    <h1>Registration form</h1>

    
    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
      

        <label for="username">Username:</label>
        <input type="text" id="username" name="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">

        <label for="number">Number:</label>
        <input type="text" id="number" name="number">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="pan">PAN:</label>
        <input type="text" id="pan" name="pan">

        <label for="image">Image:</label>
        <input type="file" id="image" name="image">

        <button type="submit">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
