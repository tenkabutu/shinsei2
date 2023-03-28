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
		<h3>休暇申請<label>　(作成:{{$matter->created_at->format('Y/n/j')}}　更新:{{$matter->updated_at->format('Y/n/j')}})</label></h3>

			<x-change-status :matter="$matter" :type="2"/>
		@else
		<h3>新規休暇申請</h3>
		@endif
			<ul>
				@foreach($errors->all() as $err)
				<li class="text-danger">{{ $err }}</li> @endforeach
			</ul>
		<x-user-box :userdata="$user" :checker="$check_userlist"/>
		<form  method="post" action="" class="repeater"  >
			@csrf
			@if (session('save_check'))
    	<div class="alert alert-danger">{{ session('save_check') }}</div>
		<x-save-box :status="$matter->status" :role="0" :type="2"/>
		@endif
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="matter_type" value="2">

			<!-- onsubmit="return false;"  -->
			@if(isset($matter))
				<input type="hidden" name="allotted" value="{{old('allotted',$matter->allotted)}}">
				<input type="hidden" name="change_check" value="{{old('change_check',$matter->status)}}">
				<x-matter-rewrite-box :userdata="$user" :type="2" :matter="$matter"/>
			@else
				<input type="hidden" name="allotted" value="{{old('allotted',$user->worktype->def_allotted)}}">
				<x-matter-box :userdata="$user" type="2"/>
			@endif

			@if(isset($matter))
				@if($matter->user_id==Auth::user()->id)
					<x-save-box :status="$matter->status" :role="0" :type="2"/>
				@elseif(Auth::user()->role==1)
					<x-save-box :status="$matter->status" :role="1" :type="2"/>

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
		if($(this).prev().val()!=4){
	        $('.matter_date input').attr('readonly',true);
	        $('.matter_date input').css('backgroundColor','#e9e9e9');
	        if($(this).prev().val()==1){
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

 });
</script>
</x-app-layout>
