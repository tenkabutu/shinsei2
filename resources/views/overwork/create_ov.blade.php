<x-app-layout> <x-slot name="head"> <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

   <script>$(function() {
	   $.datetimepicker.setLocale('ja');
	   $('#target').datetimepicker();
	});</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">

</x-slot>

<div class="main_right">
	<div id="shinsei_wrap">

		<h3>振替申請</h3>
		@if (count($errors) > 0)
		<ul>
			@foreach($errors->all() as $err)
			<li class="text-danger">{{ $err }}</li> @endforeach
		</ul>
		@endif

		<section>
			<h5>　申請状況</h5>
			<fieldset>
				<div>
					<div class="g12"><label>申請済み</label></div>
					<div class="g23 text_right"><button>申請</button></div>
				</div>
			</fieldset>
			<p>申請中・申請後に内容を変更すると再度申請が必要になります。</p>

		</section>

		<section>
			<h5>　申請情報</h5>
			<fieldset>

				<div><div class="radio-group clearfix">
					<input id="Radio3" type="radio" class="radio" name="areatype" value="1" checked/>
					<label for="Radio3">市内</label>
					<input id="Radio4" type="radio" class="radio" name="areatype" value="2" />
					<label for="Radio4">市外</label>
				</div></div>
				<div>
					<div class="g12"><label>申請日</label></div>
					<div class="g23 text_right">text</div>
				</div>
				<div>
					<div class="g12"><label>社員番号</label></div>
					<div class="g23 text_right">{{Auth::user()->id}}</div>
				</div>
				<div>
					<div class="g12"><label>申請者</label></div>
					<div class="g23 text_right">{{Auth::user()->name}}</div>
				</div>
			</fieldset>
		</section>
		<section>

			<fieldset>



				<div>
					<div class="g12"><label>承認者</label></div>
					<div class="g23 text_right">水田浩子</div>
				</div>

			</fieldset>
		</section>
		<section>

			<fieldset>



				<div>
					<div class="g12"><label>通知先</label></div>
					<div class="g23 text_right">松金秀司</div>
				</div>

			</fieldset>
		</section>




		<form action="matter/store" method="post">
			@csrf
			<!-- onsubmit="return false;"  -->
			<section>
			<h5>　振替元作業内容</h5>
				<fieldset>
					<div class="grid_wrap2"  id="grid_reception">
						<label class="g12">振替予定日</label>
						<input type="text" id="target" name="reception_date" autocomplete="off">




						<label class="g12" for="order_content">業務内容：</label>
						<textarea id="order_content" name ="order_content"  rows="5" cols="60"></textarea>
						<div class="grid_wide">
							<label for="device_model">オプション1</label>
							<input id="device_model" name="etc1" type="hidden" value="null">
							<input id="device_model" name="etc1" type="checkbox" value="1"
							 @if(old('etc1')) checked="checked"@else @endif />
							<label for="device_model">　オプション2</label>
							<input id="device_model" name="etc2" type="hidden" value="null">
							<input id="device_model" name="etc2" type="checkbox" value="1"
							 @if(old('etc2')) checked="checked"@else @endif />
							<label for="device_model">　オプション3</label>
							<input id="device_model" name="etc3" type="hidden" value="null">
							<input id="device_model" name="etc3" type="checkbox" value="1"
							 @if(old('etc3'))checked="checked"@else @endif />
							 <label for="device_model">　オプション4</label>
							<input id="device_model" name="etc4" type="hidden" value="null">
							<input id="device_model" name="etc4" type="checkbox" value="1"
							 @if(old('etc4'))checked="checked"@else @endif />
						</div>

					</div>
				</fieldset>
			</section>

			<section>
			<h5>　振替休暇情報</h5>
				<fieldset>
					<div class="grid_wrap2"  id="grid_reception">
						<label class="g12">振替予定日</label>
						<input type="text" id="target" name="reception_date" autocomplete="off">



					</div>
				</fieldset>
			</section>
		</form>


</div>
	</div>


<script>

