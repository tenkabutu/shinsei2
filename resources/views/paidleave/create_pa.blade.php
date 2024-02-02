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


<script>
function setAction(url) {
    $('form').attr('action', url);

    $('form').submit();
}
$(function(){

	@if (!isset($residue_rest_day))
		 $('#st1_1_label,#st1_2_label,#st1_3_label').click(function(event) {
	        event.preventDefault();
	    });

	@elseif ($residue_rest_day == 0)
	$('#st1_1_label').click(function(event) {
	   event.preventDefault();
	});
	@elseif ($residue_rest_day <1)
	$('#st1_1_label,#st1_2_label,#st1_3_label').click(function(event) {
	        event.preventDefault();
	    });

	@endif

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
	var labelsSelector;

	@php
    $labelSelector = '';
    if($userdata->rest){
    if ($residue_rest_day == 0) {
        $labelSelector = '"label:not(#st1_1_label, #st1_2_label, #st1_3_label)"';
    } elseif ($residue_rest_day < 1) {
        $labelSelector = '"label:not(#st1_1_label)"';
    } else {
        $labelSelector = '"label"';
    }
    }else{
    	$labelSelector = '"label:not(#st1_1_label, #st1_2_label, #st1_3_label)"';
        }
    @endphp

var labelsSelector = {!! $labelSelector !!};
	$(labelsSelector, radio).click(function() {
		var cr =$(this).prev().val();
		if($(this).prev().val()!=4&&$(this).prev().val()<10){
	        $('.matter_date input').attr('readonly',true);
	        $('.matter_date input').css('backgroundColor','#e9e9e9');
	        if($(this).prev().val()==1||cr==5||cr==6||cr==9){
	        	$('input[name="hour1"]').val({{$user->worktype->def_hour1}});
	        	$('input[name="hour2"]').val({{$user->worktype->def_hour2}});
	        	$('input[name="minutes1"]').val({{$user->worktype->def_minutes1}});
	        	$('input[name="minutes2"]').val({{$user->worktype->def_minutes2}});
	        	$('input[name="breaktime"]').val('60');
		    }else if($(this).prev().val()==2){
			    var h2={{$user->worktype->def_hour1+intdiv(($user->worktype->def_allotted/2+$user->worktype->def_minutes1),60)}};
		    	var m2={{($user->worktype->def_allotted/2+$user->worktype->def_minutes1)%60}};

		    	$('input[name="hour1"]').val({{$user->worktype->def_hour1}});
	        	$('input[name="hour2"]').val(h2);
	        	$('input[name="minutes1"]').val({{$user->worktype->def_minutes1}});
	        	$('input[name="minutes2"]').val(m2);
	        	$('input[name="breaktime"]').val('0');
	        	$('.mol_2').text('出勤')
		    }else if($(this).prev().val()==3){
			    var h1={{$user->worktype->def_hour1+intdiv(($user->worktype->def_allotted/2+$user->worktype->def_minutes1),60)+1}};
		    	var m1={{($user->worktype->def_allotted/2+$user->worktype->def_minutes1)%60}};
		    	$('input[name="hour1"]').val(h1);
	        	$('input[name="hour2"]').val({{$user->worktype->def_hour2}});
	        	$('input[name="minutes1"]').val(m1);
	        	$('input[name="minutes2"]').val({{$user->worktype->def_minutes2}});
	        	$('input[name="breaktime"]').val('0');
	        	$('.mol_2').text('出勤')

			    }
	    }else{
	    	$('.matter_date input').attr('readonly',false);
	        $('.matter_date input').css('backgroundColor','#fff');
		};
	    $(this).parent().parent().each(function() {
	        $('label',this).removeClass('checked');
	    });
	    $(this).addClass('checked');







	    var h1 = $('input[name="hour1"]').val()- 0;
		var h2 = $('input[name="hour2"]').val()- 0;
		var m1 = $('input[name="minutes1"]').val()- 0;

		var m2 = $('input[name="minutes2"]').val()- 0;
		var bt = $('input[name="breaktime"]').val()- 0;
		var mt = ((h2*60+m2)-(h1*60+m1))-bt;
		//alert(m2);
		var wt = Math.floor(mt/60);
		var lt = mt%60;
		if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		}
		$('label.hour3').text(wt+'時間');
		$('input[name="hour3"]').val(wt);
		$('label.minutes3').text(lt+'分');
		$('input[name="allotted"]').val(mt);
	  ////  if($(this).parent().hasClass('index_select')){
	    //	alert($('input[name="index50"]:checked').val());
	    //    }
	});



	$('#matter_area input[type="number"]').bind('input', function () {
		var h1 = $('input[name="hour1"]').val()- 0;
		var h2 = $('input[name="hour2"]').val()- 0;
		var m1 = $('input[name="minutes1"]').val()- 0;

		var m2 = $('input[name="minutes2"]').val()- 0;
		var bt = $('input[name="breaktime"]').val()- 0;
		var mt = ((h2*60+m2)-(h1*60+m1))-bt;
		//alert(m2);
		var wt = Math.floor(mt/60);
		var lt = mt%60;
		if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		}
		$('label.hour3').text(wt+'時間');
		$('input[name="hour3"]').val(wt);
		$('label.minutes3').text(lt+'分');
		$('input[name="allotted"]').val(mt);
		//$('input[name="starttime"]').val(h1+":"+m1+":00");
		//$('input[name="endtime"]').val(h2+":"+m2+":00");
		if(mt>{{$user->worktype->def_allotted}}){
			$('label.time_alert').text('設定時間オーバー');
		}else{
			$('label.time_alert').text('');
		}
	});
	@empty($matter)
	$('.proxy_check').click(function() {

		$('.proxy_user').html('<select class="select_proxy"><option>---</option>{!!$userlist!!}</select')
		$('#matter_area').append('<input type="hidden" name="proxy_id" value="'+{{Auth::user()->id}}+'">')
		$('.select_proxy').change(function(){
			$('input[name="user_id"]').val($(this).val());
			});


		});
	@endisset

 });
</script>
</x-app-layout>
