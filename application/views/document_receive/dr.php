<script>
	var url;
	$(document).ready(function(){

		add_dr = function (val){
	      $('#konten').panel({
	        href: base_url+'document_receive/add_dr/',
	      });
	    }
	    // end newData

		detailData = function (val){
			$('#konten').panel({			
				href:base_url+'document_receive/detail/' + val,
			});
		}

		actionbutton = function(value, row, index){
			var col='';
				col += '<a href="#" onclick="detailData(\''+row.id_receive+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			return col;
		}

		$(function(){
			$('#dg').datagrid({
				url:base_url+"document_receive/grid"
			});
		});

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Tambah DR',
            handler:function(){
              add_dr();
            }
          }            
        ]
      });     
    }); 

	});
</script>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Document Receive</td>
			<td>: 
				<select id="search" name=" " style="width:200px;">
					<option>Pilih</option>
					<option>Search 1</option>
		            <option>Search 2</option>
		            <option>Search 3</option>	
		            <option>Search 4</option>              
				</select>	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>


<table id="dg" title="Document Receive List" data-options="
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
			<th field="id_receive" sortable="true" width="100">ID Receive</th>
			<th field="id_sro" sortable="true" width="100">ID SRO</th>
			<th field="id_courir" sortable="true" width="100">ID Courir</th>
			<th field="name_courir" sortable="true" width="180">Nama Kurir</th>
			<th field="date_create" sortable="true" width="150">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="80">Aksi</th>
		</tr>
	</thead>
</table>