$(function(){

    var radio = $('div.radio-group');
    $('input', radio).css({'opacity': '0'})
    //checkedだったら最初からチェックする
    .each(function(){
        if ($(this).attr('checked') == 'checked') {
            $(this).next().addClass('checked');
        }
    });
    //クリックした要素にクラス割り当てる
    $('label', radio).click(function() {
        $(this).parent().parent().each(function() {
            $('label',this).removeClass('checked');
        });
        $(this).addClass('checked');
      ////  if($(this).parent().hasClass('index_select')){
        //	alert($('input[name="index50"]:checked').val());
        //    }
    });
    $('input[name="index50"]').change(function() {
    	var val1 = $('input[name="index50"]:checked').val();
    	var val2= $('input[name="schooltype"]:checked').val();


    	if(val2=="小学校"||val2=="中学校"){

    		$('select[name="index_select"]').find('option').each(function() {
          var val3 = $(this).attr("class");
          var val4 = $(this).data("val");
          if (val1 == val3&&val2==val4) {
            $(this).show();
          }else{
            $(this).hide();
          }
        	});
    	}else{
    		$('select[name="index_select"]').find('option').each(function() {
    	          var val3 = $(this).attr("class");
    	          var val4 = $(this).data("val");
    	          if (val1 == val3) {
    	            $(this).show();
    	          }else{
    	            $(this).hide();
    	          }
    	        	});

        	}
    });
    $('#device_search').click(function(){
    	var r = $('input[name="areatype"]:checked').val();
    	var id = $('input[name="kanri"]').val();
    	if(r){
    		$.ajax({
                url: "getDevice",
                dataType: "json",
                type: "POST",
                data:{id:id,param:r, _token: '{{csrf_token()}}'},
                success: function(data) {
                	//$('input[name="school_name"]').val(data.school.schoolname);
                	$('input[name="school_id"]').val(data.school.id);
                	$('input[name="device_model"]').val(data.device.device_type);
                	$('input[name="device_name"]').val(data.device.device_name);
                	$('input[name="device_id"]').val(data.device.id);
                	$('input[name="jititai_name"]').val(data.jititai_name);
                	$('input[name="school_tel"]').val(data.school_tel);
                	$('.device_name').text(data.device.device_name);
                	$('.device_model').text(data.device.device_type);
                	$('.device_serial').text(data.device.serial);
                	$('.device_role').text(data.device.role);
                	$('.school_tel').text(data.school.tel);
                	$('.school_adress').text(data.school.areaadress);
                	$('.school_name').text(data.school.schoolname);
                	$('.device_count').text(data.device_count);
                	$('.jititai_name').text(data.school.jititai.jititai_name);
                	$('.supporter_name').text(data.school.supporter.supporter_name);
                	$('.supporter_tel').text(data.school.supporter.tel);
                	$('.supporter_info').text(data.school.supporter.info);
                	var tasklist="<tr><th class='id2'>案件</th><th>学校名</th><th>端末名</th><th>受付</th><th>依頼者</th><th>受付日</th><th></th></tr>";
                    $.each(data.matter_schoollist,function(i,matter){
                        tasklist+="<tr><td><a target='_blank' rel='noopener noreferrer' href='/tabusapo_lb/public/matter/"+matter.matters_id+"/edit'>"+matter.matters_id+"</a></td><td>"+matter.schoolname+"</td><td>"+matter.device_name+"</td><td>"+matter.type_name+"</td>";
                        tasklist+="<td>"+matter.register_name+"</td><td>"+matter.matters_created_at+"</td><td></td></tr>";

                     })

                     $('#school_matter_list').html(tasklist);

                    var tasklist2="<tr><th class='id2'>案件</th><th>学校名</th><th>端末名</th><th>受付</th><th>依頼者</th><th>受付日</th><th></th></tr>";
                    $.each(data.matter_devicelist,function(i,matter){
                        tasklist2+="<tr><td><a target='_blank' rel='noopener noreferrer' href='/tabusapo_lb/public/matter/"+matter.matters_id+"/edit'>"+matter.matters_id+"</a></td><td>"+matter.schoolname+"</td><td>"+matter.device_name+"</td><td>"+matter.type_name+"</td>";
                        tasklist2+="<td>"+matter.register_name+"</td><td>"+matter.matters_created_at+"</td><td></td></tr>";

                     })

                     $('#device_matter_list').html(tasklist2);



                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    response(['']);
                }
             });
       	}else{
        }

    });
    $('#school_search').click(function(){
    	//var r = $('input[name="areatype"]:checked').val();
    	var id = $('select[name="index_select"]').val();
    	//alert(id);
    	if(id){
    		$.ajax({
                url: "getSchool",
                dataType: "json",
                type: "POST",
                data:{id:id,_token: '{{csrf_token()}}'},
                success: function(data) {
                	$('input[name="school_name"]').val(data.school.schoolname);
                	$('input[name="school_id"]').val(data.school.id);
                	//$('input[name="device_model"]').val(data.device.device_type);
                	//$('input[name="device_name"]').val(data.device.device_name);
                	//$('input[name="device_id"]').val(data.device.id);
                	$('input[name="jititai_name"]').val(data.jititai_name);
                	$('input[name="school_tel"]').val(data.school_tel);
                	//$('.device_name').text(data.device.device_name);
                	//$('.device_model').text(data.device.device_type);
                	//$('.device_serial').text(data.device.serial);
                	//$('.device_role').text(data.device.role);
                	$('.school_tel').text(data.school.tel);
                	$('.school_adress').text(data.school.areaadress);
                	$('.school_name').text(data.school.schoolname);
                	$('.device_count').text(data.device_count);
                	$('.jititai_name').text(data.school.jititai.jititai_name);
                	$('.supporter_name').text(data.school.supporter.supporter_name);
                	$('.supporter_tel').text(data.school.supporter.tel);
                	$('.supporter_info').text(data.school.supporter.info);
                	var tasklist="<tr><th class='id2'>案件</th><th>学校名</th><th>端末名</th><th>受付</th><th>依頼者</th><th>受付日</th><th></th></tr>";
                    $.each(data.matter_schoollist,function(i,matter){
                        tasklist+="<tr><td><a target='_blank' rel='noopener noreferrer' href='/tabusapo_lb/public/matter/"+matter.matters_id+"/edit'>"+matter.matters_id+"</a></td><td>"+matter.schoolname+"</td><td>"+matter.device_name+"</td><td>"+matter.type_name+"</td>";
                        tasklist+="<td>"+matter.register_name+"</td><td>"+matter.matters_created_at+"</td><td></td></tr>";

                     })
                     $('#school_matter_list').html(tasklist);

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    response(['']);
                }
             });
       	}else{
        }

    });



 });
</script> </x-app-layout>
