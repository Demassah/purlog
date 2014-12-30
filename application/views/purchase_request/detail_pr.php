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
      <th field="id_ro" sortable="true" width="120">ID RO</th>
      <th field="kode_barang" sortable="true" width="120">Kode Barang</th>
      <th field="qty" sortable="true" width="70">qty</th>
      <th field="user_id" sortable="true" width="70">Requestor</th>
      <th field="date_create" sortable="true" width="200">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
		</tr>
	</thead>
</table>

