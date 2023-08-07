<x-app-layout>
<x-slot name="style"></x-slot>
<x-slot name="head">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src='/shinsei2/public/js/jquery.repeater.js'></script>
	<script>
   $(function() {
	   $.datetimepicker.setLocale('ja');
	   $('.target').datetimepicker({  scrollMonth : false,
		    scrollInput : false}).datepicker('setDate','today');

	  $('.target2').datetimepicker({
		  scrollMonth : false,
		  scrollInput : false,
		  timepicker:false,
	      format:'Y/n/j'
		});
	  $('.target3').datetimepicker({
		  scrollMonth : false,
		  scrollInput : false,
		  format:'h:m'
		});
	});
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
</x-slot>

<div class="main_right">
	<div id="shinsei_wrap">

		@if(isset($matter->status))
		<h3>購入申請<label>　(作成:{{$matter->created_at->format('Y/n/j')}}　更新:{{$matter->updated_at->format('Y/n/j')}})</label></h3>

			<x-change-status :matter="$matter" :type="2"/>
			<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist" :mcheck="1"/>
		@else
		<h3>新規購入申請</h3>
		<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist" :mcheck="2"/>
		@endif

		<form  method="post" action="" class="repeater"  >
			@csrf
			@if (session('save_check'))
    	<div class="alert alert-danger">{{ session('save_check') }}</div>
		<x-save-box :status="$matter->status" :role="0" :type="4"/>
		@endif
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="matter_type" value="7">

			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="allotted" value="{{old('allotted',$matter->allotted)}}">
				@if (session('save_check'))
				<input type="hidden" name="change_check" value="1">
				@else
				<input type="hidden" name="change_check" value="{{old('change_check',$matter->status)}}">
				@endif
				<x-matter-rewrite-box :userdata="$user" :type="7" :matter="$matter"/>
				@if($matter->status==5 && isset($matter->reject_content))
				<fieldset>
				<label class="text-danger">修正願い：{{$matter->reject_content}}</label>
				</fieldset><br>
				@endif
			@else
				<input type="hidden" name="allotted" value="{{old('allotted',$user->worktype->def_allotted)}}">
				<x-matter-box :userdata="$user" :type="4"/>
			@endif

			@if(session('delete_check'))
				<input type="hidden" name="delete_check" value="{{old('delete_check')}}">
    			<div class="alert alert-danger">{{ session('delete_check') }}</div>
				<x-save-box :status="7" :role="0" :type="4"/>
			@elseif(isset($matter))
				@if($matter->user_id==Auth::user()->id)
					<x-save-box :status="$matter->status" :role="0" :type="4"/>
				@elseif(Auth::user()->role<3)
					<x-save-box :status="$matter->status" :role="1" :type="4"/>
				@elseif(Auth::user()->role==4)
					<x-save-box :status="$matter->status" :role="4" :type="4"/>

				@else
				<!-- <label>test</label> -->
				@endif
			@else
			<x-save-box :status="0" :role="0" :type="2"/>
			@endif

		</form>
	</div>
</div>


<script>
function setAction(url) {
    $('form').attr('action', url);

    $('form').submit();
}
$(function(){
	var radio = $('div.radio-group');
	$('input', radio).css({'opacity': '0'})
	//checkedだったら最初からチェックする
	.each(function(){
	    if ($(this).attr('checked') == 'checked') {
	        $(this).next().addClass('checked');

	        if($(this).val()!=4){
		        $('.matter_date input').attr('readonly',true);
		        $('.matter_date input').css('backgroundColor','#e9e9e9');
		    };
	    }
	});
	//クリックした要素にクラス割り当てる
	$('label', radio).click(function() {
	    $(this).parent().parent().each(function() {
	        $('label',this).removeClass('checked');
	    });
	    $(this).addClass('checked');
	});



	 // ページが読み込まれたときに、各チェックボックスの状態を設定する
    $('.check-opt').each(function() {
        var opt = $(this).data('opt'); // opt1, opt2, opt3 のいずれか
        var value = $(this).data('value'); // 初期値
        if (value == 0) {
            // opt の値が 0 であれば未チェック
            $(this).prop('checked', false);
        } else {
            // opt の値が 0 以外であればチェック済み
            $(this).prop('checked', true);
        }
    });

    // チェックボックスがクリックされたときに、承認権限を持つユーザーであれば以下の処理を行う
    $('.check-opt').click(function() {
        var user_id = {{ Auth::user()->id }}; // ログインユーザーのID
        var user_role = {{ Auth::user()->role }}; // ログインユーザーの役割
        var opt = $(this).data('opt'); // opt1, opt2, opt3 のいずれか
        var value = $(this).data('value'); // 初期値
        var checked = $(this).prop('checked'); // チェック状態

        if (user_role == 'approver') {
            // 承認権限を持つユーザーであれば
            if (checked) {
                // チェックボックスが未チェックからチェック済みになった場合
                $(this).val(user_id); // チェックボックスのvalueにユーザーIDをセットする
                $(this).attr('disabled', true); // そのチェックをそのユーザー以外が外せないようにする
                $('.check-opt').not(this).attr('disabled', true); // 既にいずれかのチェックボックスにチェックをいれたユーザーは他の２つのチェックボックスの操作はできないようにする
            } else {
                // チェックボックスがチェック済みから未チェックになった場合
                $(this).val(value); // チェックボックスのvalueを初期値に戻す
                $(this).attr('disabled', false); // そのチェックを外せるようにする
                $('.check-opt').not(this).attr('disabled', false); // 他の２つのチェックボックスの操作もできるようにする

                $('.check-opt').each(function() {
                    if ($(this).val() == user_id) {
                        $(this).attr('disabled', false);
                    }
                });


            }

            // ３つのチェックボックスがチェックされた場合、以降チェックボックスの操作はできないようにする
            if ($('.check-opt:checked').length == 3) {
                $('.check-opt').attr('disabled', true);
            }
        } else {
            // 承認権限を持たないユーザーであれば、チェックボックスの操作はできないようにする
            $(this).prop('checked', !checked); // チェック状態を元に戻す
            $(this).attr('disabled', true); // チェックボックスを無効化する
        }
    });

 });
</script>
</x-app-layout>
