<script>
	
	var url;
	$(document).ready(function(){
	var id_transfer = <?php echo $id_transfer;?>;

		alokasi = function (val){
			$('#dialog').dialog({
				title: 'Alokasi Transfer',
				width: 380,
				height: 300,
				closed: true,
				cache: false,
				href: base_url+'transfer/alokasi/' + val,
				modal: true
			});			 
			$('#dialog').dialog('open');
			url = base_url+'transfer/save_transfer/add';
		}
		// end newData

		saveData = function(){
	      $('#form1').form('submit',{
	        url: url,
	        onSubmit: function(){
	          return $(this).form('validate');
	        },
	        success: function(result){
	          alert(result);
	          var result = eval('('+result+')');
	          if (result.success){
	            $.messager.show({
	              title: 'Success',
	              msg: 'Data Berhasil Disimpan'
	            });
	            $('#dialog').dialog('close');   // close the dialog
	            $('#dtgrd').datagrid('reload');    // reload the user data
	          } else {
	            $.messager.show({
	              title: 'Error',
	              msg: result.msg
	            });
	          }
	        }
	      });
	    }
	    //end saveData

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

	 deleteData = function (val){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'transfer/deleteDetail/' + val,
						 async: false,
						 success : function(response){
						 	alert(response);
							var response = eval('('+response+')');
							if (response.success){
								$.messager.show({
									title: 'Success',
									msg: 'Data Berhasil Dihapus'
								});
								// reload and close tab
								$('#dtgrd').datagrid('reload');
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
		//end deleteData


	back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'transfer/index',
		  });
	}

	actiondetail = function(value, row, index){
      var col='';
      	<?if($this->mdl_auth->CekAkses(array('menu_id'=>43, 'policy'=>'EDIT'))){?>
          col = '<a href="#" onclick="alokasi(\''+row.id_detail_transfer+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Transfer</a>';
       	<?}?>
       	col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id_detail_transfer+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
      return col;
    }

    //Cetak
    print = function(val){    
        window.open(base_url + 'transfer/laporan_pdf/'+id_transfer);      
    }

		$(function(){ // init
			$('#dtgrd').datagrid({url:"transfer/grid_detail/<?=$id_transfer?>"});
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
        <?if($this->mdl_auth->CekAkses(array('menu_id'=>43, 'policy'=>'ADD'))){?>
        	{
            iconCls:'icon-add',
            text:'Tambah Barang',
            handler:function(){
              add_detail();
            }
          },
        <?}?>
            {
            iconCls:'icon-undo',
            text:'Kembali',
            handler:function(){
              back();
            }
          },
           {
            iconCls:'icon-pdf',
            text:'Print',
            handler:function(){
              print();
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

<table id="dtgrd" title="Detail Transfer" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">
	<thead>
		<tr>
			<th field="id_detail_transfer" sortable="true" width="110">ID Detail Transfer</th>
			<th field="id_transfer" sortable="true" width="80">ID Transfer</th>
			<th field="id_stock" sortable="true" width="80">ID Stock</th>
			<th field="kode_barang" sortable="true" width="120">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>		
			<th field="qty_stock" sortable="true" width="85">Qty Stock</th>		
			<th data-options="field:'qty',width:'85'," editor="text">Qty Transfer</th> 
			<th field="price" sortable="true" width="100">Price</th>		
			<th field="lokasi_stock" sortable="true" width="100">Lokasi Stock</th>
			<th data-options="field:'id_lokasi',width:'100'," editor="text">Lokasi Transfer</th> 
			<th field="action" align="center" formatter="actiondetail" width="120">Aksi</th>
		</tr>
	</thead>
</table>

