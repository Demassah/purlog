<script>
	// search text combo
		$(document).ready(function(){
			$("#DO").select2();
		});
</script>

<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value=" ">
	<div class="fitem" >
		<label style="width:100px">Courir </label>: 
			<select id="DO" name=" " style="width:200px;">
						<option>Pilih</option>
						<option>Courir 1</option>
            <option>Courir 2</option>
            <option>Courir 3</option>	
            <option>Courir 4</option>              
				</select>	
	</div>
</form>
	

