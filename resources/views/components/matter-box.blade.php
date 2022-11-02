<section id="matter_area">
			<h5>　振替作業情報</h5>
				<fieldset>
					<div>
						<label class="g12">振替予定日</label>
						<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off">
					</div>
					<div>
						<label class="g12">開始時間</label>
						<div class="g23">
						<input type="number"  name="hour1"  autocomplete="off" value="@hour($userdata->worktype->setdate1)">
						<input type="number"  name="minutes1" class="minutes1" min="0" max="59" autocomplete="off" value="@minutes($userdata->worktype->setdate1)">
						</div>
						<label class="g34">終了時間</label>
						<div class="g45">
						<input type="number" name="hour2"  class="hour2"  autocomplete="off" value="@hour($userdata->worktype->setdate2)">
						<input type="number"  name="minutes2" min="0" max="59" autocomplete="off" value="{{$userdata->worktype->minutes}}">
						</div>

						<label class="g56">休憩時間</label>
						<div class="g67">
						<input type="number"  name="breaktime" min="0" max="60" autocomplete="off" value="{{$userdata->worktype->break}}">

						</div>
					</div>
					<div>
						<label class="g12">振替時間</label>
						<label class="time_alert g23"></label><label class="hour3 g34">{{$userdata->worktype->hours}}時間</label>
						<label class="minutes3 g45">{{$userdata->worktype->minutes}}分</label>
					</div>
					<div>

						<label class="g12" for="order_content">振替理由　　：</label>
						<textarea class="g23"id="order_content" name ="order_content"  rows="3" cols="60">test</textarea>
					</div>

					<div>

						<label class="g12" for="work_content">予定業務内容：</label>
						<textarea class="g23"id="work_content" name ="work_content"  rows="3" cols="60"></textarea>
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