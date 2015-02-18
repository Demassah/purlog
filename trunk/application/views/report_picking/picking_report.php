<?php
if (empty ($data_pdf)) {
    echo "Tidak ada data";
}
else {
?>
<style>
	h4 {
		font-size:20px;
		font-weight:bold;
		margin:0px;
		margin-bottom:5px;
	}
	page{
		border:1px solid black;
	}
	p{
		margin:5px;
		font-size: 15px;
	}
	.header{
		width:95%;
		border-bottom:2px double black;
		padding:10px 0;
	}
	.header img{
		width:100px;
		height:auto;
	}
	.tblbtl {
		border: 1px solid black;
		width: 100%;
	}
	.tblbtl td, 
	.tblbtl th {
		border-bottom: 1px solid black;
		padding: 4px 4px;
		font-size: 13px;
	}
</style>
<page backtop="15mm" backbottom="10mm" backleft="1mm" backright="3mm">
    <page_header>
        <table style="width: 100%;" class="header" cellspacing=0 cellpadding=0 >
            <tr>
              <!--   <td style="text-align: left;   width: 10%"><img src='<?php base_url()?>asset/images/logo.jpg' /></td>
				<td style="text-align: center; width: 80%">
					<h4><?php echo $namaUniv;?></h4>
					<p><?php echo $alamatUniv;?></p>
					<p><?php echo $kotaUniv;?></p>
				</td>
                <td style="text-align: right;   width: 10%"><?php //echo date('d/m/Y'); ?></td> -->
            </tr>
        </table>
    </page_header>
    <!-- <page_footer>
        <table style="width: 100%; border-top: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">PT. Cipaganti Citra Graha </td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer> -->
	<!--<table style="width:100%;">-->
<h4 align="center"><b>Picking List</b></h4>
<p></p>
<p></p>
<p></p>
<p></p>
	<!--<p align="center"><?php  echo $data_pdf[0]->nama_tahunajaran;?></p>-->
	<table>
		<tr>
			<td  align="left">Requestor</td>
			<td  align="left"> : <?php echo $data_pdf[0]->full_name;?></td>
			<td>&nbsp;&nbsp;</td>
			<td align="left">External Doc No</td>
			<td align="left"> : <?php echo $data_pdf[0]->ext_doc_no;?></td>
		</tr>    
		<tr>
			<td align="left">Departement</td>
			<td align="left"> : <?php echo $data_pdf[0]->departement_name;?></td>
			<td>&nbsp;&nbsp;</td>
			<td align="left">ETD</td>
			<td align="left"> : <?php echo $data_pdf[0]->etd;?></td>
		</tr>
		<tr>
			<td align="left">Purpose</td>
			<td align="left"> : <?php echo $data_pdf[0]->purpose;?></td>
			<td>&nbsp;&nbsp;</td>
			<td align="left">Date Create</td>
			<td align="left"> : <?php echo $data_pdf[0]->date_create;?></td>
		</tr>
		<tr>
			<td align="left">Category Request</td>
			<td align="left"> : <?php echo $data_pdf[0]->cat_req;?></td>
		</tr>
	</table>
	<br/> 
	<div>
	<table width= "100%" border="0.5" bordercolor="#000000" class='tblbtl' cellspacing=0 cellpadding=0>
	  <tr>
		<th width="30" align="center">No</th>
		<th width="80" align="center">ID RO</th>
		<th width="80" align="center">ID Stock</th>
		<th width="90" align="center">Kode Barang</th>
		<th width="145" align="center">Nama Barang</th>
		<th width="50" align="center">Qty</th>
		<th width="125" align="center">Lokasi</th>
		<!--td width="65">Kredit</td-->
	  </tr>
	  <?php 
		$no = 1;
		foreach ($data_pdf as $data):
	  ?>
	  <tr>
		<td align="center"><?php echo $no; ?></td>
		<td align="center"><?php echo $data->id_ro;?></td>
		<td align="center"><?php echo $data->id_stock;?></td>
		<td align="center"><?php echo $data->kode_barang;?></td>
		<td align="center"><?php echo $data->nama_barang;?></td>
		<td align="center"><?php echo $data->qty;?></td>
		<td align="center"><?php echo $data->id_lokasi;?></td>
	  </tr>
	  <?php 
		$no++;
	//foreach
	  endforeach; ?>
	</table>
	<br><br>
	<div class="class="footer"">
		<table >
		<tr>
				<td width="230" align="center"></td>
				<td width="230" align="center"></td>
				<td width="230" align="center">Bandung,<?php echo tgl_indo(date('Y-m-d'))?></td>
			</tr>
			<tr>
				<td width="230" align="center">Mengajukan</td>
				<td width="230" align="center">Mengetahui</td>
				<td width="230" align="center">Menerima</td>
			</tr>
			<tr><td></td></tr>	<tr><td></td></tr>	<tr><td></td></tr>	<tr><td></td></tr>	<tr><td></td></tr>	<tr><td></td></tr>
			<tr><td></td></tr>	<tr><td></td></tr>	<tr><td></td></tr> <tr><td></td></tr> <tr><td></td></tr>  <tr><td></td></tr> 
			<tr><td></td></tr>	<tr><td></td></tr>	<tr><td></td></tr> <tr><td></td></tr> <tr><td></td></tr> 
			<tr>
				<td width="100" align="center">__________________</td>
				<td width="100" align="center">__________________</td>
				<td width="100" align="center">__________________</td>
			</tr>
		</table>
	</div>
	</div>
</page>
<?php } ?>