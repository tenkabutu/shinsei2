<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/vnd.microsoft.icon" href="/shinsei2/public/img/favicon.ico">
        <title>2号出退勤管理モード(仮)</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/shinsei2/public/css/app.css">
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
            .button-group {
                display: flex;
                justify-content: space-between;
            }
            button {
                padding: 10px;
                font-size: 16px;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                flex: 1;
                margin: 0 5px;
            }
            button:first-child {
                margin-left: 0;
            }
            button:last-child {
                margin-right: 0;
            }
            button[name="action"][value="check-in"] {
                background-color: #007bff;
            }
            button[name="action"][value="check-in"]:hover {
                background-color: #0056b3;
            }
            button[name="action"][value="check-out"] {
                background-color: #e57373;
            }
            button[name="action"][value="check-out"]:hover {
                background-color: #c62828;
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
            .hg-width{
            width:93px !important;}
        </style>
    </head>
    <body class="font-sans antialiased">
        <div id="wrap">
            <main>
                <div class="main_right">
                    <div class="container">
                    <div>
                        <h1>第二事務所タイムスタンプ</h1>
                        <p>・入室時に自分の社員番号を入力して入室ボタンを押してください</p>
                        <p>・退室時に自分の社員番号を入力して退出ボタンを押してください</p>
                        <form action="attendance/check" method="POST">
                            @csrf
                            <label for="employee_id">社員番号</label>
                            <input class="input" type="text" id="employee_id" name="employee_id" autocomplete="off" required>

                            <div class="button-group">
                                <button type="submit" name="action" value="check-in">入室</button>
                                <button type="submit" name="action" value="check-out">退出</button>
                            </div>
                        </form>
</div> <div class="simple-keyboard"></div>
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
        <script>
            document.querySelector('form').addEventListener('submit', function (e) {
                const employeeId = document.querySelector('#employee_id').value;
                const action = e.submitter.value;

                if (employeeId === '{{ config('app.admin_id') }}') {
                    e.preventDefault();
                    window.location.href = '/attendance/search';
                }
            });
        </script>
    </body>
</html>
