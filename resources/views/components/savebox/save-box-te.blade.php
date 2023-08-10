<section>
	<fieldset>
		<div>
			@if($status==0)
				 <!--<input type="submit" class="g12" value="保存" onclick="setAction('save_te')">-->
				<input type="submit" class="g23" value="申請" onclick="setAction('save_request_te')">
			@elseif($role==1||$role==2)

				@if($status==3)
				<input type="submit" class="g12" value="承認解除" onclick="setAction('cancel')">
				@else
				<input type="submit" class="g12" value="承認" onclick="setAction('accept')">
				<input type="submit" class="g23" value="再提出" onclick="setAction('reject')">
				@if(Auth::user()->permissions & 4)
				<input type="submit" class="g34" value="代理修正" onclick="setAction('fix_te')">
				<input type="submit" class="g45" value="削除" onclick="setAction('delete_te')">
				<div class="g15 grid">
					<label class="g12">再提出理由　　：</label>
					<textarea name="reject_content" rows="2" cols="60" class="g25" placeholder="理由を記入"></textarea>
				</div>
				@else
				<div class="g13 grid">
					<label class="g12">再提出理由　　：</label>
					<textarea name="reject_content" rows="2" cols="60" class="g23" placeholder="理由を記入"></textarea>
				</div>
				@endif
				@endif
			@elseif($role==4)
			<input type="submit" class="g12" value="修正" onclick="setAction('fix_te')">
			@elseif($status==1)
			 <!--<input type="submit" class="g12" value="更新" onclick="setAction('update_te')">-->
			 <input type="submit" class="g23" value="再申請" onclick="setAction('update_request_te')">
			 <input type="submit" class="g34" value="削除" onclick="setAction('delete_te')">
			@elseif($status==2)
				<!--<input type="submit" class="g12" value="更新" onclick="setAction('update_te')"> -->
				<input type="submit" class="g23" value="再申請" onclick="setAction('update_request_te')">
				<input type="submit" class="g34" value="削除" onclick="setAction('delete_te')">
			@elseif($status==3)
				<p>この申請は承認されています。確認者に承認を解除してもらうか、秋吉さんに修正を依頼してください。</p>
			@elseif($status==4)
				<!--<input type="submit" class="g12" value="更新" onclick="setAction('update_te')">-->
				<input type="submit" class="g23" value="再申請" onclick="setAction('update_request_te')">
			@elseif($status==5)
				<input type="submit" class="g12" value="再申請" onclick="setAction('update_request_pa')">
				<input type="submit" class="g23" value="削除" onclick="setAction('delete_pa')">
			@elseif($status==6)
				<p>この申請は削除されました。</p>
			@endif
		</div>
	</fieldset>
	<p>申請前に責任者に電話で了解を取ってください。</p>
</section>