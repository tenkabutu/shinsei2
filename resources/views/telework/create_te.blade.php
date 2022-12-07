<x-app-layout>
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
		<h3>振替申請<label>　(作成:{{$matter->created_at->format('Y/n/j')}}　更新:{{$matter->updated_at->format('Y/n/j')}})</label></h3>

			<x-change-status :matter="$matter" />
		@else
		<h3>新規振替申請</h3>
		@endif
			<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist"/>
		<form  method="post" action="save_ov" class="repeater"  >
			@csrf
			@if (session('save_check'))
    	<div class="alert alert-danger">{{ session('save_check') }}</div>
		<x-save-box :status="$matter->status" :role="0"/>
		@endif
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="matter_type" value="1">

			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="allotted" value="{{old('allotted',$matter->allotted)}}">
				<input type="hidden" name="change_check" value="{{old('change_check',$matter->status)}}">
				<input type="hidden" name="change_check2" value="{{old('change_check2',1)}}">
				<x-matter-rewrite-box :userdata="$user" :matter="$matter"/>
			@else
				<input type="hidden" name="allotted" value="{{old('allotted',$user->worktype->def_allotted)}}">
				<x-matter-box :userdata="$user"/>
			@endif

			@if(isset($matter))
				@if($matter->user_id==Auth::user()->id)
					<x-save-box :status="$matter->status" :role="0"/>
				@elseif(Auth::user()->role==1)
					<x-save-box :status="$matter->status" :role="1"/>

				@else
				<!-- <label>test</label> -->
				@endif
			@else
			<x-save-box :status="0" :role="0"/>
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
	$('.repeater').repeater({hide: function (deleteElement) {
	      if(confirm('削除してもいいですか？')) {
	          $(this).slideUp(deleteElement);
	        }
	}});


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
	$('#task_area input[type="number"]').bind('input', function () {
		var tf = $(this).closest('.task_form');
		tf.css('color', 'red');

		var th1 = tf.find('.task_hour1').val()- 0;

		var th2 = tf.find('.task_hour2').val()- 0;
		var tm1 = tf.find('.task_minutes1').val()- 0;
		var tm2 = tf.find('.task_minutes2').val()- 0;
		//var mdf1 =$('.mdef1').val()-0;
		//$('.mdef1').text(m1);
		//if(m1<30){
		//	$('.mdef2').text(m1+30);
		//}else{
		//	$('.mdef2').text(m1-30);
		//}
		//var m2 = $('select.minutes2').val()- 0;
		var tbt = tf.find('.task_break').val()- 0;
		var tmt = ((th2*60+tm2)-(th1*60+tm1))-tbt;
		//alert(tmt);
		var twt = Math.floor(tmt/60);
		var tlt = tmt%60;
		/* if(wt>4){
			$('input[name="breaktime"]').val('60');
			mt = ((h2*60+m2)-(h1*60+m1))-60;
			wt = Math.floor(mt/60);
			lt = mt%60;
		} */
		tf.find('.task_hour3').text(twt+'時間');
		tf.find('.task_minutes3').text(tlt+'分');
		tf.find('.task_allotted').val(tmt);
		var tt=0;
		$('.task_allotted').each(function(){
			tt+=$(this).val()-0;
			});
		$('.task_total').text(Math.floor(tt/60)+'時間'+tt%60+'分');

		if(tt>{{$user->worktype->def_allotted}}){
			$('label.task_time_alert').text('基本勤務時間オーバー');
		}else if(tt>$('input[name="allotted"]').val()){
			$('label.task_time_alert').text('振替勤務時間オーバー');
		}
		else{
			$('label.task_time_alert').text('');
		}
	});
 });
</script>
</x-app-layout>
