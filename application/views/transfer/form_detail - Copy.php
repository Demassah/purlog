<script>
	var url;
	$(document).ready(function(){

		close = function (val){
	      $('#dialog_kosong').dialog('close');
	    }

		actionbutton = function(value, row, index){
			var col;
			//if (row.kd_fakultas != null) {
				col = '<a href="#" onclick="editData(\''+row. 	id_sub_kategori+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row. 	id_sub_kategori+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			//}
			return col;
		}

		// editing cell
	    $.extend($.fn.datagrid.methods, {
	      editCell: function(jq,param){
	        return jq.each(function(){
	          var opts = $(this).datagrid('options');
	          var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
	          for(var i=0; i<fields.length; i++){
	            var col = $(this).datagrid('getColumnOption', fields[i]);
	            col.editor1 = col.editor;
	            if (fields[i] != param.field){
	              col.editor = null;
	            }
	          }
	          $(this).datagrid('beginEdit', param.index);
	          for(var i=0; i<fields.length; i++){
	            var col = $(this).datagrid('getColumnOption', fields[i]);
	            col.editor = col.editor1;
	          }
	        });
	      }
	    });

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

	    onClickCells = function(index, field){
	      if (endEditing()){
	        $('#dg').datagrid('selectRow', index)
	            .datagrid('editCell', {index:index,field:field});
	        editIndex = index;
	      }
	    }

	    saveData = function(){
	      // save jika cell masih dlm keadaan edit
	      $('#dg').datagrid('endEdit', editIndex);      
	      $.ajax({
	        url: base_url+"transfer/save_detail",
	        method: 'POST',
	        data: {
	                data_detail : $('#dg').datagrid('getData')
	              },
	        success : function(response, textStatus){
	        //alert(response);
	        var response = eval('('+response+')');
	        if(response.success){
	          $.messager.show({
	            title: 'Success',
	            msg: 'Data Berhasil Disimpan'
	          });
	          $('#dg').datagrid('reload');
	        }else{
	          $.messager.show({
	            title: 'Error',
	            msg: response.msg
	          });
	        }
	        $('#dg').datagrid('reload');
	        }
	      });
	    }

		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>transfer/grid_transfer"
			});
		});

		//# Tombol Bawah
	    $(function(){
	      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
	      pager.pagination({
	        buttons:[
	        	{
		            iconCls:'icon-ok',
		            text:'Save',
		            handler:function(){
		              saveData();
		            }
	            },
	            {
		            iconCls:'icon-cancel',
		            text:'Close',
		            handler:function(){
		              close();
		            }
	          }           
	        ]
	      });     
	    });
		
		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				id_stock : $('#s_id_stock').val(),
				id_lokasi : $('#s_id_lokasi').val(),
				kode_barang : $('#s_kode_barang').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}

		cellStyler = function(value,row,index){
	    	return 'background-color:#ffee00;color:red;';
		}
		
	});
</script>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">
		
	</div>
	<div class="fsearch">
		<table width="700" border="0">
		  <tr>
			<td>ID Stock</td>
			<td>: 
				<select id="s_id_stock" name="s_id_stock" class="easyui-combobox" style="width:200px;">
					<?=$this->mdl_prosedur->OptionStock();?>
				</select>
			</td>
			<td>Barang</td>
				<td>: 
					<select id="s_kode_barang" name="s_kode_barang" class="easyui-combobox" style="width:200px;">
						<?=$this->mdl_prosedur->OptionBarangs();?>
					</select>
				</td>
			<td>&nbsp;</td>				
				<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Filter</a></td>
		  </tr>
		  <tr>
			<td>Lokasi</td>
			<td>: 
				<select id="s_id_lokasi" name="s_id_lokasi" class="easyui-combobox" style="width:200px;">
					<?=$this->mdl_prosedur->OptionLokasi();?>
				</select>
			</td>
			<td>&nbsp;</td>				
				
		  </tr>
		</table>
	</div>
</div>

<table id="dg"  data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar',
			onClickCell: onClickCells,
			">
	<thead>
		<tr>
			<th field="id_stock" sortable="true" width="100">ID Stock</th>
			<th field="kode_barang" sortable="true" width="120">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>
			<th field="qty_stock" sortable="true" width="100">Qty Stock</th>
			<th data-options="field:'qty',width:'100',styler:cellStyler" editor="text">Qty Transfer</th> 
			<th field="price" sortable="true" width="120">Harga</th>
			<th field="lokasi_stock" sortable="true" width="120">Lokasi Stock</th>
			<th data-options="field:'id_lokasi',width:'100',styler:cellStyler" editor="text">Lokasi Transfer</th> 
			<!-- <th field="action" align="center" formatter="actionbutton" width="100">Aksi</th> -->
		</tr>
	</thead>
</table>