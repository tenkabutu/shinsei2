<!DOCTYPE html>
<html lang="ja"> <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

				<link rel="icon" type="image/vnd.microsoft.icon" href="/shinsei2/public/img/favicon.ico">
				<title>2号出退勤管理モード(仮)</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="/shinsei2/public/css/app.css">

        <!-- Scripts -->
        <script src="/shinsei2/public/js/app.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .results {
            margin-top: 20px;
        }
        .results table {
            width: 100%;
            border-collapse: collapse;
        }
        .results th, .results td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .results th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Attendance Management</h1>
        <form id="filter-form" action="/attendance/search" method="GET">
            <div>
                <label for="user">User</label>
                <input type="text" id="user" name="user" placeholder="Enter User Name or ID">
            </div>

            <div>
                <label for="area">Area</label>
                <select id="area" name="area">
                    <option value="">Select Area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="{{ now()->toDateString() }}">
            </div>

            <button type="submit">Search</button>
        </form>

        <div class="results" id="results">
            @if ($results ?? false)
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Area</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td>{{ $result->user->name }} ({{ $result->user->employee_number }})</td>
                                <td>{{ $result->user->area->name }}</td>
                                <td>{{ $result->check_in }}</td>
                                <td>{{ $result->check_out ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No results to display. Use the form above to search.</p>
            @endif
        </div>
    </div>
</body>
</html>
