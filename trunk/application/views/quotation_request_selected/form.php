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


		detailSROlist = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/detailSROlist',
			});
		}
				
		actiondetail = function(value, row, index){
			var col='';return col;
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
<form id="form1" method="post" style="margin:10px">
<!-- 	<input type="hidden" name="kode" id="kode" value="<?=$kode?>"> -->
	<div class="fitem" >
		<label style="width:140px">Vendor </label>: 
		<select id="purpose" name="id_kategori" style="width:167px;">
						<option value="">Choose Vendor</option>
						<option value="">Vendor A</option>			
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">TOP </label>: 
		<input name="name" size="19" value=" ">
	</div>

	<div class="fitem" >
		<label style="width:140px">Price</label>: 
		<input name="kode_barang" size="19" value=" ">
	</div>

</form>

<table id="dg" title="Detail" data-options="
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
			<th field="kode_barang" sortable="true" width="120">ID </th>
			<th field="kode_barang" sortable="true" width="120">Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="480">Deskripsi</th>		
			<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
		</tr>
	</thead>
</table>
<script>
	$(document).ready(function(){
		
		$('#purpose').change(function(){
			$('#id_sub_kategori').load(base_url+'prosedur/getSubKategoribyKategori/'+$('#purpose').val());
		});
		
	});

	 $(document).ready(function() {
		$("#id_item").select2();
		$("#id_sub_kategori").select2();
		$("#purpose").select2();
	});
</script>