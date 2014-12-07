<script>
	$(document).ready(function(){
		$("#RO").select2();
	});
</script>

<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value=" ">
	<div class="fitem" >
		<label style="width:140px">Request Order </label>: 
		<select id="RO" name="id_kategori" style="width:167px;">
							<option>Pilih RO</option>
							<option>Request Order 1</option>
              <option>Request Order 2</option>
              <option>Request Order 3</option>	
              <option>Request Order 4</option>              
		</select>	
	</div>
</form>
	

