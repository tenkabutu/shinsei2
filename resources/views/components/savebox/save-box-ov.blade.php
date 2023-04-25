<section>
	<fieldset>
		<div>
			@if($status==0)
				<input type="submit" class="g12" value="保存" onclick="setAction('save_ov')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_ov')">
			@elseif($role==1||$role==2)
				@if($status==3)
				<input type="submit" class="g12" value="承認解除" onclick="setAction('cancel')">
				@else
				<input type="submit" class="g12" value="承認" onclick="setAction('accept')">
				<input type="submit" class="g23" value="再提出" onclick="setAction('reject')">
				@endif
			@elseif($role==4)
			<input type="submit" class="g12" value="修正" onclick="setAction('fix_ov')">
			@elseif($status==1)
			 <input type="submit" class="g12" value="更新" onclick="setAction('update_ov')">
			 <input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_ov')">
			 <input type="submit" class="g34" value="削除" onclick="setAction('delete_ov')">
			@elseif($status==2)
				<input type="submit" class="g12" value="更新" onclick="setAction('update_ov')">
				<input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_ov')">
				<input type="submit" class="g34" value="削除" onclick="setAction('delete_ov')">
			@elseif($status==3)
				<p>この申請は承認されています。確認者に承認を解除してもらうか、秋吉さんに修正を依頼してください。</p>
			@elseif($status==4)
				<input type="submit" class="g12" value="保存" onclick="setAction('save_ov')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_ov')">
			@elseif($status==5)
				<input type="submit" class="g12" value="保存" onclick="setAction('save_ov')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_ov')">
			@elseif($status==6)
				<p>この申請は削除されました。</p>
			@endif
		</div>
	</fieldset>
	<p>申請中・申請後に設定時間を変更すると再度申請が必要になります。</p>
</section>