
<section>
			<h5>　申請情報</h5>
			<fieldset>
				<!-- <div>
					<div class="g12"><label>申請日</label></div>
					<div class="g23 text_right">text</div>
				</div> -->
				<div>
					<div class="g12"><label>社員番号</label></div>
					<div class="g23 text_right">{{$userdata->employee}}</div>
				</div>
				<div>

					<div class="g12"><label>申請者</label></div>
					<div class="g23 text_right"><span class="proxy_user">{{$userdata->name}}</span>
					@if($userdata->role==1&&$userdata->id==Auth::id()&& $mcheck==2)
					<button class="proxy_check">代理申請</button>
					@endif

					</div>

				</div>
				<div>
					<div class="g12"><label>所属</label></div>
					<div class="g23 text_right">
                    @if ($userdata->areas->isNotEmpty())
                        {{ $userdata->areas->pluck('name')->join(', ') }}
                    @else
                        なし
                    @endif
                    </div>
				</div>
				<div>
					<div class="g12"><label>確認者</label></div>
					<div class="g23 text_right">
					@foreach($checker as $record)
						@if($record->id == 2)
        					@continue
    					@endif
						{{$record->name}}
						@if(!$loop->last)
        ,
    @endif

					@endforeach
					</div>
				</div>
				<!-- <div>
					<div class="g12"><label>通知先</label></div>
					<div class="g23 text_right">松金秀司</div>
				</div> -->

			</fieldset>
</section>