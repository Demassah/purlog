<script>
	var url;
	$(document).ready(function(){

    newData = function (){
      $('#dialog').dialog({
        title: 'Tambah Request Order Selected',
        width: 380,
        height: 130,
        closed: true,
        cache: false,
        href: base_url+'request_order_selected/add',
        modal: true
      });      
      $('#dialog').dialog('open');
      url = base_url+'request_order_selected/save/add';
    }
    // end newData
    
    detailData = function (val){
      $('#konten').panel({      
        href:base_url+'request_order/detail/' + val,
      });
    }

		doneData = function (val){
        if(confirm("Apakah yakin akan mengalokasi data ke Picking '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'request_order_selected/done/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dialokasi'
                });
                // reload and close tab
                $('#dg').datagrid('reload');
              } else {
                $.messager.show({
                  title: 'Error',
                  msg: response.msg
                });
              }
             }
          });
        }
      //}
    }
    //end alocateData 
		
		detailROS = function (val){
			//detail
			$('#konten').panel({
				href: base_url+'request_order_selected/detailROS/' + val,
			});

		}
		
		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				departement_id : $('#s_departement_id').val(),
				id_ro : $('#s_id_ro').val(),
				ext_doc_no : $('#s_ext_doc_no').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}
		
		actionbutton = function(value, row, index){
			var col='';
			
					col += '<a href="#" onclick="detailROS(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			

					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order_selected/grid"
			});
		});

	});
</script>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="650" border="0">
		  <tr>
			<td>Departement</td>
			<td>: 
				<select id="s_departement_id" name="s_departement_id" style="width:120px;">
					<?=$this->mdl_prosedur->OptionDepartement();?>
				</select>
			</td>
			<td>Ext Document No</td>
			<td>: 
				<input name="s_ext_doc_no" id="s_ext_doc_no" size="15">
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		  <tr>
			<td>ID RO</td>
			<td>: 
				<input name="s_id_ro" id="s_id_ro" size="15">
			</td>

			<td>&nbsp;</td>
		  </tr>
		</table>
	</div>
</div>

<table id="dg" title="Request Order Selected List" data-options="
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
			<th field="id_ro" sortable="true" width="80" >ID RO</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="departement_name" sortable="true" width="130">Departement</th>
			<th field="purpose" sortable="true" width="120">Purpose</th>
			<th field="cat_req" sortable="true" width="120">Category Request</th>
			<th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
			<th field="ETD" sortable="true" width="100">ETD</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="150">Aksi</th>
		</tr>
	</thead>
</table>