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
	   $('.target').datetimepicker({
		   minDate: new Date(new Date().setFullYear(new Date().getFullYear() - 1)),
		   scrollMonth : false,
		   scrollInput : false}).datepicker('setDate','today');

	  $('.target2').datetimepicker({
		  minDate: new Date(new Date().setFullYear(new Date().getFullYear() - 1)),
		  scrollMonth : false,
		  scrollInput : false,
		  timepicker:false,
	      format:'Y/n/j'
		});
	  $('.target3').datetimepicker({
		  minDate: new Date(new Date().setFullYear(new Date().getFullYear() - 1)),
		  scrollMonth : false,
		  scrollInput : false,
		  format:'h:m'
		});
	});
	</script>
	<style>
.radio-group input:disabled + label {
    background-color: #ddd !important;
    color: #999;
    cursor: not-allowed;
}
</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
</x-slot>

<div class="main_right">
	<div id="shinsei_wrap">

		@if(isset($matter->status))
		<h3>休暇申請<label>　(作成:{{$matter->created_at->format('Y/n/j')}}　更新:{{$matter->updated_at->format('Y/n/j')}})</label></h3>

			<x-change-status :matter="$matter" :type="2"/>
			<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist" :mcheck="1"/>
		@else
		<h3>新規休暇申請</h3>
		<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist" :mcheck="2"/>
		@endif

		<form  method="post" action="" class="repeater"  >
			@csrf
			@if (session('save_check'))
    	<div class="alert text-danger">{{ session('save_check') }}</div>
		<x-save-box :status="$matter->status" :role="0" :type="2"/>
		@endif
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="matter_type" value="2">

			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="allotted" value="{{old('allotted',$matter->allotted)}}">
				@if (session('save_check'))
				<input type="hidden" name="change_check" value="1">
				@else
				<input type="hidden" name="change_check" value="{{old('change_check',$matter->status)}}">
				@endif
				<x-matter-rewrite-box :userdata="$user" :type="2" :matter="$matter"/>
				@if($matter->status==5 && isset($matter->reject_content))
				<fieldset>
				<label class="text-danger">修正願い：{{$matter->reject_content}}</label>
				</fieldset><br>
				@endif
			@else
				<input type="hidden" name="allotted" value="{{old('allotted',$user->worktype->def_allotted)}}">
				<x-matter-box :userdata="$user" :type="2"/>
			@endif

			@if(session('delete_check'))
				<input type="hidden" name="delete_check" value="{{old('delete_check')}}">
    			<div class="alert alert-danger">{{ session('delete_check') }}</div>
				<x-save-box :status="7" :role="0" :type="2"/>
			@elseif(isset($matter))
				@if($matter->user_id==Auth::user()->id)
					<x-save-box :status="$matter->status" :role="0" :type="2" :checker="$matter->opt2"/>
				@elseif(Auth::user()->role<3)
					<x-save-box :status="$matter->status" :role="1" :type="2" :checker="$matter->opt2"/>
				@elseif(Auth::user()->role==4)
					<x-save-box :status="$matter->status" :role="4" :type="2" :checker="$matter->opt2"/>
				@else
				<!-- <label>test</label> -->
				@endif
			@else
			<x-save-box :status="0" :role="0" :type="2"/>
			@endif
			<p><strong>休暇の申請と合わせて、サイボウズへの予定入力もお願いします。</strong></p>
			<p>
				<strong>＜種別１の説明＞</strong>

			<ul>
				<li><strong>変更：</strong>上長の許諾の上で基本の勤務時間とは異なる時間で勤務する人が半休を取得する場合に指定してください。午前休を押したときに表示される休暇時間と同じであることを確認してください。</li>

			</ul>
			</p>
			<p>
				<strong>＜種別２の説明＞</strong>

			<ul>
				<li><strong>特別：</strong>会社が指定する休暇</li>
				<li><strong>慶弔：</strong>忌引き（日数は就業規則参照）・結婚休暇（5日）
					<ul>
						<li>分割せず土日を含んで連続して取得</li>
					</ul></li>
				<li><strong>忌引き：</strong>葬儀を執り行ったことを証明するような書類（会葬礼状等）を提出ください。また、余白に「続柄」の記入をお願いします。</li>
				<li><strong>結婚休暇：</strong>入籍日もしくは結婚式の日から6か月以内に取得
					<ul>
						<li>休暇理由欄に入籍日もしくは結婚式の日を記入ください。</li>
					</ul></li>
			</ul>
			</p>

		</form>
	</div>
</div>

