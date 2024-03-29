<section id="matter_area">
	<h5>購入希望情報</h5>
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
				<input id="st1_1" type="radio" class="st1" name="opt1" value="12" {{old('opt1',$matter->opt1)=='12' ? 'checked':''}} />
				<label for="st1_1">江越事務所</label>
				<input id="st1_2" type="radio" class="st1" name="opt1" value="13" {{old('opt1',$matter->opt1)=='13' ? 'checked':''}}/>
				<label for="st1_2">熊本市</label>
				<input id="st1_3" type="radio" class="st1" name="opt1" value="14" {{old('opt1',$matter->opt1)=='14' ? 'checked':''}}/>
				<label for="st1_3">八代市</label>
				<input id="st1_4" type="radio" class="st1" name="opt1" value="15" {{old('opt1',$matter->opt1)=='15' ? 'checked':''}}/>
				<label for="st1_4">天草市</label>
				<input id="st1_5" type="radio" class="st1" name="opt1" value="16" {{old('opt1',$matter->opt1)=='16' ? 'checked':''}}/>
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
			<label class="g12" for="work_content">価格帯：</label>
			<textarea class="g23" id="work_content" name="work_content" rows="2" cols="60">{{old('work_content',$matter->work_content)}}</textarea>
		</div>
		<div>
			<label class="g12" for="purchase_content">備考：</label>
			<textarea class="g23" id="purchase_content" name="purchase_content" rows="2" cols="60">{{old('purchase_content',$matter->purchase_content)}}</textarea>
		</div>




	</fieldset>
	<p>納品日に猶予がない場合は電話をしてください。</p>
</section>
<seciton>
	@php
        $user1_id = old('hour1', $matter->hour1); // 表示したいユーザーのIDを設定
        $user1 = null;
        if ($user1_id !== 0) {
            $user1 = App\Models\User::find($user1_id);
        }
        $user2_id = old('hour2', $matter->hour2); // 表示したいユーザーのIDを設定
        $user2 = null;

        if ($user2_id !== 0) {
            $user2 = App\Models\User::find($user2_id);
        }

        $user3_id = old('minutes1', $matter->minutes1); // 表示したいユーザーのIDを設定
        $user3 = null;

        if ($user3_id !== 0) {
            $user3 = App\Models\User::find($user3_id);
        }
        $user4_id = old('minutes2', $matter->minutes2); // 表示したいユーザーのIDを設定
        $user4 = null;

        if ($user4_id !== 0) {
            $user4 = App\Models\User::find($user4_id);
        }

    @endphp
	<fieldset>

		<div>


			<div class="approval-checkboxes g12">
    		<label for="opt1">
    		<input type="checkbox" id="opt1" name="hour1" value="{{old('hour1', $matter->hour1) }}" data-opt="opt1" data-value="{{old('hour1', $matter->hour1) }}" class="check-opt"><span>
    		@if ($user1)
        		{{ $user1->name }}
   			 @else
       			承認
   			 @endif</span></label>
    		<input type="hidden" name="hour1" value="{{ old('hour1', $matter->hour1) }}" class="hidden-opt">
    		<label for="opt2">
    		<input type="checkbox" id="opt2" name="hour2" value="{{old('hour2', $matter->hour2) }}" data-opt="opt2" data-value="{{old('hour2', $matter->hour2) }}" class="check-opt"><span>
    		@if ($user2)
        		{{ $user2->name }}
   			 @else
       			承認
   			 @endif</span></label>
    		<input type="hidden" name="hour2" value="{{ old('hour2', $matter->hour2) }}" class="hidden-opt">
			</div>
			<div class="approval-checkboxes g23 text_right">
    		<label for="opt3">
    		<input type="checkbox" id="opt3" name="minutes1" value="{{old('minutes1', $matter->minutes1) }}" data-opt="opt3" data-value="{{old('minutes1', $matter->minutes1) }}" class="check-opt2"><span>
    		@if ($user3)
        		{{ $user3->name }}
   			 @else
       			購入
   			 @endif</span></label>
    		<input type="hidden" name="minutes1" value="{{ old('minutes1', $matter->minutes1) }}" class="hidden-opt">
    		<label for="opt4">
    		<input type="checkbox" id="opt4" name="minutes2" value="{{old('minutes2', $matter->minutes2) }}" data-opt="opt4" data-value="{{old('minutes2', $matter->minutes2) }}" class="check-opt3"><span>
    		@if ($user4)
        		{{ $user4->name }}
   			 @else
       			確認
   			 @endif</span></label>
    		<input type="hidden" name="minutes2" value="{{ old('minutes2', $matter->minutes2) }}" class="hidden-opt">
			</div>
		</div>

	</fieldset>
</seciton>