<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
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
            max-width: 600px;
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
        }
        label {
            margin-bottom: 8px;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 24px;
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
        .employee-list {
            margin-top: 20px;
        }
        .employee-list h2 {
            margin-bottom: 10px;
        }
        .employee-list ul {
            list-style-type: none;
            padding: 0;
        }
        .employee-list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>

    </head>
    <body class="font-sans antialiased">
        <div id="wrap" >
        <main>
    <div class="main_right">
   <div class="container">
        <h1>第二事務所タイムスタンプ</h1>
        <form action="attendance/check" method="POST">
            @csrf
            <label for="employee_id">社員番号</label>
            <input type="text" id="employee_id" name="employee_id"  autocomplete="off" required>

            <div style="display: flex; justify-content: space-between;">
                <button type="submit" name="action" value="check-in">入室</button>
                <button type="submit" name="action" value="check-out">退出</button>
            </div>
        </form>

        <div class="employee-list">
            <h2>なかのひと</h2>
            <ul>
				@forelse ($currentEmployees as $employee)
                    <li>{{ $employee->name }} ({{ $employee->attendance->check_in }})</li>
                @empty
                    <li>いません</li>
                @endforelse
            </ul>
        </div>
    </div>









    </div>


            </main>
        </div>
    </body>
     <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            const employeeId = document.querySelector('#employee_id').value;
            const action = e.submitter.value;

            // Redirect to search page if admin ID is entered
            if (employeeId === '{{ config('app.admin_id') }}') {
                e.preventDefault();
                window.location.href = '/attendance/search';
            }
        });
    </script>
</html>
