<script>
	
	var url;
	$(document).ready(function(){
		

		sro = function (val){
			if(val==null){
		          var row = $('#dg').datagrid('getData');              
		          var id = id_sro;
		          val = id;
		    }
			$('#konten').panel({
				href:base_url+'delivered/sro/' + val,
			});
		}

		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'delivered/index',
		  });
		}
				
		actiondetail = function(value, row, index){
			var col='';
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>38, 'policy'=>'DETAIL'))){?>
					col += '<a href="#" onclick="sro(\''+row.id_sro+'/'+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			return col;
		}
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"delivered/grid_detail/<?=$id_do?>"});
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
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
			<th field="id_sro" sortable="true" width="120">ID Shipment RO</th>
			<th field="id_ro" sortable="true" width="120">ID Request Order</th>
			<th field="id_do" sortable="true" width="120">ID Delivery Order</th>
			<th field="date_create" sortable="true" width="180">Date Create</th>
			<th field="full_name" sortable="true" width="150">Requestor</th>		
			<th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
		</tr>
	</thead>
</table>



