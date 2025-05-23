<section id="matter_area">
	<h5>休暇情報</h5>
	<fieldset>
		<div>
			<label class="g12">休暇予定日</label>
			<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off" value="{{old('matter_change_date',substr($matter->matter_change_date,0,10))}}">
		</div>
		<div>
			<label class="g12">種別1:</label>
			<div class="radio-group g23">
				<input id="st1_1" type="radio" class="st1" name="opt1" value="1" {{old('opt1',$matter->opt1)=='1' ? 'checked':''}} />
				<label id="st1_1_label" for="st1_1" style="{{  (!isset($residue_rest_day)  || $residue_rest_day < 1) ? 'background-color: red;' : '' }}">全日</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="2" {{old('opt1',$matter->opt1)=='2' ? 'checked':''}}/>
				<label id="st1_2_label" for="st1_2" style="{{  (!isset($residue_rest_day)  || $residue_rest_day ==0) ? 'background-color: red;' : '' }}">午前休</label>
				<input id="st1_3" type="radio" class="st1" name="opt1" value="3" {{old('opt1',$matter->opt1)=='3' ? 'checked':''}}/>
				<label id="st1_3_label" for="st1_3" style="{{  (!isset($residue_rest_day)  || $residue_rest_day ==0) ? 'background-color: red;' : '' }}">午後休</label>
				<input id="st1_4" type="radio" class="st1" name="opt1" value="4" {{old('opt1',$matter->opt1)=='4' ? 'checked':''}}/>
				<label for="st1_4">時間休</label>
				<input id="st1_12" type="radio" class="st1" name="opt1" value="12" {{old('opt1',$matter->opt1)=='12' ? 'checked':''}}/>
				<label id="st1_12_label" for="st1_12" style="{{  (!isset($residue_rest_day)  || $residue_rest_day ==0) ? 'background-color: red;' : '' }}">変更</label>

				<!--
				<input id="st1_1" type="radio" class="st1" name="opt1" value="1" {{old('opt1',$matter->opt1)=='1' ? 'checked':''}} />
				<label for="st1_1">全日</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="2" {{old('opt1',$matter->opt1)=='2' ? 'checked':''}}/>
				<label for="st1_2">午前休</label>
				<input id="st1_3" type="radio" class="st1" name="opt1" value="3" {{old('opt1',$matter->opt1)=='3' ? 'checked':''}}/>
				<label for="st1_3">午後休</label>
				<input id="st1_4" type="radio" class="st1" name="opt1" value="4" {{old('opt1',$matter->opt1)=='4' ? 'checked':''}}/>
				<label for="st1_4">時間休</label>-->
			</div>
			<label class="g34">種別2:</label>
			<div class="radio-group g45">
				<input id="st1_5" type="radio" class="st1" name="opt1" value="5" {{old('opt1',$matter->opt1)=='5' ? 'checked':''}}/>
				<label for="st1_5">特別</label>
				<input id="st1_6" type="radio" class="st1" name="opt1" value="6" {{old('opt1',$matter->opt1)=='6' ? 'checked':''}}/>
				<label for="st1_6">慶弔</label>
			</div>
			<label class="g56">種別3:</label>
			<div class="radio-group g67 radio_red">
				<input id="st1_7" type="radio" class="st1" name="opt1" value="9" {{old('opt1',$matter->opt1)=='9' ? 'checked':''}}/>
				<label for="st1_7">欠勤</label>
				<input id="st1_10" type="radio" class="st1" name="opt1" value="13" {{old('opt1',$matter->opt1)=='13' ? 'checked':''}}/>
				<label for="st1_10">欠時</label>
				<br>
				<input id="st1_8" type="radio" class="st1" name="opt1" value="10" {{old('opt1',$matter->opt1)=='10' ? 'checked':''}}/>
				<label for="st1_8">遅刻</label>
				<input id="st1_9" type="radio" class="st1" name="opt1" value="11" {{old('opt1',$matter->opt1)=='11' ? 'checked':''}}/>
				<label for="st1_9">早退</label>

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