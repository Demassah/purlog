<script>
	
	var url;
	$(document).ready(function(){
    var id_ro = <?php echo $id_ro;?>;

		detail = function (val){      
      if(val==null){
          var row = $('#dg_picking').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
			$('#konten').panel({
        href: base_url+'picking_req_order_selected/detail/' + val,
			});
		}

		lock = function (val){

      if(val==null){
          var row = $('#dg_picking').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/lock/' + val,
      });
    }

    pending = function (val){
       if(val==null){
          var row = $('#dg_picking').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/pending/' + val,
      });
    }

    reAlocate = function (val){
        if(confirm("Apakah yakin akan merelokasi data ke detail picking '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'picking_req_order_selected/realocateData/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Direlokasi'
                });
                // reload and close tab
                $('#dg_picking').datagrid('reload');
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
    //end sendData 

    lockSRO = function (val){
        if(confirm("Apakah yakin akan mengunci data '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'picking_req_order_selected/lockSRO/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dikunci'
                });
                // reload and close tab
                $('#dg_picking').datagrid('reload');
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
    //end sendData 

    realocateAll = function (val){
        if(confirm("Apakah yakin akan merelokasi semua data ke detail picking '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'picking_req_order_selected/realocateAll/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Direlokasi'
                });
                // reload and close tab
                $('#dg_picking').datagrid('reload');
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
    //end sendData 
    
    lockAll = function (val){
        if(confirm("Apakah yakin akan mengunci semua data ke lock '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'picking_req_order_selected/lockAll/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dikunci'
                });
                // reload and close tab
                $('#dg_picking').datagrid('reload');
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
    //end lockAll 
    
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
      if ($('#dg_picking').datagrid('validateRow', editIndex)){
        $('#dg_picking').datagrid('endEdit', editIndex);
        editIndex = undefined;
        return true;
      } else {
        return false;
      }
    }

    onClickCells = function(index, field){
      if (endEditing()){
        $('#dg_picking').datagrid('selectRow', index)
            .datagrid('editCell', {index:index,field:field});
        editIndex = index;
      }
    }

    saveData = function(){
      // save jika cell masih dlm keadaan edit
      $('#dg_picking').datagrid('endEdit', editIndex);
      //alert(JSON.stringify($('#dg-nilai').datagrid('getData')));
      $.ajax({
        url: base_url+"picking_req_order_selected/save",
        method: 'POST',
        data: {
                data_stock : $('#dg_picking').datagrid('getData')
              },
        success : function(response, textStatus){
        //alert(response);
        var response = eval('('+response+')');
        if(response.success){
          $.messager.show({
            title: 'Success',
            msg: 'Data Berhasil Disimpan'
          });
          $('#dg_picking').dialog('close');
          //$('#dg').datagrid('reload');
        }else{
          $.messager.show({
            title: 'Error',
            msg: response.msg
          });
        }
        }
      });
    }
    
		
		actionAvailable = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="reAlocate(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Re-Alocate</a>';		

          col += '&nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" onclick="lockSRO(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Lock SRO</a>';   
			return col;
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}
			
		$(function(){ // init
			$('#dg_picking').datagrid({url:"picking_req_order_selected/grid_available/<?=$id_ro?>"});	
		});	

    text = function(value, row, index){
      return '<input name="menu_name" size="11" value=" ">';
    }

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg_picking').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-all',
            text:'Re-Alocate All',
            handler:function(){
              var row = $('#dg_picking').datagrid('getData');              
              var id = id_ro;
              realocateAll(id);
            }
          },
          {
            iconCls:'icon-login',
            text:'Lock All SRO',
            handler:function(){
              var row = $('#dg_picking').datagrid('getData');              
              var id = id_ro;
              lockAll(id);
            }
          },
          {
            iconCls:'icon-print',
            text:'Print Picklist',
            handler:function(){
              c();
            }
          },
          {
            iconCls:'icon-ok',
            text:'Save',
            handler:function(){
              saveData();
            }
          }               
        ]
      });     
    });
		
		
	});
</script>

<div id="toolbar_available" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a> 
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a> 
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
		</table>
	</div>
</div>

<table id="dg_picking" title="Available Picking Request Order Selected" data-options="
		rownumbers:true,
		singleSelect:true,
		autoRowHeight:false,
		pagination:true,
		pageSize:30,
		fit:true,
		toolbar:'#toolbar_available',
    onClickCell: onClickCells,
		">		
	 <thead>
    <tr>
      <th field="id_detail_pros" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID RO</th>
      <th field="kode_barang" sortable="true" width="120">ID Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th data-options="field:'qty',width:'100'" editor="text">Qty</th>    
      <th field="id_lokasi" sortable="true" width="100">Lokasi</th>
      <th field="action" align="center" formatter="actionAvailable" width="155">Aksi</th>
    </tr>
  </thead>
</table>


