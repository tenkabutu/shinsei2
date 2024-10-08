<section id="matter_area">
	<h5>作業情報</h5>
	<fieldset>
		<div>
			<label class="g12">作業予定日</label>
			<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off" value="{{old('matter_change_date',substr($matter->matter_change_date,0,10))}}">
		</div>
		<div>
			<label class="g12">申請種別：</label>
			<div class="radio-group g23">

				<input id="st1_1" type="radio" class="st1" name="opt1" value="7" {{old('opt1',$matter->opt1)=='7' ? 'checked':''}} />
				<label for="st1_1">振替</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="8" {{old('opt1',$matter->opt1)=='8' ? 'checked':''}}/>
				<label for="st1_2">時間外</label>


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
	<label><strong>業務担当者及びエリアマネージャーに申請前に了承を得てください。</strong></label>
</section>