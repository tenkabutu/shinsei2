<section id="matter_area">
			<h5>　{{$type}}作業情報</h5>
				<fieldset>
					<div>
						<label class="g12">{{$type}}予定日</label>
						<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off">
					</div>
					<div>
						<label class="g12">開始時間</label>
						<div class="g23">
						<input type="number"  name="hour1"  autocomplete="off" value="{{old('hour1',$userdata->worktype->def_hour1)}}">
						<input type="number"  name="minutes1" class="minutes1" min="0" max="59" autocomplete="off" value="{{old('minutes1',$userdata->worktype->def_minutes1)}}">
						</div>
						<label class="g34">終了時間</label>
						<div class="g45">
						<input type="number" name="hour2"  class="hour2"  autocomplete="off" value="{{old('hour2',$userdata->worktype->def_hour2)}}">
						<input type="number"  name="minutes2" min="0" max="59" autocomplete="off" value="{{old('minutes2',$userdata->worktype->def_minutes2)}}">
						</div>

						<label class="g56">休憩時間</label>
						<div class="g67">
						<input type="number"  name="breaktime" min="0" max="60" autocomplete="off" value="{{old('breaktime',$userdata->worktype->def_breaktime)}}">
						</div>
					</div>
					<div>
						<label class="g12">{{$type}}時間</label>
						<label class="time_alert g23"></label><label class="hour3 g34">{{old('hour3',intdiv($userdata->worktype->def_allotted,60))}}時間
						<input type="hidden" name="hour3" value="{{old('hour3',intdiv($userdata->worktype->def_allotted,60))}}"></label>
						<label class="minutes3 g45">{{$userdata->worktype->minutes}}分</label>
					</div>
					<div>

						<label class="g12" for="order_content">{{$type}}理由　　：</label>
						<textarea class="g23"id="order_content" name ="order_content"  rows="2" cols="60">{{old('order_content','test')}}</textarea>
					</div>
					<div>

						<label class="g12" for="work_content">予定業務内容：</label>
						<textarea class="g23"id="work_content" name ="work_content"  rows="2" cols="60">{{old('work_content')}}</textarea>
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