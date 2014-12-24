<script>
	
	var url;
	$(document).ready(function(){
		var id_do = <?php echo $id_do;?>;

		detail_ros = function (val){
			if(val==null){
		          var row = $('#dg').datagrid('getData');              
		          var id = id_do;
		          val = id;
		    }
			$('#konten').panel({
				href:base_url+'delivered/detail_ros/'+ val,
			});
		}

		receive = function (){
			$('#konten').panel({
				href:base_url+'delivered/receive'
			});
		}

		detailDelivered = function (){
			$('#dialog').dialog({
				title: 'Detail Barang Shipment Request Order',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivered/detail',
				modal: true
			});			 
			$('#dialog').dialog('open');
		}

		// actiondetail = function(value, row, index){
		// 	var col='';
		// 			col += '<a href="#" onclick="detailDelivered(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
		// 	return col;
		// }

		$(function(){ // init
			$('#dg').datagrid({url:"delivered/grid_detailSRO/<?=$id_sro?>/<?=$id_do?>"});
		});	
		
	});
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detail_ros()" class="easyui-linkbutton" iconCls="icon-detail-form">Shipment RO</a>
		
							&nbsp;&nbsp;<a href="#" onclick="receive()" class="easyui-linkbutton" iconCls="icon-ok">Receive</a>
					</td> 
			</tr>		
		</table>
	</div>
</div>

<table id="dg" title="Shipment Request Order" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
			pagination:true,
		">		
	<thead>
		<tr>
			<th field="id_sro" sortable="true" width="120">ID Shipment RO</th>
			<th field="id_detail_pros" sortable="true" width="120">ID Detail PROS</th>
			<th field="ext_doc_no" sortable="true" width="120">Ext Document No</th>
			<th field="kode_barang" sortable="true" width="120">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>
			<th field="qty" sortable="true" width="80">qty</th>	
			<th field="id_lokasi" sortable="true" width="90">Lokasi</th>	
			<th field="date_create" sortable="true" width="150">Date Create</th>	
			<!-- <th field="action" align="center" formatter="actiondetail" width="80">Aksi</th> -->
		</tr>
	</thead>
</table>

