<script>
// search text combo
		$(document).ready(function(){
			$("#ros").select2();
		});
</script>

<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value=" ">
	<div class="fitem" >
		<!--combobox autocomplete-->
		<label style="width:120px">ROS </label>:
			<select id="ros" name=" " style="width:200px;">
						<option>Pilih</option>
						<option>ROS 1</option>
            <option>ROS 2</option>
            <option>ROS 3</option>	
            <option>ROS 4</option>              
				</select>	
	</div>
</form>
	

