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

		<h3>振替申請</h3>
		@if (count($errors) > 0)
		<ul>
			@foreach($errors->all() as $err)
			<li class="text-danger">{{ $err }}</li> @endforeach
		</ul>
		@endif

		<section>
			<h5>　申請状況</h5>
			<fieldset>

				<div>
					<div class="g12"><label>振替作業時間</label></div>
					<div class="g23 text_right">9月2日：8時間</div>
				</div>
				<div>
					<div class="g12"><label>振替作業申請</label></div>
					<div class="g23 text_right">許可済み</div>
				</div>
				<div>
					<div class="g12"><label>振替休暇時間1</label></div>
					<div class="g23 text_right">10月5日：4時間</div>
				</div>
				<div>
					<div class="g12"><label>振替休暇申請1</label></div>
					<div class="g23 text_right">許可済み</div>
				</div>
				<div>
					<div class="g12"><label>振替休暇時間2</label></div>
					<div class="g23 text_right">10月5日：2時間</div>
				</div>
				<div>
					<div class="g12"><label>振替休暇申請2</label></div>
					<div class="g23 text_right">申請中</div>
				</div>
				<div>
					<div class="g12"><label>残り振替休暇時間</label></div>
					<div class="g23 text_right">2時間</div>
				</div>


			</fieldset>
			<p>申請中・申請後に設定時間を変更すると再度申請が必要になります。</p>

		</section>

		<section>
			<h5>　申請情報</h5>
			<fieldset>


				<div>
					<div class="g12"><label>申請日</label></div>
					<div class="g23 text_right">text</div>
				</div>
				<div>
					<div class="g12"><label>社員番号</label></div>
					<div class="g23 text_right">{{Auth::user()->id}}</div>
				</div>
				<div>
					<div class="g12"><label>申請者</label></div>
					<div class="g23 text_right">{{Auth::user()->name}}</div>
				</div>
				<div>
					<div class="g12"><label>所属</label></div>
					<div class="g23 text_right">{{ $user->areatag->nametag}}</div>
				</div>
			</fieldset>
		</section>
		<section>
			<h5>　通知</h5>
			<fieldset>



				<div>
					<div class="g12"><label>承認者</label></div>
					<div class="g23 text_right">水田浩子</div>
				</div>
				<div>
					<div class="g12"><label>通知先</label></div>
					<div class="g23 text_right">松金秀司</div>
				</div>

			</fieldset>
		</section>





		<form action="matter/store" method="post"  class="repeater"  onsubmit="return false;">
			@csrf
			<!-- onsubmit="return false;"  -->
			<section>
			<h5>　振替作業情報</h5>
				<fieldset>
					<div>
						<label class="g12">振替予定日</label>
						<input type="text" class="target2 g23" name="reception_date" autocomplete="off">
					</div>
					<div>
						<label class="g12">開始時間</label>
						<div class="g23">
						<input type="number"  name="hour1" autocomplete="off" value="@hour($user->worktype->setdate1)">
						<input type="number"  name="minutes1" autocomplete="off" value="@minutes($user->worktype->setdate1)">
						</div>
						<label class="g34">終了時間</label>
						<div class="g45">
						<input type="number"  name="hour2" autocomplete="off" value="@hour($user->worktype->setdate2)">
						<input type="number" readonly="readonly" name="minutes2" autocomplete="off" value="@minutes($user->worktype->setdate2)">
						</div>

						<label class="g56">休憩時間</label>
						<div class="g67">
						<input type="number"  name="break" autocomplete="off" value="{{$user->worktype->break}}">

						</div>
					</div>
					<div>
						<label class="g12">振替時間</label>
						<label class="time_alert g23"></label><label class="hour3 g34">{{$user->worktype->hours}}時間</label>
						<label class="minutes3 g45">{{$user->worktype->minutes}}分</label>
					</div>
					<div>

						<label class="g12" for="order_content">振替理由　　：</label>
						<textarea class="g23"id="order_content" name ="order_content"  rows="3" cols="60"></textarea>
					</div>

					<div>

						<label class="g12" for="order_content">予定業務内容：</label>
						<textarea class="g23"id="order_content" name ="order_content"  rows="3" cols="60"></textarea>
					</div>
					<!-- <div>
						<div class="grid_wide">
							<label for="device_model">オプション1</label>
							<input id="device_model" name="etc1" type="hidden" value="null">
							<input id="device_model" name="etc1" type="checkbox" value="1"
							 @if(old('etc1')) checked="checked"@else @endif />
							<label for="device_model">　オプション2</label>
							<input id="device_model" name="etc2" type="hidden" value="null">
							<input id="device_model" name="etc2" type="checkbox" value="1"
							 @if(old('etc2')) checked="checked"@else @endif />
							<label for="device_model">　オプション3</label>
							<input id="device_model" name="etc3" type="hidden" value="null">
							<input id="device_model" name="etc3" type="checkbox" value="1"
							 @if(old('etc3'))checked="checked"@else @endif />
							 <label for="device_model">　オプション4</label>
							<input id="device_model" name="etc4" type="hidden" value="null">
							<input id="device_model" name="etc4" type="checkbox" value="1"
							 @if(old('etc4'))checked="checked"@else @endif />
						</div>
					</div> -->
				</fieldset>
			</section>
			<section>
			<h5>　振替休暇情報</h5>

				<fieldset>
					<div data-repeater-list>
						<div data-repeater-item>
							<div class="grid">
								<label class="g12">振替予定日</label>
								<input type="text" class="g23 target2" name="reception_date" autocomplete="off">
							</div>
							<div class="grid">
								<label class="g12">開始時間</label>
								<div class="g23">
									<input type="number" name="hour4" autocomplete="off">
									<input type="number" name="minutes4" autocomplete="off">
								</div>
								<label class="g34">終了時間</label>
								<div class="g45">
									<input type="number" name="hour5" autocomplete="off">
									<input type="number" readonly="readonly" name="minutes5" autocomplete="off">
								</div>

								<label class="g56">休憩時間</label>
								<div class="g67">
									<input type="number" name="break" autocomplete="off">
								</div>
							</div>
							<div class="grid">
								<label class="g12">振替時間</label> <label class="time_alert g23"></label><label class="hour6 g34"></label><label class="minutes6 g45"></label>

							</div>

						</div>
					</div>
					<div>

						<div class="g23 text_right">
							<button data-repeater-create>＋</button>
						</div>
					</div>
					<div>
						<label class="g12">合計振替休暇時間</label>
						<div class="g23 text_right">○時間</div>
					</div>
				</fieldset>

			</section>
			<section>

				<fieldset>
					<div>
						<button class="g12">保存</button>
						<button class="g23">保存&申請</button>
					</div>

				</fieldset>
			</section>
		</form>


</div>
	</div>


<script>

$(function(){
	$('.repeater').repeater({hide: function (deleteElement) {
	      if(confirm('削除してもいいですか？')) {
	          $(this).slideUp(deleteElement);
	        }
	      }});

	$('input[type="number"]').bind('input', function () {
		var h1 = $('input[name="hour1"]').val()- 0;
		var h2 = $('input[name="hour2"]').val()- 0;
		var m1 = $('input[name="minutes1"]').val()- 0;
		var m2 = $('input[name="minutes2"]').val()- 0;
		var bt = $('input[name="break"]').val()- 0;
		var mt = ((h2*60+m2)-(h1*60+m1))-bt;

		var wt = Math.floor(mt/60);
		var lt = mt%60;

		$('label.hour3').text(wt+'時間');
		$('label.minutes3').text(lt+'分');
		if(wt>{{$user->worktype->hours}}){
			$('label.time_alert').text('設定時間オーバー');
		}else if(wt=={{$user->worktype->hours}}&&lt>{{$user->worktype->minutes}}){
			$('label.time_alert').text('設定時間オーバー');
		}else{
			$('label.time_alert').text('');
			}



	});

 });
</script>
</x-app-layout>
