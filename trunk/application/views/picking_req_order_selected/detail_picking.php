<script>
	
	var url;
	$(document).ready(function(){

    available = function (val){      
      if(val==null){
          var row = $('#dg_detail').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/available/' + val,
      });
    }

		lock = function (val){

      if(val==null){
          var row = $('#dg_detail').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/lock/' + val,
      });
		}

		pending = function (val){
       if(val==null){
          var row = $('#dg_detail').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/pending/' + val,
      });
		}

		purchase = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/purchase'
			});
		}
		
		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'picking_req_order_selected/index',
		  });
		}

    alocateData = function (val){
        if(confirm("Apakah yakin akan mengalokasi data ke proses picking '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'picking_req_order_selected/alocateData/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dialokasi'
                });
                // reload and close tab
                $('#dg_detail').datagrid('reload');
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

    alocateAll = function (val){
        if(confirm("Apakah yakin akan mengalokasi semua data ke proses picking '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'picking_req_order_selected/alocateAll/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dialokasi'
                });
                // reload and close tab
                $('#dg_detail').datagrid('reload');
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

		actiondetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="alocateData(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Alocate</a>';			
			return col;
		}
		
		$(function(){ // init
			$('#dg_detail').datagrid({url:"picking_req_order_selected/grid_detail/<?=$id_ro?>"});	
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg_detail').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-all',
            text:'Alocate All',
            handler:function(){
              var row = $('#dg_detail').datagrid('getData');              
              var id = row.rows[0].id_ro;
              alocateAll(id);
            }
          },
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
					<td>&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a>
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>			
		</table>
	</div>
</div>

<table id="dg_detail" title="Detail Picking Request Order Selected" data-options="
		rownumbers:true,
		singleSelect:true,
		autoRowHeight:false,
		pagination:true,
		pageSize:30,
		fit:true,
		toolbar:'#toolbar_detail',
		">		

   <thead>
    <tr>
      <th field="id_detail_ros" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID ROS</th>
      <th field="kode_barang" sortable="true" width="120">ID Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th field="qty" sortable="true" width="120">Qty</th>
      <th field="note" sortable="true" width="130">Deskripsi</th>
      <th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
    </tr>
  </thead>
</table>



