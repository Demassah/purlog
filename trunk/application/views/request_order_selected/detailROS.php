<script>
	
	var url;
	$(document).ready(function(){

		kembali = function (){
			//detail
			$('#konten').panel({
				href: base_url+'request_order_selected/index/'
			});

		}

		 alocateData = function (val){
        if(confirm("Apakah yakin akan mengalokasi data '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'request_order_selected/alocate/' + val,
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
      if ($('#dg_ros').datagrid('validateRow', editIndex)){
        $('#dg_ros').datagrid('endEdit', editIndex);
        editIndex = undefined;
        return true;
      } else {
        return false;
      }
    }

    onClickCells = function(index, field){
      if (endEditing()){
        $('#dg_ros').datagrid('selectRow', index)
            .datagrid('editCell', {index:index,field:field});
        editIndex = index;
      }
    }

    saveData = function(){
      // save jika cell masih dlm keadaan edit
      $('#dg_ros').datagrid('endEdit', editIndex);
      $.ajax({
        url: base_url+"request_order_selected/save",
        method: 'POST',
        data: {
                data_detail : $('#dg_ros').datagrid('getData')
              },
        success : function(response, textStatus){
        //alert(response);
        var response = eval('('+response+')');
        if(response.success){
          $.messager.show({
            title: 'Success',
            msg: 'Data Berhasil Disimpan'
          });
          $('#dg_ros').datagrid('reload');
        }else{
          $.messager.show({
            title: 'Error',
            msg: response.msg
          });
        }
        }
      });
    }

    cancel = function(){
      $('#dg_ros').datagrid('reload');
    }

		$(function(){ // init
			$('#dg_ros').datagrid({url:"request_order_selected/grid_detail/<?=$id_ro?>"});	
			//$('#dg').datagrid('enableFilter'); 
		});	

			//Bawah
		$(function(){
			var pager = $('#dg_ros').datagrid().datagrid('getPager');	// get the pager of datagrid
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
            text:'Clear',
            handler:function(){
              cancel();
            }
          },
					{
						iconCls:'icon-undo',
						text:'Kembali',
						handler:function(){
							kembali();
						}
					}
				]
			});			
		});

    cellStyler = function(value,row,index){
        return 'background-color:#ffee00;color:red;';
    }
		
	});
</script>

<table id="dg_ros" title="Detail Request Order Selected" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar_ro',
      onClickCell: onClickCells,
      ">
  <thead>
    <tr>
      <th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID Request Order</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th data-options="field:'kode_barang',width:'80',styler:cellStyler" editor="text">ID Barang</th>    
      <th field="nama_barang" sortable="true" width="120">Nama Barang</th>
      <th field="qty" sortable="true" width="60">Qty</th>
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
    </tr>
  </thead>
</table>

