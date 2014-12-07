<script>
	
	var url;
	$(document).ready(function(){

		purchase = function (){
      $('#konten').panel({
        href:base_url+'picking_req_order_selected/purchase'
      });
    }

		add = function (){
      $('#detail_dialog').dialog({
        title: 'Add Request Order',
        width: $(window).width() * 0.8,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'picking_req_order_selected/add_detail_pr',
        modal: true
      });
       
      $('#detail_dialog').dialog('open');
      url = base_url+'picking_req_order_selected/save/add_detail_pr';
    }
    // end newData
		
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dg').datagrid('validateRow', editIndex)){
				$('#dg').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
		$(function(){ // init
			$('#dg').datagrid({url:"picking_req_order_selected/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	

		 //# Tombol Bawah
  /*  $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Add Detail PR',
            handler:function(){
              add();
            }
          }            
        ]
      });     
    }); */
		
	});
</script>


<div id="toolbar_pending" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
		</table>
	</div>
</div>

<table id="dg" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_pending',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="570">Deskripsi</th>	
		</tr>
	</thead>
</table>

