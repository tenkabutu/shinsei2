<x-app-layout>
	<x-slot name="style"></x-slot>
    <x-slot name="head">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </x-slot>

    <div class="main_right">
    <h3>トップページ</h3>
     <fieldset>
				<legend>info</legend>
				<ul>
					<li>・振替は許可済みであっても、作業時間と振替先の作業時間が一致しないと完了扱いになりません</li>

				</ul>
				</fieldset>
				<fieldset>
				<legend>update</legend>
				<ul>
					<li>・トップページに第二駐車の登録機能を追加。</li>
				</ul>
				</fieldset>
				 <fieldset>
					<legend>改修予定</legend>
					<ul>
						<li>・駐車機能に、入れ忘れ出し忘れ用の代理操作機能を追加予定</li>
						<li>・入力エラーがでたときに入力欄の情報を保持する</li>


					</ul>
				</fieldset>
				 <fieldset>
					<legend>不具合</legend>
					<ul>

						<li>・気づいた点があればサイボウズなどでご連絡ください。</li>
					</ul>
				</fieldset>



				<fieldset id="park_status">
				<legend>駐車場</legend>
				<div id ="park_figure" class="grid">
					@foreach ($park_list->take(5) as $index =>$park)
					<div class="park_upper g{{$index+1}}{{$index+2}}">

						<p>{{ $park->nendo }}</p>
						@if($park->user_id==0)
						<div class="no_use user_car" >
						<span class="car_owner">{{$userdata->name2}}</span>
						<span class="time_stamp">{{optional($park->updated_at)->format('m/d h:i')}}</span></div>
						@else
						<div class="user_car" >
							<span class="car_owner">{{optional($park->user)->name2}}</span>
							<span class="time_stamp">{{optional($park->updated_at)->format('n/j h:i')}}</span>
						</div>
						@endif
						<label for="p{{$index+1}}"></label>
						<input id="p{{$index+1}}" type="checkbox" name="user_id" value="{{old('user_id', $park->user_id) }}"  data-id="{{$park->id}}" class="check-opt">

					</div>
					@endforeach

					@foreach ($park_list->skip(5)->take(5) as $index =>$park)
					<div class="park_lower g{{$index-4}}{{$index-3}}">

						<p>{{ $park->nendo }}</p>
						@if($park->user_id==0)
						<div class="no_use user_car" >
						<span class="car_owner">{{$userdata->name2}}</span>
						<span class="time_stamp">{{optional($park->updated_at)->format('m/d h:i')}}</span></div>
						@else
						<div class="user_car" >
							<span class="car_owner">{{optional($park->user)->name2}}</span>
							<span class="time_stamp">{{optional($park->updated_at)->format('n/j h:i')}}</span>
						</div>
						@endif

						<label for="p{{$index+1}}"></label>
						<input id="p{{$index+1}}" type="checkbox" name="user_id" value="{{old('user_id', $park->user_id) }}" data-id="{{$park->id}}" class="check-opt">


					</div>
					@endforeach


				</div></fieldset>
					<fieldset>
				<legend>未振替(仮)</legend>
				<ul><li>
				<table class="task_table sort-table">
			<thead>
			<tr>
				<th class="id" sortable>No</th>
				<th>申請者</th>
				<th class="id">申請日</th>
				<th class="id">実施日</th>
				<th class="id">開始時間</th>
				<th class="id">終了時間</th>
				<th class="s3">時間</th>
				<th>案件状態</th>
				<th class="id">申請/確認日</th>
				<th class="auto">作業</th>
				<th></th>

			</tr>
			</thead>
			@if(isset($records))

			@php
			 $back = 0;
			@endphp
			@foreach ($records as $id =>$record)
			@if($back!=$record->matters_id)
			<tr class="d{{$id+1}}">


				<td><a href="/shinsei2/public/{{ $record->matters_id }}/rewrite_ov">{{ $record->matters_id}}</a></td>
				<td>{{ $record->username}}</td>
				<td>{{ date('n/j',strtotime($record->matter_request_date))}}</td>
				<td>{{ date('n/j',strtotime($record->matter_change_date))}}</td>
				<td>{{$record->hour1.":".$record->minutes1}}</td>
				<td>{{$record->hour2.":".$record->minutes2}}</td>

				<td>{{floor($record->allotted/60).'時間 '.($record->allotted%60).'分'}}</td>
				<td>{{ $record->statusname}}</td>
				<td>@if($record->status==2){{date('n/j',strtotime($record->matter_request_date))}}@elseif($record->status>=3){{date('n/j',strtotime($record->matter_reply_date))}}@endif</td>
				<td>{{$record->allotted}}</td>
				<td><button class="show_ov" onclick="location.href='/shinsei2/public/{{ $record->matters_id }}/rewrite_ov'">詳細</button></td>
				</tr>

				@endif
				@php
					if($back!=$record->matters_id){
						$back =$record->matters_id;
					};
				@endphp
				@if($record->matter_id)
				<tr>
				<td></td>
				<td></td>
				<td>⇒</td>
				<td>{{date('n/j',strtotime($record->task_change_date))}}</td>
				<td>{{$record->task_hour1.":".$record->task_minutes1}}</td>
				<td>{{$record->task_hour2.":".$record->task_minutes2}}</td>
				<td>{{floor($record->task_allotted/60).'時間 '.($record->task_allotted%60).'分'}}</td>
				@if($record->task_status==2)
				<td>申請中</td><td>{{date('n/j',strtotime($record->task_request_date))}}</td>
				@elseif($record->task_status>=3)
				<td>確認済み</td><td>{{date('n/j',strtotime($record->task_reply_date))}}</td>
				@else
				<td></td><td></td>
				@endif
				<td>{{$record->task_total}}</td>
				<td></td>
				@endif



			</tr>

			@endforeach
			@endif


		</table></li>
				</ul>
				</fieldset>



    </div>
    <script>
    $(document).ready(function () {
    	var images = [
    		  'url("/shinsei2/public/img/red_car.png")',
    		  'url("/shinsei2/public/img/blue_car.png")',
    		  'url("/shinsei2/public/img/yellow_car.png")',
    		  'url("/shinsei2/public/img/white_car.png")'
    		];

    		// div要素を取得する
    		var divs = document.getElementsByClassName("user_car");

    		// div要素の数だけ繰り返す
    		for (var i = 0; i < divs.length; i++) {
    		  // 配列の長さ（4）から0～3の整数をランダムに生成する
    		  var number = Math.floor(Math.random() * images.length);
    		  // 配列からランダムに選ばれた画像のパスを取得する
    		  var selectedImg = images[number];
    		  // div要素の背景画像として設定する
    		  divs[i].style.backgroundImage = selectedImg;
    		}
        // 初期化
        initializeParking();

        // 駐車ボタンのクリックイベント
        $('#park_figure label').on('click', function () {
        	 var label = $(this);
             var checkbox = label.siblings('input[type="checkbox"]');
             var id = checkbox.data('id');


             if(checkbox.val()==0&&!label.hasClass('blocked')){
            	 label.addClass('checked');
            	 checkbox.prop('checked', true);
            	 checkbox.val({{ Auth::id() }});
            	 var car = label.siblings('.user_car').show();
            	 $('#park_figure label').not(label).addClass('blocked');

            	 $.ajax({
                     method: 'POST',
                     dataType: "json",
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRFトークンを取得してヘッダに含める
                     },
                     url: 'car_park', // コントローラーのアクションに対応するURLを指定
                     data: {
                        // name: name,
                         id:id,
                         user_id: checkbox.val()
                     },
                     success: function(response) {
                         // 更新が成功したら、必要な処理をここに記述
                     }
                 });

             }else if(label.hasClass('checked')){
            	 var car = label.siblings('.user_car').hide();
            	 checkbox.prop('checked', false);
                 checkbox.val(0);
                 label.removeClass('checked');
                 // 他の駐車ボタンを有効化
                 $('#park_figure input[type="checkbox"]').prop('disabled', false);
                 // 他の駐車ボタンのブロックを解除
                 $('#park_figure label').removeClass('blocked');


                 $.ajax({
                     method: 'POST',
                     dataType: "json",
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRFトークンを取得してヘッダに含める
                     },
                     url: 'car_park', // コントローラーのアクションに対応するURLを指定
                     data: {
                         id:id,
                         user_id: checkbox.val()
                     },
                     success: function(response) {
                         // 更新が成功したら、必要な処理をここに記述
                     }
                 });

             }





            // ここでAjaxリクエストを送信して、サーバーに駐車情報を更新することができます
        });

        // 出車ボタンのクリックイベント


        function initializeParking() {
            $('#park_figure input[type="checkbox"]').each(function () {
                var checkbox = $(this);
                var label = checkbox.siblings('label');
                var user_id = checkbox.val();

                if (user_id !== '0') {
                    if (user_id === '{{ Auth::id() }}') {
                        // 自分が駐車している場合
                        checkbox.prop('checked', true);
                        label.addClass('checked');
                        // 他の駐車ボタンを無効化
                        $('#park_figure input[type="checkbox"]').not(checkbox).prop('disabled', true);
                        // 他の駐車ボタンをブロック
                        $('#park_figure label').not(label).addClass('blocked');
                    } else {
                        // 他のユーザーが駐車している場合
                        checkbox.prop('checked', true);
                        label.addClass('blocked2');
                    }
                }
            });
        }
    });
    </script>
</x-app-layout>