<div id="modal_kekkin" class="detail_modal">
    <div class="modal_content">
        <h4>欠勤（遅刻・早退）</h4>
        <p>
            有給休暇の残数がない（または付与前）の社員が、私用や体調不良等により勤務できない場合は、以下の扱いとなります。
        </p>

        <ul>
            <li><strong>[全日欠勤]：</strong>終日勤務できない場合</li>
            <li><strong>[遅刻]・[早退]：</strong>業務の開始時間に遅れる、または終了時間前に退勤する場合</li>
            <li>
                <strong>[時間欠勤]：</strong>
                時間欠勤の前後に就労しないため、遅刻・早退扱いにならない場合に限定
                <br>
                時間単位の有給休暇、または振替休暇と組み合わせて取得する場合に使用
            </li>
        </ul>

        <br>
        <button type="button" class="close_modal">閉じる</button>
    </div>
</div>

<!-- モーダル② -->
<div id="modal_special" class="detail_modal">
    <div class="modal_content">
         <h4>特別休暇・その他</h4>
        <p>申請前に自治体管理者およびエリアマネージャに了承を得てください。</p>

        <ul>
            <li><strong>［特別］：</strong>会社が個別に指定する休暇</li>

            <li>
                <strong>［慶弔］：</strong>分割せず、土日・休日を含めて連続して取得します。
                <ul>
                    <li>（忌引き）：日数は就業規則を参照</li>
                    <li>休暇理由欄に「続柄」を記入し、後日、会葬礼状等の証明書類を提出してください。</li>
                    <li>（結婚休暇）：入社半年以上経過した社員が対象。入籍日から6か月以内に取得し、休暇理由欄に入籍日を記入してください。</li>
                </ul>
            </li>

            <li><strong>［子の看護等］：</strong>小学3年生までの子の看病、世話、式典参加（入園・卒園・入学式）</li>

            <li><strong>［介護］：</strong>要介護状態にある家族の介護、世話</li>
        </ul>

        <ul>
            <li>子の看護等休暇・介護休暇は無給</li>
            <li>日数：対象家族1名につき年5日（2名以上の場合は年10日まで）</li>
            <li>単位：1日または時間単位で取得（時間単位は所定労働時間に準ず）</li>
            <li>必要書類：この申請とは別に「休暇申出書」および「証明書類」の提出が必要</li>
        </ul>
        <br>
        <button type="button" class="close_modal">閉じる</button>
    </div>
</div>
<script>

function setAction(url) {
    $('form').attr('action', url);
    $('form').submit();
}

