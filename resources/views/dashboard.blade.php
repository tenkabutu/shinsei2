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

					<li>・気づいた点があればサイボウズなどでご連絡ください。</li>
					<li>・振替は許可済みであっても、作業時間と振替先の作業時間が一致しないと完了扱いになりません</li>

				</ul>
				</fieldset>
				<fieldset>
				<legend>update</legend>
				<ul>
					<li>・年度を指定していない場合は現在の年度でフィルターするように改修。</li>
				</ul>
				</fieldset>
				 <fieldset>
					<legend>改修予定</legend>
					<ul>
						<li>・入力エラーがでたときに入力欄の情報を保持する</li>
					</ul>
				</fieldset>
				<!-- <fieldset>
					<legend>不具合</legend>
					<ul>

						<li>・振替申請の修正まち状態時に、作業情報を更新しないと修正まちから申請中に変更されない。</li>

					</ul>
				</fieldset> -->



				<fieldset id="park_status">
				<legend>駐車申請</legend>

				<div id ="park_figure" class="grid">
					<div>
					<p>木下第2駐車場</p>
					<button class="openModal" data-image="/shinsei2/public/img/park.jpg">見取り図</button>
						<a href="https://maps.app.goo.gl/9eCXxyowJyiZvmRu9">MAP</a>
						<div id="modal" class="modal">
							<span class="close">&times;</span>

							<img class="modal-content" id="modalImage">
						</div>
					</div>
					@foreach ($park_list->skip(12)->take(3) as $index =>$park)
					<div class="park_ahead g{{$park->order_content}}">

						<p>{{ $park->nendo }}</p>
						@if($park->user_id==0)
						<div class="no_use user_car" >
						<span class="car_owner">{{$userdata->name2}}</span>
						<span class="time_stamp">{{optional($park->updated_at)->format('m/d h:i')}}</span></div>
						@else
						<div class="user_car" >
							<span class="car_owner">{{optional($park->user)->name2}}</span>
							<span class="time_stamp">{{optional($park->updated_at)->format('n/j G:i')}}</span>
						</div>
						@endif

						<label for="p{{$index+1}}"></label>
						<input id="p{{$index+1}}" type="checkbox" name="user_id" value="{{old('user_id', $park->user_id) }}" data-id="{{$park->id}}" class="check-opt">


					</div>
					@endforeach

					@foreach ($park_list->take(6) as $index =>$park)
					<div class="park_upper g{{$park->order_content}}">

						<p>{{ $park->nendo }}</p>
						@if($park->user_id==0)
						<div class="no_use user_car" >
						<span class="car_owner">{{$userdata->name2}}</span>
						<span class="time_stamp">{{optional($park->updated_at)->format('m/d h:i')}}</span></div>
						@else
						<div class="user_car" >
							<span class="car_owner">{{optional($park->user)->name2}}</span>
							<span class="time_stamp">{{optional($park->updated_at)->format('n/j G:i')}}</span>
						</div>
						@endif
						<label for="p{{$index+1}}"></label>
						<input id="p{{$index+1}}" type="checkbox" name="user_id" value="{{old('user_id', $park->user_id) }}"  data-id="{{$park->id}}" class="check-opt">

					</div>
					@endforeach

					@foreach ($park_list->skip(6)->take(6) as $index =>$park)
					<div class="park_lower g{{$park->order_content}}">

						<p>{{ $park->nendo }}</p>
						@if($park->user_id==0)
						<div class="no_use user_car" >
						<span class="car_owner">{{$userdata->name2}}</span>
						<span class="time_stamp">{{optional($park->updated_at)->format('m/d h:i')}}</span></div>
						@else
						<div class="user_car" >
							<span class="car_owner">{{optional($park->user)->name2}}</span>
							<span class="time_stamp">{{optional($park->updated_at)->format('n/j G:i')}}</span>
						</div>
						@endif

						<label for="p{{$index+1}}"></label>
						<input id="p{{$index+1}}" type="checkbox" name="user_id" value="{{old('user_id', $park->user_id) }}" data-id="{{$park->id}}" class="check-opt">


					</div>
					@endforeach
					<div>
					<p>江越第一駐車場</p>
					<button class="openModal" data-image="/shinsei2/public/img/park_outer.jpg">見取り図</button>
						<a href="https://maps.app.goo.gl/EVhMhh6k3XVNEvqo8">MAP</a>
						<div id="modal" class="modal">
							<span class="close">&times;</span>

							<img class="modal-content" id="modalImage">
						</div>
					</div>
					<!-- <div class="g35 park_info">

						<button id="openModal">見取り図</button>
						<a href="https://maps.app.goo.gl/EVhMhh6k3XVNEvqo8">MAP</a>
						<div id="modal" class="modal">
							<span class="close">&times;</span>

							<img class="modal-content" id="modalImage">
						</div>
					</div> -->
					@foreach ($park_list->skip(15)->take(2) as $index =>$park)
					<div class="park_outer g{{$park->order_content}}">

						<p>{{ $park->nendo }}</p>
						@if($park->user_id==0)
						<div class="no_use user_car" >
						<span class="car_owner">{{$userdata->name2}}</span>
						<span class="time_stamp">{{optional($park->updated_at)->format('m/d h:i')}}</span></div>
						@else
						<div class="user_car" >
							<span class="car_owner">{{optional($park->user)->name2}}</span>
							<span class="time_stamp">{{optional($park->updated_at)->format('n/j G:i')}}</span>
						</div>
						@endif

						<label for="p{{$index+1}}"></label>
						<input id="p{{$index+1}}" type="checkbox" name="user_id" value="{{old('user_id', $park->user_id) }}" data-id="{{$park->id}}" class="check-opt">


					</div>
					@endforeach
				<buton id="emergency">修正</buton>
				<div id="emergency_form">
					<select name="park_place">
					@foreach ($park_list as $park)
					<option value="{{ $park->id }}">{{ $park->nendo }}</option>
					@endforeach
					</select>に車が
					<select name="user_id"><option value="25">ある</option><option value="0">ない</option>
					</select>
					<button id="emergency_submit">送信</button>
				</div>

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
    	var modals = document.querySelectorAll(".modal");
    	var modalImages = document.querySelectorAll(".modal-content");
    	var openModals = document.querySelectorAll(".openModal");
    	var closeModals = document.querySelectorAll(".close");

    	openModals.forEach(function(openModal, index) {
    	    openModal.onclick = function() {
    	        modals[index].style.display = "block";
    	        var imageUrl = openModal.getAttribute("data-image");
    	        modalImages[index].src = imageUrl;
    	    }
    	});

    	closeModals.forEach(function(closeModal) {
    	    closeModal.onclick = function() {
    	        closeModal.parentNode.style.display = "none";
    	    }
    	});

    	window.onclick = function(event) {
    	    modals.forEach(function(modal) {
    	        if (event.target == modal) {
    	            modal.style.display = "none";
    	        }
    	    });
    	}
    	var images = [
    		  { url: 'url("/shinsei2/public/img/red_car.png")', weight: 1 },
    		  { url: 'url("/shinsei2/public/img/blue_car.png")', weight: 1 },
    		  { url: 'url("/shinsei2/public/img/yellow_car.png")', weight: 1 },
    		  { url: 'url("/shinsei2/public/img/white_car.png")', weight: 1 },
    		  { url: 'url("/shinsei2/public/img/black_car.png")', weight: 0.0002 }
    		];

    		// div要素を取得する
    		var divs = document.getElementsByClassName("user_car");

    		// 配列から重みを考慮してランダムに要素を選択する関数
    		function weightedRandom(weights) {
    		  var totalWeight = weights.reduce(function (acc, val) {
    		    return acc + val.weight;
    		  }, 0);
    		  var randomNumber = Math.random() * totalWeight;
    		  for (var i = 0; i < weights.length; i++) {
    		    if (randomNumber < weights[i].weight) {
    		      return weights[i].url;
    		    }
    		    randomNumber -= weights[i].weight;
    		  }
    		}

    		// div要素の数だけ繰り返す
    		for (var i = 0; i < divs.length; i++) {
    		  // 重みを考慮してランダムに画像を選び、そのURLを取得する
    		  var selectedImg = weightedRandom(images);
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
                    	 if (response.status === 'success') {
                             // 更新が成功したら、必要な処理をここに記述
                         } else {
                             // 更新が中断された場合、メッセージを表示するか処理を行う
                             alert(response.message);
                         }
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
                    	 if (response.status === 'success') {
                             // 更新が成功したら、必要な処理をここに記述
                         } else {
                             // 更新が中断された場合、メッセージを表示するか処理を行う
                             alert(response.message);
                         }
                     }
                 });

             }

        });

        // 出車ボタンのクリックイベント
        $('#emergency').click(function(){
            if(confirm('駐車場機能のデータを強制的に書き換えます。')){
			$('#emergency_form').show();
			 $("#emergency_submit").click(function () {
		            // フォームから選択された値を取得
		            var parkId = $("select[name='park_place']").val();
		            var userId = $("select[name='user_id']").val();

		            // Ajaxリクエストを送信
		            $.ajax({
		            	method: 'POST',
	                     dataType: "json",
	                     headers: {
	                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRFトークンを取得してヘッダに含める
	                     },
	                     url: 'car_park', // コントローラーのアクションに対応するURLを指定
	                     data: {
	                         id: parkId,
	                         user_id: userId
	                     },
		                success: function (response) {
		                    // 成功時の処理
		                    console.log("成功", response);
		                },
		                error: function (xhr, status, error) {
		                    // エラー時の処理
		                    console.error("エラー", error);
		                }
		            });
		        });


        }
  });


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
