<section>
	<fieldset>
		<div>
			@if($type==1)
			 <input type="submit" class="g12" value="削除" onclick="setAction('delete_ov')">
			 <input type="submit" class="g23" value="中止" onclick="window.location.href = window.location.href?;">
			@elseif($type==2)
			 <input type="submit" class="g12" value="削除" onclick="setAction('delete_pa')">
			 <input type="submit" class="g23" value="中止" onclick="window.location.href = window.location.href?;">
			@elseif($type==3)
			 <input type="submit" class="g12" value="削除" onclick="setAction('delete_te')">
			 <input type="submit" class="g23" value="中止" onclick="window.location.href = window.location.href?;">

			@endif

		</div>
	</fieldset>

</section>