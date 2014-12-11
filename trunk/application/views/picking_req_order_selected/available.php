<script>
	
	var url;
	$(document).ready(function(){

		detail = function (val){      
      if(val==null){
          var row = $('#dg_picking').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
			$('#konten').panel({
        href: base_url+'picking_req_order_selected/detail/' + val,
			});
		}

		lock = function (val){

      if(val==null){
          var row = $('#dg_picking').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/lock/' + val,
      });
    }

    pending = function (val){
       if(val==null){
          var row = $('#dg_picking').datagrid('getData');              
          var id = row.rows[0].id_ro;
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
              var id = row.rows[0].id_ro;
              realocateAll(id);
            }
          },
          {
            iconCls:'icon-login',
            text:'Lock SRO',
            handler:function(){
              b();
            }
          },
          {
            iconCls:'icon-print',
            text:'Print Picklist',
            handler:function(){
              c();
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
		">		
	 <thead>
    <tr>
      <th field="id_detail_ros" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID ROS</th>
      <th field="kode_barang" sortable="true" width="120">ID Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th field="qty" sortable="true" width="120">Qty</th>
      <th field="note" sortable="true" width="130">Deskripsi</th>
      <th field="action" align="center" formatter="actionAvailable" width="155">Aksi</th>
    </tr>
  </thead>
</table>


