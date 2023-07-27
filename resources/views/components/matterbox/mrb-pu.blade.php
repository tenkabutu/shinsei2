<section id="matter_area">
	<h5>休暇情報</h5>
	<fieldset>
		<div>
			<label class="g12" for="matter_name">品名　　：</label>
			<textarea class="g23" id="matter_name" name="matter_name" rows="1" cols="60" placeholder="例:LANケーブル、変換アダプタ(typeC to HDMI)">{{old('matter_name',$matter->matter_name)}}</textarea>
		</div>
		<div>
			<label class="g12">納品希望日</label>
			<input type="text" class="target2 g23" name="matter_change_date" autocomplete="off" value="{{old('matter_change_date',substr($matter->matter_change_date,0,10))}}">
		</div>
		<div>
			<label class="g12">設置場所:</label>
			<div class="radio-group g23">
				<input id="st1_1" type="radio" class="st1" name="opt1" value="1" {{old('opt1',$matter->opt1)=='1' ? 'checked':''}} />
				<label for="st1_1">江越事務所</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="2" {{old('opt1',$matter->opt1)=='2' ? 'checked':''}}/>
				<label for="st1_2">熊本市</label>
				<input id="st1_3" type="radio" class="st1" name="opt1" value="3" {{old('opt1',$matter->opt1)=='3' ? 'checked':''}}/>
				<label for="st1_3">八代市</label>
				<input id="st1_4" type="radio" class="st1" name="opt1" value="4" {{old('opt1',$matter->opt1)=='4' ? 'checked':''}}/>
				<label for="st1_4">天草市</label>
				<input id="st1_5" type="radio" class="st1" name="opt1" value="5" {{old('opt1',$matter->opt1)=='5' ? 'checked':''}}/>
				<label for="st1_5">荒尾市</label>
			</div>
		</div>
		<div>

			<label class="g12" for="order_content">目的　　：</label>
			<textarea class="g23" id="order_content" name="order_content" rows="2" cols="60">{{old('order_content',$matter->order_content)}}</textarea>
		</div>
		<div>

			<label class="g12" for="work_content">参考URL：</label>
			<textarea class="g23" id="work_content" name="work_content" rows="2" cols="60">{{old('work_content',$matter->work_content)}}</textarea>
		</div>
		<div>
			<label class="g12" for="purchase_content">備考：</label>
			<textarea class="g23" id="purchase_content" name="purchase_content" rows="2" cols="60">{{old('purchase_content',$matter->purchase_content)}}</textarea>
		</div>




	</fieldset>
	<p>申請種別1はリーダーに、申請種別2はリーダー及び水田に事前に電話で了解を取ってください。</p>
</section>