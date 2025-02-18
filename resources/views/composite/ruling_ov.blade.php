<x-app-layout>
	<x-slot name="style">wrap_wide</x-slot>

	<x-slot name="head">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src='../js/jquery.tablesorter.js'></script>
		<script>
 			$(document).ready(function(){
				$('.sort-table').tablesorter();
			});
		</script>
	</x-slot>

<div class="main_right">
	@isset($type)
	<h3>@if($type==1||$type==4)振替申請
		@elseif($type==2||$type==5)休暇申請
		@elseif($type==3||$type==6)テレワーク申請
		@elseif($type==7)購入申請
		@endif</h3>
	@endisset
	<div id="narrow">
    		<fieldset>
                <legend>検索条件</legend>
    		<form action="" method="GET">
    		@csrf
    		<input type="hidden" name="mode" value="1">
    		<ul>

    			<li><div>日時：<select id="year" name="year"><option value="0">--</option></select>年
					<select id="month" name="month">
						<option value="0">--</option>
						@for($i = 1; $i <= 12; $i++)
							<option value={{$i}} @if(isset($input_data['month'])&&$i==$input_data['month']) selected @endif>{{$i}}</option>
						@endfor
						</select>月
					</div>
					@if(!isset($type))
					<div><label>状態：</label>
					 <div class="radio-group">
					<input id="st1_1" type="radio" class="st1" name="matter_type" value="1" @if(Request::get('matter_type')==1) checked @endif />
					<label for="st1_1">振替</label>
					<input id="st1_2" type="radio" class="st1" name="matter_type" value="2" @if(Request::get('matter_type')==2) checked @endif/>
					<label for="st1_2">休暇</label>
					<input id="st1_3" type="radio" class="st1" name="matter_type" value="3" @if(Request::get('matter_type')==3) checked @endif/>
					<label for="st1_3">テレワ</label>

					</div>

					</div>
					@endif
					<div><label>状態：</label>
					 <div class="radio-group">
					<input id="st2_1" type="radio" class="st2" name="search_type" value="1" @if(Request::get('search_type')==1) checked @endif/>
					<label for="st2_1">全件</label>
					<input id="st2_2" type="radio" class="st2" name="search_type" value="2" @if(Request::get('search_type')==2) checked @endif/>
					<label for="st2_2">未申請</label>
					<input id="st2_3" type="radio" class="st2" name="search_type" value="3" @if(Request::get('search_type')==3) checked @endif/>
					<label for="st2_3">申請中</label>
					<input id="st2_4" type="radio" class="st2" name="search_type" value="4" @if(Request::get('search_type')==4) checked @endif />
					<label for="st2_4">終了</label>
					</div>
					</div>
					@isset($type)
						@if($type==1||$type==4)
						<div><label>種別：</label>
					 <div class="radio-group">
					<input id="st1_1" type="radio" class="st1" name="matter_opt" value="3" @if(Request::get('matter_opt')==3) checked @endif />
					<label for="st1_1">振替</label>
					<input id="st1_2" type="radio" class="st1" name="matter_opt" value="4" @if(Request::get('matter_opt')==4) checked @endif/>
					<label for="st1_2">時間外</label>
					</div>
					</div>
						@elseif($type==2||$type==5)
					<div><label>種別：</label>
					 <div class="radio-group">
					<input id="st1_1" type="radio" class="st1" name="matter_opt" value="1" @if(Request::get('matter_opt')==1) checked @endif />
					<label for="st1_1">有給</label>
					<input id="st1_2" type="radio" class="st1" name="matter_opt" value="2" @if(Request::get('matter_opt')==2) checked @endif/>
					<label for="st1_2">欠勤</label>
					</div>
					</div>
					@endif
					@endisset
    				<div><label>地域：</label>
					<select id ="user" name="area"><option value="100">----</option>{!!$arealist!!}</select>
					</div>
					<div><label>氏名：</label>
					<select id ="user" name="user"><option value="0">----</option>{!!$userlist!!}</select>
					</div>
    			</li>
    		</ul>

    	<div><button type="submit" name="mode" value="search">検索</button></div>
    	</form>
    	</fieldset>
    </div>
	@isset($records)
	<x-ruling-box :role="Auth::user()->role" :type="$input_data['matter_type']" :records="$records"/>
	@endisset
</div>
<script>
$(function(){
var radio = $('div.radio-group');
$('input', radio).css({'opacity': '0'})
//checkedだったら最初からチェックする
.each(function(){
    if ($(this).attr('checked') == 'checked') {
        $(this).next().addClass('checked');
    }
});
//クリックした要素にクラス割り当てる
$('label', radio).click(function() {
    $(this).parent().parent().each(function() {
        $('label',this).removeClass('checked');
    });
    $(this).addClass('checked');
  ////  if($(this).parent().hasClass('index_select')){
    //	alert($('input[name="index50"]:checked').val());
    //    }
});

$(".end_check").change(function() {
    var isChecked = $(this).is(":checked") ? 1 : 0; // チェックされている場合は1、そうでない場合は0
    var matter_id = $(this).data("number"); // チェックボックスの番号を取得

    // サーバーに値を送信する処理をここに記述する
    //alert(isChecked+number);
    $.ajax({
      url: "end_check_pa", // サーバーのエンドポイントを指定
      method: "POST", // POSTメソッドを使用
      dataType: "json",
      data: { matter_id:matter_id, isChecked: isChecked,  _token: '{{csrf_token()}}'}, // 送信するデータを指定
      success: function(response) {
        console.log("値を送信しました。");
        // 成功時の処理をここに記述する
      },
      error: function(xhr, status, error) {
        console.error("エラーが発生しました。");
        // エラー時の処理をここに記述する
      }
    });
  });


var currentYear = new Date().getFullYear();
for (var year = currentYear; year >= 2023; year--) {
    var option = $('<option>', {
        value: year,
        text: year
    });

    // old('year') があれば、それを選択する
    @php
            $yearParam = request()->get('year');
        @endphp

        // URLパラメータのyearが存在する場合のみ選択状態を設定
        @if($yearParam)
            if ({{ $yearParam }} == year) {
                option.prop('selected', true);
            }
        @endif

    $('#year').append(option);
}

});
</script>
</x-app-layout>
