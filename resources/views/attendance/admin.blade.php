<x-app-layout>
<x-slot name="style"></x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

       <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, select {
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
        .results {
            margin-top: 20px;
        }


    </style>
    <script>
 $(document).ready(function(){
	$('.sort-table').tablesorter();
});
</script>
    </x-slot>


    <div class="main_right">
    <div class="container">
        <h1>2号打刻管理</h1>
        <div id="narrow">
        <form action="search" method="GET">
            @csrf
            <ul><li><div>
            <label for="employee_id">社員番号</label>
            <input type="text" id="employee_id" name="employee_id" placeholder="未入力" size="5">

            <label for="area_id">地域</label>
            <select id="area_id" name="area_id">
                <option value="">未選択</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
            </div>
          <div>
            	  <label for="date_from">開始期間</label>
            <input type="date" id="date_from" name="date_from" value="{{ request('date_from', date('Y-m-d')) }}">

            <label for="date_to">終了期間</label>
            <input type="date" id="date_to" name="date_to" value="{{ request('date_to', date('Y-m-d')) }}">

    			</div> <button type="submit">検索</button></li>
    		</ul>




        </form>
		 </div>
        <div class="results">
            @if (isset($results) && $results->isNotEmpty())
                <table class="task_table sort-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>地域</th>
                            <th>入室時刻</th>
                            <th>退室時刻</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $record)
                            <tr>
                            	<td>{{ $record->user->employee }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->user->areas->pluck('name')->join(', ') }}</td>
                                <td>{{ $record->check_in }}</td>
                                <td>{{ $record->check_out ?? '入室中' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif (isset($results))
                <p>No records found for the given criteria.</p>
            @endif
        </div>
    </div>
    </div>

    </x-app-layout>