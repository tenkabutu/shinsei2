<section>
	<fieldset>
		<div>
			@if($role==1)
			<input type="submit" class="g12" value="承認" onclick="setAction('accept')">
			 <input type="submit" class="g23" value="再提出" onclick="setAction('redo')">
			 <input type="submit" class="g34" value="却下" onclick="setAction('reject')">

			@elseif($status==1)
			 <input type="submit" class="g12" value="更新" onclick="setAction('update_te')">
			 <input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_te')">
			 <input type="submit" class="g34" value="削除" onclick="setAction('save_request_te')">
			@elseif($status==2||$status==3)
				<input type="submit" class="g12" value="更新" onclick="setAction('update_te')">
				<input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_te')">
			@else
				<input type="submit" class="g12" value="保存" onclick="setAction('save_te')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_te')">
			@endif
		</div>
	</fieldset>
	<p>申請前に責任者に電話で了解を取ってください。</p>
</section>