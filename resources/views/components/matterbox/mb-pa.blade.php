<section id="matter_area">
	<h5>{{$typename}}情報</h5>
	<fieldset>
		<div>
			<label class="g12">{{$typename}}予定日</label>
			<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off">
		</div>
		<div>
			<label class="g12">取得1：</label>

			<div class="radio-group g23">

				<input id="st1_1" type="radio" class="st1" name="opt1" value="1" {{old('opt1')=='1' ? 'checked':''}} />
				<label for="st1_1">全日</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="2" {{old('opt1')=='2' ? 'checked':''}}/>
				<label for="st1_2">午前休</label>
				<input id="st1_3" type="radio" class="st1" name="opt1" value="3" {{old('opt1')=='3' ? 'checked':''}}/>
				<label for="st1_3">午後休</label>
				<input id="st1_4" type="radio" class="st1" name="opt1" value="4" {{old('opt1')=='4' ? 'checked':''}}/>
				<label for="st1_4">時間休</label>
			</div>
			<label class="g34">取得2：</label>
			<div class="radio-group g45">

				<input id="st1_5" type="radio" class="st1" name="opt1" value="5" {{old('opt1')=='5' ? 'checked':''}}/>
				<label for="st1_5">特別</label>
				<input id="st1_6" type="radio" class="st1" name="opt1" value="6" {{old('opt1')=='6' ? 'checked':''}}/>
				<label for="st1_6">慶弔</label>

			</div>
		</div>
		<div class="matter_date">
			<label class="g12">開始時間</label>
			<div class="g23">
				<input type="number" name="hour1" autocomplete="off" value="{{old('hour1',$userdata->worktype->def_hour1)}}">
				<input type="number" name="minutes1" class="minutes1" min="0" max="59" autocomplete="off" value="{{old('minutes1',$userdata->worktype->def_minutes1)}}">
			</div>
			<label class="g34">終了時間</label>
			<div class="g45">
				<input type="number" name="hour2" class="hour2" autocomplete="off" value="{{old('hour2',$userdata->worktype->def_hour2)}}">
				<input type="number" name="minutes2" min="0" max="59" autocomplete="off" value="{{old('minutes2',$userdata->worktype->def_minutes2)}}">
			</div>
			<div class="g57 grid matter_opt1 mo1_1">
			<label class="g12">休憩時間</label>
			<div class="g23">
				<input type="number" name="breaktime" min="0" max="60" autocomplete="off" value="{{old('breaktime',$userdata->worktype->def_breaktime)}}">
			</div>
			</div>
			<!-- <div class="g57 grid matter_opt1 mo1_2">
			 ※出勤時間は</div> -->
		</div>
		<div>
			<label class="g12">{{$typename}}時間</label> <label class="time_alert g23"></label><label class="hour3 g34">{{old('hour3',intdiv($userdata->worktype->def_allotted,60))}}時間 <input type="hidden" name="hour3" value="{{old('hour3',intdiv($userdata->worktype->def_allotted,60))}}"></label> <label class="minutes3 g45">{{$userdata->worktype->minutes}}分</label>
		</div>
		<div>

			<label class="g12" for="order_content">{{$typename}}理由 ：</label>
			<textarea class="g23" id="order_content" name="order_content" rows="2" cols="60">{{old('order_content')}}</textarea>
		</div>


	</fieldset>
	<p>取得1はリーダーに、取得2はリーダー及び水田に事前に電話で了解を取ってください。</p>
</section>