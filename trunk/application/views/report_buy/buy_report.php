<?php
if (empty($data_pdf)) {
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
<h4 align="center"><b>Purchase Request List</b></h4>
<p></p>
<p></p>
<p></p>
<p></p>
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
			<td align="left"> : <?php echo $data_pdf[0]->ETD;?></td>
		</tr>
		<tr>
			<td align="left">Purpose</td>
			<td align="left"> : <?php echo $data_pdf[0]->purpose;?></td>
			<td>&nbsp;&nbsp;</td>
			<td align="left">Date Create</td>
			<td align="left"> : <?php echo tgl_indo(date('Y-m-d'))?></td>
		</tr>
		<tr>
			<td align="left">Category Request</td>
			<td align="left"> : <?php echo $data_pdf[0]->cat_req;?></td>
		</tr>
	</table>
	<br/>
	<div>
	<table width= "100%" border="0.5" bordercolor="#000000" class='' cellspacing=0 cellpadding=0>
		<tr>
			<td width="50" align="center" colspan="" rowspan="" headers=""><b>ID PO</b></td>
			<td width="160" align="center" colspan="" rowspan="" headers=""><b>Supplier</b></td>
			<td width="100" align="center" colspan="" rowspan="" headers=""><b>Kode Barang</b></td>
			<td width="180" align="center" colspan="" rowspan="" headers=""><b>Nama Barang</b></td>
			<td width="60" align="center" colspan="" rowspan="" headers=""><b>Qty</b></td>
			<td width="150" align="center" colspan="" rowspan="" headers=""><b>Harga</b></td>
			<td width="150" align="center" colspan="" rowspan="" headers=""><b>Total</b></td>
			<td width="180" align="center" colspan="" rowspan="" headers=""><b>Date Create</b></td>
		</tr>
		<?php 
			$no = 1;
			$total = 0;
			foreach ($data_pdf as $data):
		?>
		<tr>
			<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_po; ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo $data->name_vendor; ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo $data->kode_barang; ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo $data->nama_barang ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo $data->qty; ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo "Rp." . number_format($data->price,2,',','.'); ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo "Rp." . number_format($data->total,2,',','.'); ?></td>
			<td colspan="" rowspan=""  align="center" headers=""><? echo  date('d-m-Y',strtotime($data->date_create)); ?></td>
			
		</tr>
		<? 
			$total+=$data->total;
			$no++;
			//foreach
	 	 endforeach; ?>
	 	 <tr>
	 		
	 	 		<td colspan="6" rowspan=""  align="center" headers="">Total</td>
	 	 		<td colspan="2" rowspan=""  align="center" headers=""><strong><? echo "Rp." . number_format($total,2,',','.');?></strong></td>
	 	 </tr>
	</table>
		<br><br>
	<div class="class="footer"">
	</div>
	</div>
</page>
<?php } ?>