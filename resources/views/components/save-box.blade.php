<section>
	<fieldset>
		<div>
			@if($role==3)
			<input type="submit" class="g12" value="承認" onclick="setAction('accept_ov')">
			 <input type="submit" class="g23" value="再提出" onclick="setAction('redo_ov')">
			 <input type="submit" class="g34" value="却下" onclick="setAction('reject_ov')">

			@elseif($status==1)
			 <input type="submit" class="g12" value="更新" onclick="setAction('update_ov')">
			 <input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_ov')">
			 <input type="submit" class="g34" value="削除" onclick="setAction('save_request_ov')">
			@elseif($status==2||$status==3)
				<input type="submit" class="g12" value="更新" onclick="setAction('update_ov')">
				<input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_ov')">
			@else
				<input type="submit" class="g12" value="保存" onclick="setAction('save_ov')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_ov')">
			@endif
		</div>
	</fieldset>
	<p>申請中・申請後に設定時間を変更すると再度申請が必要になります。</p>
</section>