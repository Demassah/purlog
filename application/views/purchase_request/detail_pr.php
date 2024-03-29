<script>
	
	var url;
	$(document).ready(function(){
  var id_pr = <?php echo $id_pr;?>;

    tambahDetail = function (val){
        if(val==null){
          var row = $('#dg').datagrid('getData');              
          var id = id_pr;
          val = id;
        }

      $('#dialog_kosong').dialog({
        title: 'Tambah Detail Purchase Request',
        width: $(window).width() * 0.88,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'purchase_request/add_detailPR/' + val,
        modal: true
      });      
      $('#dialog_kosong').dialog('open');
      url = base_url+'purchase_request/save_detailPR/add_detail';
    }
    // end newData

		purchase = function (){
      $('#konten').panel({
        href:base_url+'picking_req_order_selected/purchase'
      });
    }

		back = function (){
      $('#konten').panel({
        href:base_url+'purchase_request/index'
      });
    }

     cancel = function (val){
        if(confirm("Apakah yakin akan membatalkan purchase barang dengan id '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'purchase_request/cancel/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dikirim'
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
    //end sendData 

    actionDetail = function(value, row, index){
      var col='';
        <?php if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DELETE'))){ ?>
          col += '<a href="#" onclick="cancel(\''+row.id_detail_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Cancel</a>';
        <?php }?>
      return col;
    }
	
  $(function(){ // init
      $('#dg').datagrid({url:"purchase_request/grid_detail/<?=$id_pr?>"});  
	});	

	//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Tambah Detail',
            handler:function(){
              tambahDetail();
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

<table id="dg" title ="Detail Purchase Request" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th field="id_detail_pr" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_pr" sortable="true" width="80">ID PR</th>
      <th field="id_detail_ro" sortable="true" width="80">ID Detail RO</th>
      <th field="id_ro" sortable="true" width="80">ID RO</th>
      <th field="kode_barang" sortable="true" width="100">Kode Barang</th>
      <th field="kode_barang" sortable="true" width="120">Nama Barang</th>
      <th field="qty" sortable="true" width="70">qty</th>
      <th field="full_name" sortable="true" width="100">Requestor</th>
      <th field="date_create" sortable="true" width="150">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
      <th field="action" align="center" formatter="actionDetail" width="100">Aksi</th>
		</tr>
	</thead>
</table>

