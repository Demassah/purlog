<script>
	
	var url;
	$(document).ready(function(){
	var id_transfer = <?php echo $id_transfer;?>;

		alokasi = function (val){
			$('#dialog_kosong').dialog({
				title: 'Alokasi',
				width: 380,
				height: 340,
				closed: true,
				cache: false,
				href: base_url+'transfer/alokasi/' + val,
				modal: true
			});			 
			$('#dialog_kosong').dialog('open');
			url = base_url+'transfer/save_transfer/add';
		}
		// end newData

	    add_detail = function (val){
	        if(val==null){
	          var row = $('#dtgrd').datagrid('getData');              
	          var id = id_transfer;
	          val = id;
	        }

	      $('#dialog_kosong').dialog({
	        title: 'Tambah Detail Transfer',
	        width: $(window).width() * 0.88,
	        height: $(window).height() * 0.99,
	        closed: true,
	        cache: false,
	        href: base_url+'transfer/add_detail/' + val,
	        modal: true
	      });      
	      $('#dialog_kosong').dialog('open');
	      url = base_url+'purchase_request/save_detailPR/add_detail';
	    }
	    // end newData


	back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'transfer/index',
		  });
	}

	actiondetail = function(value, row, index){
      var col='';
          col = '<a href="#" onclick="alokasi(\''+row.id_detail_transfer+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Alocate</a>';
      return col;
    }

		$(function(){ // init
			$('#dtgrd').datagrid({url:"transfer/grid_detail/<?=$id_transfer?>"});
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
        	{
            iconCls:'icon-add',
            text:'Tambah Barang',
            handler:function(){
              add_detail();
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

     cellStyler = function(value,row,index){
		return 'background-color:#ffee00;color:red;';
	}

	});
</script>

<table id="dtgrd" title="Detail Delivered" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">
	<thead>
		<tr>
			<th field="id_detail_transfer" sortable="true" width="100">ID Detail Transfer</th>
			<th field="id_transfer" sortable="true" width="80">ID Transfer</th>
			<th field="id_stock" sortable="true" width="80">ID Stock</th>
			<th field="kode_barang" sortable="true" width="120">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>		
			<th field="qty_stock" sortable="true" width="100">Qty Stock</th>		
			<th data-options="field:'qty',width:'100',styler:cellStyler" editor="text">Qty Transfer</th> 
			<th field="price" sortable="true" width="100">Price</th>		
			<th field="lokasi_stock" sortable="true" width="100">Lokasi Stock</th>
			<th data-options="field:'id_lokasi',width:'100',styler:cellStyler" editor="text">Lokasi Transfer</th> 
			<th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
		</tr>
	</thead>
</table>

