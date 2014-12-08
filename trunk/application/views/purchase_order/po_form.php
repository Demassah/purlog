<script>
// search text combo
		$(document).ready(function(){
			$("#QRS").select2();
		});
</script>

<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value=" ">
	<div class="fitem" >
		<label style="width:120px">QRS </label>:
				<select id="QRS" name=" " style="width:200px;">
						<option>Pilih</option>
						<option>QRS 1</option>
            <option>QRS 2</option>
            <option>QRS 3</option>	
            <option>QRS 4</option>              
				</select>	
	</div>
</form>
	

