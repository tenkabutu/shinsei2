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
			<x-save-box :status="0" :role="0" :type="4"/>
			@endif

		</form>
	</div>
</div>


<script>
function setAction(url) {
    $('form').attr('action', url);

    $('form').submit();
}
var user_id = {{ Auth::id() }};
var user_name = "{{ Auth::user()->name }}";
var user_role = {{Auth::user()->permissions}} & 2; // ログインユーザーの役割
@isset($matter)
	@if($matter->status==3||$matter->user_id==Auth::id())
		var user_role=0;
	@endif
@endisset
var pu_role =  {{Auth::user()->permissions}} & 4;
var check_count = $('.check-opt:checked,.check-opt2:checked,.check-opt3:checked').length;
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
            if (!user_role) {
                $(this).prop('disabled', true); // ユーザー権限がない場合、未チェックのチェックボックスも無効にする
              }
        } else {
            // opt の値が 0 以外であればチェック済み
            $(this).prop('checked', true);
            if (!user_role || value != user_id) {
                $(this).prop('disabled', true); // 自分以外のチェックボックスを無効にする
              }else if(value == user_id && check_count <= 2){
            	  $('.check-opt').not(this).prop('disabled', true);
            }
        }
    });
    $('.check-opt2').each(function() {
        var opt = $(this).data('opt'); // opt1, opt2, opt3 のいずれか
        var value = $(this).data('value'); // 初期値
        if (value == 0) {
            // opt の値が 0 であれば未チェック
            $(this).prop('checked', false);

            if (!pu_role || $('.check-opt:checked').length != 2) {
                $(this).prop('disabled', true); // ユーザー権限がない場合、未チェックのチェックボックスも無効にする
              }
        } else {
            // opt の値が 0 以外であればチェック済み
            $(this).prop('checked', true);
            if (!pu_role || value != user_id) {
                $(this).prop('disabled', true); // 自分以外のチェックボックスを無効にする
              }else if(value == user_id){
            	  $('.check-opt2').not(this).prop('disabled', true);
            }
        }
    });

    var opt3 = $('.check-opt3');

        var value3 = opt3.data('value'); // 初期値
        if (value3 == 0) {
            // opt の値が 0 であれば未チェック
            opt3.prop('checked', false);

            if (!pu_role || $('.check-opt:checked').length != 2) {
            	opt3.prop('disabled', true); // ユーザー権限がない場合、未チェックのチェックボックスも無効にする
              }
        } else {
            // opt の値が 0 以外であればチェック済み
            opt3.prop('checked', true);
            if (!pu_role || value3 != user_id) {
            	opt3.prop('disabled', true); // 自分以外のチェックボックスを無効にする
              }else if(value3 == user_id){
            	  $('.check-opt').not(opt3).prop('disabled', true);
            }
        }


    // チェックボックスがクリックされたときに、承認権限を持つユーザーであれば以下の処理を行う
    $('.check-opt').click(function() {
        var opt = $(this).data('opt'); // opt1, opt2, opt3 のいずれか
        var value = $(this).data('value'); // 初期値
        var checked = $(this).prop('checked'); // チェック状態

        if (user_role) {

            // 承認権限を持つユーザーであれば
            if (checked) {

                // チェックボックスが未チェックからチェック済みになった場合
                $(this).val(user_id); // チェックボックスのvalueにユーザーIDをセットする
                $('.check-opt').not(this).attr('disabled', true);
                $(this).next('span').text(user_name);
            } else {
                // チェックボックスがチェック済みから未チェックになった場合
                $(this).val(0); // チェックボックスのvalueを初期値に戻す
                $(this).attr('data-value', '0');
                $('.check-opt[data-value="0"]').attr('disabled', false);


            }

            // ３つのチェックボックスがチェックされた場合、以降チェックボックスの操作はできないようにする
            if ($('.check-opt:checked').length == 2) {
                $('.check-opt').attr('disabled', true);
            }
        } else {
            // 承認権限を持たないユーザーであれば、チェックボックスの操作はできないようにする
            $(this).prop('checked', !checked); // チェック状態を元に戻す
            $(this).attr('disabled', true); // チェックボックスを無効化する
        }
    });
    $('.check-opt2').click(function() {
        var value = $(this).data('value'); // 初期値
        var checked = $(this).prop('checked'); // チェック状態
        if (pu_role) {
            // 承認権限を持つユーザーであれば
            if (checked) {
                // チェックボックスが未チェックからチェック済みになった場合
                $(this).val(user_id); // チェックボックスのvalueにユーザーIDをセットする
                $('.check-opt').not(this).attr('disabled', true);
                $(this).next('span').text(user_name);
            } else {
                // チェックボックスがチェック済みから未チェックになった場合
                $(this).val(0); // チェックボックスのvalueを初期値に戻す
                $(this).attr('data-value', '0');
                $('.check-opt[data-value="0"]').attr('disabled', false);


            }

            // ３つのチェックボックスがチェックされた場合、以降チェックボックスの操作はできないようにする
            if ($('.check-opt:checked').length == 2) {
                $('.check-opt').attr('disabled', true);
            }
        } else {
            // 承認権限を持たないユーザーであれば、チェックボックスの操作はできないようにする
            $(this).prop('checked', !checked); // チェック状態を元に戻す
            $(this).attr('disabled', true); // チェックボックスを無効化する
        }
    });
    @isset($matter)
    $('.check-opt,.check-opt2').change(function() {
        var hiddenInput = $(this).closest('.approval-checkboxes').find('.hidden-opt[name="' + $(this).attr('name') + '"]');
        hiddenInput.val($(this).val());
        var isChecked = $(this).prop('checked');
        var $spanElement = $(this).next('span');
        var checkid = $(this).val();

        if (!isChecked) {
            $spanElement.text('承認'); // チェックが外れた場合、spanのテキストを空にする
        }
        var name = $(this).attr('name'); // チェックボックスのname属性を取得
		//alert(name);
        $.ajax({
            method: 'POST',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRFトークンを取得してヘッダに含める
            },
            url: 'purcher_accept', // コントローラーのアクションに対応するURLを指定
            data: {
                name: name,
                matter_id: {{$matter->id}},
                user_id: checkid
            },
            success: function(response) {
                // 更新が成功したら、必要な処理をここに記述
            }
        });
    });
    @endisset

 });
</script>
</x-app-layout>
