<section>
	<fieldset>
		<div>
			@if($status==1||$status==2)
			 <input type="submit" class="g12" value="更新" onclick="setAction('update_ov')">
			 <input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_ov')">
			 <input type="submit" class="g34" value="削除" onclick="setAction('save_request_ov')">
			@else
				<input type="submit" class="g12" value="保存" onclick="setAction('save_ov')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_ov')">
			@endif
		</div>
	</fieldset>
</section>