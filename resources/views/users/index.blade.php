<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database Users List</title>
    <style>
        /* Basic dark theme styles */
        body {
            background-color: #222;
            color: #ddd;
            font-family: sans-serif;
        }
        h1 {
            color: #fff;
            text-align: center;
        }

        /* Table styles with dark theme */
        table {
            border-collapse: collapse;
            width: 100%; /* Ensure table fills available width */
            margin: 20px auto; /* Center the table */
        }
        th, td {
            padding: 10px;
            border: 1px solid #444; /* Adjust border color for dark theme */
            text-align: left; /* Adjust alignment for data types if needed */
        }
        thead th {
            background-color: #333;
            color: #fff;
        }

        /* Responsive design adaptations */
        @media only screen and (max-width: 768px) {
            /* Adjust table layout for smaller screens */
            table {
                display: block;
                overflow-x: auto;
            }
            th, td {
                display: block;
                width: 100%; /* Make each cell full width on small screens */
            }
            th:first-child,
            td:first-child {
                border-top-left-radius: 10px; /* Top-left corner rounding for first column */
            }
            th:last-child,
            td:last-child {
                border-top-right-radius: 10px; /* Top-right corner rounding for last column */
            }
        }

        /* Styling for the delete button */
        .delete-btn {
            background-color: #b32e2e; /* Reddish color for delete action */
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Indicate clickable behavior */
        }
    </style>
</head>
<body>
    <h1>List of Database Users</h1>
    @dump($clients)
    <table>
        <thead>
            <tr>
                <th>first Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>phone Number</th>
                <th>User id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->firstName}}</td>
                <td>{{ $client->lastName  }}</td>
                <td>{{ $client->address }}</td>
                 <td>{{ $client->phoneNumber }}</td>
                 <td>{{$client ->user_id}}</td>
            
            </tr>
            @endforeach
        </tbody>
    </table>




</body>
</html>
