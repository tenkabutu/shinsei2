<section>
	<fieldset>
		<div>
			@if($type==1)
			 <input type="submit" class="g12" value="削除" onclick="setAction('delete_ov')">

			@elseif($type==2)
			 <input type="submit" class="g12" value="削除" onclick="setAction('delete_pa')">

			@elseif($type==3)
			 <input type="submit" class="g12" value="削除" onclick="setAction('delete_te')">


			@endif

		</div>
	</fieldset>

</section>