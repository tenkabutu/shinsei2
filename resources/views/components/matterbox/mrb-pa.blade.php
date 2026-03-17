<section id="matter_area">
	<h5>休暇情報</h5>
	<fieldset>
		<div>
			<label class="g12">休暇予定日</label>
			<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off" value="{{old('matter_change_date',substr($matter->matter_change_date,0,10))}}">
		</div>
		<div class="select_type">
			<label class="g12">有給休暇</label>
			@isset($userdata->rest)
			<div class="radio-group g23">
				@php
					$disabledAll  = (!isset($residue_rest_day) || $residue_rest_day < 1);
					$disabledHalf = (!isset($residue_rest_day) || $residue_rest_day < 0.5);
					$dayHours = in_array($userdata->worktype->id, [8,9]) ? 6 : 8;
					$remainHour = ($dayHours - ($used_rest_time - $userdata->rest->co_time) % $dayHours) % $dayHours;
					$monthRemain = in_array($userdata->worktype->id, [8,9]) ? 30 - $used_rest_time : 40 - $used_rest_time;
					$canTime =($residue_rest_day >= 1 || $remainHour > 0) && ($monthRemain > 0);
					$disabledTime = !$canTime;
					$currentOpt = old('opt1',$matter->opt1);
				@endphp
				<input id="st1_1" type="radio" class="st1" name="opt1" value="1" {{ $currentOpt=='1' ? 'checked':'' }} {{ ($disabledAll && $currentOpt!='1') ? 'disabled':'' }} />
				<label id="st1_1_label" for="st1_1">全日</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="2" {{ $currentOpt=='2' ? 'checked':'' }} {{ ($disabledHalf && $currentOpt!='2') ? 'disabled':'' }} />
				<label id="st1_2_label" for="st1_2">午前休</label>
				<input id="st1_3" type="radio" class="st1" name="opt1" value="3" {{ $currentOpt=='3' ? 'checked':'' }} {{ ($disabledHalf && $currentOpt!='3') ? 'disabled':'' }} />
				<label id="st1_3_label" for="st1_3">午後休</label>
				<input id="st1_4" type="radio" class="st1" name="opt1" value="4" {{ $currentOpt=='4' ? 'checked':'' }} {{ ($disabledTime && $currentOpt!='4') ? 'disabled':'' }} />
				<label id="st1_4_label"for="st1_4">時間休</label>
				<input id="st1_12" type="radio" class="st1" name="opt1" value="12" {{ $currentOpt=='12' ? 'checked':'' }} {{ ($disabledAll && $currentOpt!='12') ? 'disabled':'' }} />
				<label id="st1_12_label" for="st1_12">変更</label>
			</div>
			@endisset
		</div>
		<div class="select_type">
			<label class="g12">特別休暇・その他</label>
			<div class="radio-group g23">
				<input id="st1_5" type="radio" class="st1" name="opt1" value="5" {{old('opt1',$matter->opt1)=='5' ? 'checked':''}}/>
				<label for="st1_5">特別</label>
				<input id="st1_6" type="radio" class="st1" name="opt1" value="6" {{old('opt1',$matter->opt1)=='6' ? 'checked':''}}/>
				<label for="st1_6">慶弔</label>
				<input id="st1_14" type="radio" class="st1" name="opt1" value="14" {{old('opt1',$matter->opt1)=='14' ? 'checked':''}}/>
				<label for="st1_14">子の看護等(工事中)</label>
				<input id="st1_15" type="radio" class="st1" name="opt1" value="15" {{old('opt1',$matter->opt1)=='15' ? 'checked':''}}/>
				<label for="st1_15">介護(工事中)</label>
				<span class="open_detail" data-target="modal_special">詳細はこちら</span>
			</div>
		</div>
		<div class="select_type">
			<label class="g12">欠勤</label>
			<div class="radio-group g23 radio_red">
				<input id="st1_7" type="radio" class="st1" name="opt1" value="9" {{old('opt1',$matter->opt1)=='9' ? 'checked':''}}/>
				<label for="st1_7">全日欠勤</label>
				<input id="st1_8" type="radio" class="st1" name="opt1" value="10" {{old('opt1',$matter->opt1)=='10' ? 'checked':''}}/>
				<label for="st1_8">遅刻</label>
				<input id="st1_9" type="radio" class="st1" name="opt1" value="11" {{old('opt1',$matter->opt1)=='11' ? 'checked':''}}/>
				<label for="st1_9">早退</label>
				<input id="st1_10" type="radio" class="st1" name="opt1" value="13" {{old('opt1',$matter->opt1)=='13' ? 'checked':''}}/>
				<label for="st1_10">時間欠勤</label>
				<span class="open_detail" data-target="modal_kekkin">詳細はこちら</span>
			</div>
		</div>
		<div class="matter_date">
			<label class="g12">開始時間</label>
			<div class="g23">
				<input type="number" name="hour1" autocomplete="off" value="{{old('hour1',$matter->hour1)}}">
				<input type="number" name="minutes1" min="0" max="59" autocomplete="off" value="{{old('minutes1',$matter->minutes1)}}">
			</div>
			<label class="g34">終了時間</label>
			<div class="g45">
				<input type="number" name="hour2" autocomplete="off" value="{{old('hour2',$matter->hour2)}}">

				<input type="number" name="minutes2" min="0" max="59" autocomplete="off" value="{{old('minutes2',$matter->minutes2)}}">
			</div>

			<label class="g56">休憩時間</label>
			<div class="g67">
				<input type="number" name="breaktime" min="0" max="60" autocomplete="off" value="{{old('breaktime',$matter->breaktime)}}">

			</div>
		</div>
		<div>
			<label class="g12">休暇時間</label> <label class="time_alert g23"></label><label class="hour3 g34">{{old('hour3',intdiv($matter->allotted,60))}}時間</label> <label class="minutes3 g45">{{$matter->allotted%60}}分</label>
		</div>
		<div>

			<label class="g12" for="order_content">休暇理由 ：</label>
			<textarea class="g23" id="order_content" name="order_content" rows="2" cols="60">{{old('order_content',$matter->order_content)}}</textarea>
		</div>
	</fieldset>
	<label><strong>申請種別1は業務担当者に、申請種別2は業務担当者及びエリアマネージャーに申請前に了承を得てください。</strong></label>
</section>