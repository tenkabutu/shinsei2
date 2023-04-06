<section>
	<fieldset>
		<div>
			@if($status==0)
				<input type="submit" class="g12" value="保存" onclick="setAction('save_pa')">
				<input type="submit" class="g23" value="保存&申請" onclick="setAction('save_request_pa')">
			@elseif($role==1||$role==2)
			<input type="submit" class="g12" value="承認" onclick="setAction('accept')">
			 <input type="submit" class="g23" value="再提出" onclick="setAction('redo')">
			 <input type="submit" class="g34" value="却下" onclick="setAction('reject')">

			@elseif($status==1)
			 <input type="submit" class="g12" value="更新" onclick="setAction('update_pa')">
			 <input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_pa')">
			 <input type="submit" class="g34" value="削除" onclick="setAction('delete_pa')">
			@elseif($status==2)
				<input type="submit" class="g12" value="更新" onclick="setAction('update_pa')">
				<input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_pa')">
				<input type="submit" class="g34" value="削除" onclick="setAction('delete_pa')">
			@elseif($status==3)
				<p>この申請は承認されています。(仕様検討中につき修正の必要があれば遠藤までご連絡ください。)</p>
			@elseif($status==4)
				<input type="submit" class="g12" value="更新" onclick="setAction('update_pa')">
				<input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_pa')">
			@elseif($status==5)
				<input type="submit" class="g12" value="更新" onclick="setAction('update_pa')">
				<input type="submit" class="g23" value="更新&申請" onclick="setAction('update_request_pa')">
			@elseif($status==6)
				<p>この申請は削除されました。</p>

			@endif
		</div>
	</fieldset>
	<p></p>
</section>