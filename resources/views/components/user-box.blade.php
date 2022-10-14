
<section>
			<h5>　申請情報</h5>
			<fieldset>
				<!-- <div>
					<div class="g12"><label>申請日</label></div>
					<div class="g23 text_right">text</div>
				</div> -->
				<div>
					<div class="g12"><label>社員番号</label></div>
					<div class="g23 text_right">{{Auth::user()->id}}</div>
				</div>
				<div>
					<div class="g12"><label>申請者</label></div>
					<div class="g23 text_right">{{Auth::user()->name}}</div>
				</div>
				<div>
					<div class="g12"><label>所属</label></div>
					<div class="g23 text_right">{{ $userdata->areatag->nametag}}</div>
				</div>
			</fieldset>
</section>