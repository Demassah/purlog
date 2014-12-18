
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="listSRO()" class="easyui-linkbutton" iconCls="icon-detail">Add SRO</a></td>					
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						<label style="width:120px">&nbsp;&nbsp;SRO </label>:
							<select id="SRO" name=" " style="width:200px;">
								<option>Pilih</option>
								<option>SRO 1</option>
		            <option>SRO 2</option>
		            <option>SRO 3</option>	
		            <option>SRO 4</option>              
						</select>	
						&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-ok">Done</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


<table id="dg" title="Detail Delivery Order" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="480">Deskripsi</th>		
			<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
		</tr>
	</thead>
</table>

<script>
	
	var url;
	$(document).ready(function(){

		// search text combo
		$(document).ready(function(){
			$("#SRO").select2();
		});

		back = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/index',
			});
		}

		listSRO = function (){
			$('#dialog').dialog({
				title: 'Add Shipment Request Order',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/listSRO',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}

		detailSROlist = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/detailSROlist',
			});
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="detailSROlist(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
					col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Cancel</a>';			
			return col;
		}
		

		$(function(){ // init
			$('#dg').datagrid({url:"delivery_order/grid"});				
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-undo',
            text:'Kembali',
            handler:function(){
              back();
            }
          },
          {
            iconCls:'icon-print',
            text:'Print',
            handler:function(){
              print();
            }
          }           
        ]
      });     
    });
		
	});
</script>

