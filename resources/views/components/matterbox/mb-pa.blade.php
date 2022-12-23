<section id="matter_area">
	<h5>{{$typename}}作業情報</h5>
	<fieldset>
		<div>
			<label class="g12">{{$typename}}予定日</label>
			<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off">
		</div>
		<div>
			<label class="g12">取得：</label>
			<div class="radio-group g23">

				<input id="st1_1" type="radio" class="st1" name="matter_type" value="1" />
				<label for="st1_1">全日</label>
				<input id="st1_2" type="radio" class="st1" name="matter_type" value="2" />
				<label for="st1_2">午前休</label>
				<input id="st1_3" type="radio" class="st1" name="matter_type" value="3" />
				<label for="st1_3">午後休</label>
				<input id="st1_4" type="radio" class="st1" name="matter_type" value="4" />
				<label for="st1_4">時間休</label>
			</div>
			<label class="g34">取得：</label>
			<div class="radio-group g45">

				<input id="st1_5" type="radio" class="st1" name="matter_type" value="5" />
				<label for="st1_5">特別</label>
				<input id="st1_6" type="radio" class="st1" name="matter_type" value="6" />
				<label for="st1_6">弔事</label>

			</div>
		</div>
		<div>
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

			<label class="g56">休憩時間</label>
			<div class="g67">
				<input type="number" name="breaktime" min="0" max="60" autocomplete="off" value="{{old('breaktime',$userdata->worktype->def_breaktime)}}">
			</div>
		</div>
		<div>
			<label class="g12">{{$typename}}時間</label> <label class="time_alert g23"></label><label class="hour3 g34">{{old('hour3',intdiv($userdata->worktype->def_allotted,60))}}時間 <input type="hidden" name="hour3" value="{{old('hour3',intdiv($userdata->worktype->def_allotted,60))}}"></label> <label class="minutes3 g45">{{$userdata->worktype->minutes}}分</label>
		</div>
		<div>

			<label class="g12" for="order_content">{{$typename}}理由 ：</label>
			<textarea class="g23" id="order_content" name="order_content" rows="2" cols="60">{{old('order_content','test')}}</textarea>
		</div>


	</fieldset>
</section>