$(function(){
	const remainDay = {{ $residue_rest_day ?? 0 }};
	let proxyMode = false;

	const remainHour =
	@if(in_array($userdata->worktype->id,[8,9]))
	    {{ (6-(($used_rest_time ?? 0)-optional($userdata->rest)->co_time)%6)%6 }}
	@else
	    {{ (8-(($used_rest_time ?? 0)-optional($userdata->rest)->co_time)%8)%8 }}
	@endif;

	const remainTotal =
	@if(in_array($userdata->worktype->id,[8,9]))
	    {{ 30 - ($used_rest_time ?? 0) }}
	@else
	    {{ 40 - ($used_rest_time ?? 0) }}
	@endif;

	const workDayHours =
	@if(in_array($userdata->worktype->id,[8,9]))
	    6
	@else
	    8
	@endif;

	function lockSubmit(){
	    $('.lock_target').prop('disabled', true);
	}

	function unlockSubmit(){
	    $('.lock_target').prop('disabled', false);
	}
	function checkTimeLimit(){

	    var opt = $('.st1:checked').val();

	    if(opt != 4){
	        unlockSubmit();
	        return;
	    }

	    var h1 = Number($('input[name="hour1"]').val());
	    var h2 = Number($('input[name="hour2"]').val());
	    var m1 = Number($('input[name="minutes1"]').val());
	    var m2 = Number($('input[name="minutes2"]').val());
	    var bt = Number($('input[name="breaktime"]').val());

	    var mt = ((h2*60+m2)-(h1*60+m1))-bt;

	    if(mt < 0){ mt = 0; }

	    var hours = mt/60;

	    var limit;

	    if(remainDay >= 1){
	        limit = Math.min(workDayHours, remainTotal);
	    }else{
	        limit = Math.min(remainHour, remainTotal);
	    }

	    if(hours > limit){
	        lockSubmit();
	    }else{
	        unlockSubmit();
	    }

	}

	var radio = $('div.radio-group');

	$('input', radio)
	.css({'opacity': '0'})
	.each(function(){

	    if ($(this).prop('checked')) {

	        $(this).next().addClass('checked');

	        if($(this).val()!=4 && $(this).val()!=12){
	            $('.matter_date input').prop('readonly',true)
	            .css('backgroundColor','#e9e9e9');
	        }

	    }

	});

	$('.open_detail').click(function(){
	    $('.modal_detail').fadeIn();
	});

	$('.close_modal').click(function(){
	    $('.modal_detail').fadeOut();
	});
/* ===============================
   ■ ① ラジオ選択制御ブロック
================================= */

$('.st1').on('change', function() {

    if ($(this).prop('disabled')) {
        return false;
    }

    var cr = parseInt($(this).val());

    // checked表示制御
    $('.radio-group label').removeClass('checked');
    $('label[for="' + $(this).attr('id') + '"]').addClass('checked');

    /* ===== 時間入力制御 ===== */

    if(cr != 4 && cr < 10){

    	if(!proxyMode){
    	    $('.matter_date input').prop('readonly', true)
    	                           .css('backgroundColor','#e9e9e9');
    	}

        // 全日・特別・慶弔・欠勤
        if(cr==1 || cr==5 || cr==6 || cr==9){

            $('input[name="hour1"]').val({{$user->worktype->def_hour1}});
            $('input[name="hour2"]').val({{$user->worktype->def_hour2}});
            $('input[name="minutes1"]').val({{$user->worktype->def_minutes1}});
            $('input[name="minutes2"]').val({{$user->worktype->def_minutes2}});
            $('input[name="breaktime"]').val({{$userdata->worktype->def_breaktime}});

        }
        // 午前休
        else if(cr==2){
            var h2={{$user->worktype->def_hour1+intdiv(($user->worktype->def_allotted/2+$user->worktype->def_minutes1),60)}};
            var m2={{($user->worktype->def_allotted/2+$user->worktype->def_minutes1)%60}};
            $('input[name="hour1"]').val({{$user->worktype->def_hour1}});
            $('input[name="hour2"]').val(h2);
            $('input[name="minutes1"]').val({{$user->worktype->def_minutes1}});
            $('input[name="minutes2"]').val(m2);
            $('input[name="breaktime"]').val(0);
        }
        // 午後休
        else if(cr==3){
        	var half={{$user->worktype->def_allotted/2+$user->worktype->def_minutes1}};
            var breaktime={{$user->worktype->def_breaktime}};
            var total=half+breaktime;
            var h1={{$user->worktype->def_hour1}} + Math.floor(total/60);
            var m1=total%60;
            $('input[name="hour1"]').val(h1);
            $('input[name="hour2"]').val({{$user->worktype->def_hour2}});
            $('input[name="minutes1"]').val(m1);
            $('input[name="minutes2"]').val({{$user->worktype->def_minutes2}});
            $('input[name="breaktime"]').val(0);
        }
    }
    // 変更
    else if(cr==12){
        $('input[name="hour1"],input[name="hour2"],input[name="minutes1"],input[name="minutes2"],input[name="breaktime"]').val(0);
        $('.matter_date input').prop('readonly', false).css('backgroundColor','#fff');
    }
    // 時間休
    else if(cr==4){
        $('.matter_date input').prop('readonly', false).css('backgroundColor','#fff');
        $('input[name="breaktime"]').val(0);
    }else{
        $('.matter_date input').prop('readonly', false).css('backgroundColor','#fff');
    }

    calculateTime();
    checkTimeLimit();
});


/* ===============================
   ■ ② 数値変更ブロック
================================= */

$('#matter_area input[type="number"]').on('input', function(){
    calculateTime();
    checkTimeLimit();
});


/* ===============================
   ■ ③ 時間計算ブロック
================================= */

function calculateTime(){

    var h1 = Number($('input[name="hour1"]').val());
    var h2 = Number($('input[name="hour2"]').val());
    var m1 = Number($('input[name="minutes1"]').val());
    var m2 = Number($('input[name="minutes2"]').val());
    var bt = Number($('input[name="breaktime"]').val());

    var mt = ((h2*60+m2)-(h1*60+m1))-bt;

    if(mt < 0){ mt = 0; }

    var wt = Math.floor(mt/60);
    var lt = mt%60;

    $('label.hour3').text(wt+'時間');
    $('input[name="hour3"]').val(wt);
    $('label.minutes3').text(lt+'分');
    $('input[name="allotted"]').val(mt);

    if(mt > {{$user->worktype->def_allotted}}){
        $('label.time_alert').text('設定時間オーバー');
    }else{
        $('label.time_alert').text('');
    }
}


/* ===============================
   ■ 初期計算
================================= */
calculateTime();
checkTimeLimit();
@empty($matter)
$('.proxy_check').click(function() {
	proxyMode = true;
	$('.proxy_user').html('<select class="select_proxy"><option>---</option>{!!$userlist!!}</select')
	$('#matter_area').append('<input type="hidden" name="proxy_id" value="'+{{Auth::user()->id}}+'">')
	$('.select_proxy').change(function(){
		$('input[name="user_id"]').val($(this).val());
		});


	});
@endisset
/*モーダル*/
$('.open_detail').on('click', function(){
    const target = $(this).data('target');
    $('#' + target).fadeIn();
});

$('.close_modal').on('click', function(){
    $(this).closest('.detail_modal').fadeOut();
});

$('.detail_modal').on('click', function(e){
    if(e.target === this){
        $(this).fadeOut();
    }
});
});
</script>
</x-app-layout>
