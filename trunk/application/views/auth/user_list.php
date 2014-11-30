<script>
	base_url = '<?=base_url();?>';
	$(document).ready(function(){
		
		$(function(){
			$('#dg').datagrid({url:"<?=base_url()?>auth/listUser"});
		});
		
	});
</script>
<table id="dg" title="Kelola User" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar',
			">
	<thead>
		<tr>
			<th field="user_id" width="80">User ID</th>
			<th field="user_name" width="100">Username</th>
			<th field="full_name" width="80">Full Name</th>
			<th field="user_level_id" width="80" align="right">Level</th>
			<th field="kode_fakultas" width="80" align="right">Fakultas</th>
		</tr>
	</thead>
</table>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true"></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true"></a>
	</div>
	<div>
		Date From: <input class="easyui-datebox" style="width:80px">
		To: <input class="easyui-datebox" style="width:80px">
		Language: 
		<select class="easyui-combobox" panelHeight="auto" style="width:100px">
			<option value="java">Java</option>
			<option value="c">C</option>
			<option value="basic">Basic</option>
			<option value="perl">Perl</option>
			<option value="python">Python</option>
		</select>
		<a href="#" class="easyui-linkbutton" iconCls="icon-search">Search</a>
	</div>
</div>