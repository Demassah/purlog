<script>
	
	var url;
	$(document).ready(function(){
		var id_receive = <?php echo $id_receive;?>;

		add_detail = function (val){
	        if(val==null){
	          var row = $('#dtgrd').datagrid('getData');
	          var id = id_receive;
	          val = id;
	        }

	      $('#dialog_kosong').dialog({
	        title: 'Tambah Detail Document Receive',
	        width: $(window).width() * 0.88,
	        height: $(window).height() * 0.99,
	        closed: true,
	        cache: false,
	        href: base_url+'document_receive/add_detail/' + val,
	        modal: true
	      });      
	      $('#dialog_kosong').dialog('open');
	      url = base_url+'document_receive/save_detail/add_detail';
	    }
	    // end newData

		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'document_receive/index',
		  });
		}
				
		actiondetail = function(value, row, index){
			var col='';
				col += '<a href="#" onclick="sro(\''+row.id_sro+'/'+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			return col;
		}

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
	      if ($('#dtgrd').datagrid('validateRow', editIndex)){
	        $('#dtgrd').datagrid('endEdit', editIndex);
	        editIndex = undefined;
	        return true;
	      } else {
	        return false;
	      }
	    }
	    

	    onClickCells = function(index, field){
	      if (endEditing()){
	        $('#dtgrd').datagrid('selectRow', index)
	            .datagrid('editCell', {index:index,field:field});
	        editIndex = index;
	      }
	    }

	    saveData = function(){
	      // save jika cell masih dlm keadaan edit
	      $('#dtgrd').datagrid('endEdit', editIndex);      
	      $.ajax({
	        url: base_url+"document_receive/save_qty",
	        method: 'POST',
	        data: {
	                data_qty : $('#dtgrd').datagrid('getData')
	              },
	        success : function(response, textStatus){
	        //alert(response);
	        var response = eval('('+response+')');
	        if(response.success){
	          $.messager.show({
	            title: 'Success',
	            msg: 'Data Berhasil Disimpan'
	          });
	          $('#dtgrd').datagrid('reload');
	        }else{
	          $.messager.show({
	            title: 'Error',
	            msg: response.msg
	          });
	        }
	        $('#dtgrd').datagrid('reload');
	        }
	      });
	    }

	    //Cetak
	    print = function(val){    
	        window.open(base_url + 'document_receive/laporan_pdf/'+id_receive);      
	    }

	    cetakDataExcel = function(val){    
	      window.open(base_url+'document_receive/laporan_excel/'+ id_receive);      
	    }

		$(function(){ // init
	      	$('#dtgrd').datagrid({url:"document_receive/grid_detail/<?=$id_receive?>"});  
		});	

		//# Tombol Bawah
	    $(function(){
	      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
	      pager.pagination({
	        buttons:[
	        	{
		            iconCls:'icon-ok',
		            text:'Save All',
		            handler:function(){
		              saveData();
		            }
	            },
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
	          },
	          {
		            iconCls:'icon-excel',
		            text:'Export Excel',
		            handler:function(){
		            cetakDataExcel();
	            }
	          }           
	        ]
	      });     
	    });

	    cellStyler = function(value,row,index){
	    	return 'background-color:#ffee00;color:red;';
		}

		// update return
		updateqty = function(value, row, index){
			return row.qty_delivered - row.qty;
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
			onClickCell: onClickCells,
		">		
	<thead>
		<tr>
			<th field="id_detail_receive" sortable="true" width="100">ID Detail Receive</th>
			<th field="id_receive" sortable="true" width="80">ID Receive</th>
			<!-- <th field="id_detail_pros" sortable="true" width="100">ID Detail Pros</th> -->
			<th field="id_detail_ro" sortable="true" width="100">ID Detail RO</th>
			<th field="id_ro" sortable="true" width="80">ID RO</th>		
			<th field="id_sro" sortable="true" width="80">ID SRO</th>		
			<th field="kode_barang" sortable="true" width="100">Kode Barang</th>		
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>		
			<th field="qty_delivered" sortable="true" width="100">Qty Delivered</th>
			<th data-options="field:'qty',width:'100',styler:cellStyler" editor="text">Qty Received</th>
			<th field="qty_return" formatter="updateqty" sortable="true" width="100">Qty Return</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>		
			<!-- <th field="action" align="center" formatter="actiondetail" width="80">Aksi</th> -->
		</tr>
	</thead>
</table>



