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
						iconCls:'icon-undo',
						text:'Kembali',
						handler:function(){
							kembali();
						}
					}
				]
			});			
		});
		
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
      ">
  <thead>
    <tr>
      <th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID Request Order</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="kode_barang" sortable="true" width="80">ID Barang</th>
      <th field="nama_barang" sortable="true" width="120">Nama Barang</th>
      <th field="qty" sortable="true" width="60">Qty</th>
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
    </tr>
  </thead>
</table>

