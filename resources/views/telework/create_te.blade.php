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
		<h3>テレワーク申請<label>　(作成:{{$matter->created_at->format('Y/n/j')}}　更新:{{$matter->updated_at->format('Y/n/j')}})</label></h3>

			<x-change-status :matter="$matter" :type="3"/>
				<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist" :mcheck="1"/>
		@else
		<h3>新規テレワーク申請</h3>
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
		<x-save-box :status="$matter->status" :role="0" :type="3"/>
		@endif
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="matter_type" value="3">

			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="allotted" value="{{old('allotted',$matter->allotted)}}">
				@if (session('save_check'))
				<input type="hidden" name="change_check" value="1">
				@else
				<input type="hidden" name="change_check" value="{{old('change_check',$matter->status)}}">
				@endif
				<x-matter-rewrite-box :userdata="$user" type="3" :matter="$matter"/>

				@if($matter->status==5 && isset($matter->reject_content))
				<fieldset>
				<label class="text-danger">修正願い：{{$matter->reject_content}}</label>
				</fieldset><br>
				@endif
			@else
				<input type="hidden" name="allotted" value="{{old('allotted',$user->worktype->def_allotted)}}">
				<x-matter-box :userdata="$user" type="3"/>
			@endif



			@if(session('delete_check'))
				<input type="hidden" name="delete_check" value="{{old('delete_check')}}">
    			<div class="alert alert-danger">{{ session('delete_check') }}</div>
				<x-save-box :status="7" :role="0" :type="3"/>
			@elseif(isset($matter))
				@if($matter->user_id==Auth::user()->id)
					<x-save-box :status="$matter->status" :role="0" :type="3"/>
				@elseif(Auth::user()->role<3)
					<x-save-box :status="$matter->status" :role="1" :type="3"/>
				@elseif(Auth::user()->role==4)
					<x-save-box :status="$matter->status" :role="4" :type="3"/>

				@else
				<!-- <label>test</label> -->
				@endif
			@else
			<x-save-box :status="0" :role="0" :type="3"/>
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
