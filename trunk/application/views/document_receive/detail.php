<script>
	
	var url;
	$(document).ready(function(){

		detail_dr = function (){
			$('#konten').panel({
				href:base_url+'document_receive/detail_dr'
			});
		}

		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'document_receive/index',
		  });
		}
		
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dg').datagrid('validateRow', editIndex)){
				$('#dg').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}

			actionbutton = function(value, row, index){
			var col='';
				col += '<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
				col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';			
			return col;
		}
		
		$(function(){ // init
			$('#dg').datagrid({url:"document_receive/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
            {
            iconCls:'icon-undo',
            text:'Kembali',
            handler:function(){
              back();
            }
          }           
        ]
      });     
    });
		
	});
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detail_dr()" class="easyui-linkbutton" iconCls="icon-detail-form">Detail Document Receive</a>
					</td>							
			</tr>	
		</table>
	</div>
</div>

<table id="dg" title="Detail Purchase Order" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			pagination:true,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="480">Deskripsi</th>	
			<th field="action" align="center" formatter="actionbutton" width="120">Aksi</th>
		</tr>
	</thead>
</table>
