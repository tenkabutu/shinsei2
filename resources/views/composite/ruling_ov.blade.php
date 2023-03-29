<x-app-layout>
<x-slot name="head">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src='/shinsei2/public/js/jquery.repeater.js'></script>

<script>
/* $(document).ready(function(){
	$('.sort-table').tablesorter();
}); */
</script>
</x-slot>

<div class="main_right">
	<div id="narrow">
    		<fieldset>
                <legend>検索条件</legend>
    		<form action="" method="GET">
    		@csrf
    		<input type="hidden" name="mode" value="1">
    		<ul>

    			<li><div>日時：<select id="year" name="year">
    				<option value="2023">2023</option><option value="2022">2022</option></select>年
					<select id="month" name="month">
						<option value="0">--</option>
						@for($i = 1; $i <= 12; $i++)
							<option value={{$i}} @if(isset($input_data['month'])&&$i==$input_data['month']) selected @endif>{{$i}}</option>
						@endfor
						</select>月
					</div>
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
					<div><label>状態：</label>
					 <div class="radio-group">
					<!-- <input id="st2_1" type="radio" class="st2" name="search_type" value="1" @isset($input_data['search_type']) @if($input_data['search_type']==1) checked @endif @endisset />
					<label for="st2_1">全件</label> -->
					<!-- <input id="st1_2" type="radio" class="st1" name="search_type" value="2" @if(Request::get('search_type')==2) checked @endif/>
					<label for="st1_2">未申請</label>
					<input id="st1_3" type="radio" class="st1" name="search_type" value="3" @if(Request::get('search_type')==3) checked @endif/>
					<label for="st1_3">申請中</label> -->
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

    			<div><label>氏名：</label>
					<select id ="user" name="user"><option value="0">----</option>{{!!$userlist!!}}</select>
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



});
</script>
</x-app-layout>
