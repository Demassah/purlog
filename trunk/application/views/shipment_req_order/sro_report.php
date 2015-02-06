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
		font-size: 20px;
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
		padding: 6px 6px;
		font-size: 13px;
	}

</style>

<page backtop="10mm" backbottom="10mm" backleft="1mm" backright="3mm">
    <!--<page_header>
        <table style="width: 100%;" class="header" cellspacing=0 cellpadding=0 >
            <tr>
                <td style="text-align: left;   width: 10%"><img src='<?php base_url()?>asset/images/logo.jpg' /></td>
				<td style="text-align: center; width: 80%">
					<h4><?php echo $namaUniv;?></h4>
					<p><?php echo $alamatUniv;?></p>
					<p><?php echo $kotaUniv;?></p>
				</td>
                <td style="text-align: right;   width: 10%"><?php //echo date('d/m/Y'); ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border-top: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">STMIK BANDUNG </td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>-->
	<!--<table style="width:100%;">-->
<p align="center"><b>Shipment Request Order</b></p>

	<p align="center">ID SRO : <?php echo $data_pdf[0]->id_sro;?></p><br>
	<table width="100%" class="tblbtl" align="center">
		<tr>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td  align="left">Requestor</td>
			<td  align="left"> : <?php  echo $data_pdf[0]->full_name;?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left" >External Doc No </td>
			<td align="left"> : <?php  echo $data_pdf[0]->ext_doc_no;?></td>
		</tr>
		<tr>
			<td >&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Departemen</td>
			<td align="left"> : <?php  echo $data_pdf[0]->departement_name;?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">ETD </td>
			<td align="left"> : <?php  echo tgl_indo($data_pdf[0]->ETD);?></td>
		</tr>
		<tr>
			<td >&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Purpose</td>
			<td align="left"> : <?php  echo $data_pdf[0]->purpose;?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Date Create</td>
			<td align="left"> : <?php  echo tgl_jam_indo($data_pdf[0]->date_create);?></td>
		</tr>
		<tr>
			<td >&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Category Request</td>
			<td align="left"> : <?php  echo $data_pdf[0]->cat_req;?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">ID Detail Pros</td>
			<td align="left"> : <?php  echo $data_pdf[0]->id_detail_pros;?></td>
		</tr> 
	</table>
	<br/> 
	<div>
	<table width= "100%" border="0.5" bordercolor="#000000" class='' cellspacing=0 cellpadding=0>
	<tr>
	<td width="100" align="center" colspan="" rowspan="" headers=""><b>ID Detail RO</b></td>
	<td width="60" align="center"  colspan="" rowspan="" headers="" ><b>ID RO</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>ID Stock</b></td>
	<td width="100" align="center" colspan="" rowspan="" headers=""><b>Kode Barang</b></td>
	<td width="190" align="center" colspan="" rowspan="" headers=""><b>Nama Barang</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>Qty</b></td>
	<td width="100" align="center" colspan="" rowspan="" headers=""><b>ID Lokasi</b></td>
	</tr>
		<?php 
			$no = 1;
			foreach ($data_pdf as $data):
		?>
	<tr>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_detail_ro; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_ro; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_stock; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->kode_barang; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->nama_barang; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->qty; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_lokasi; ?></td>
	</tr>
		<? 
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
				<td width="230" align="center">Menyerahkan</td>
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