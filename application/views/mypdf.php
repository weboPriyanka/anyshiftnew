<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.ss-hm-inn-log-sec ul {
    list-style-type: none;
    display: flex;
    /* align-items: center; */
    padding: 0;
    margin: 0;
}

.ss-hm-inn-log-sec li {
    width: 100%;
}

section.ss-any-main-sec {
    width: 100%;
    margin: auto;
    padding: 32px 30px;
    background: #fff;
}

.ss-hm-inn-log-sec img {
    width: 100%;
}
.ss-hm-inn-log-sec img {
    width: 115px;
}

.ss-hm-inn-log-sec ul li:nth-child(2) {
    text-align: right;
}

body{
	background:#f5f5f5;
	font-family: 'Poppins', sans-serif;

}

.ss-hm-inn-log-sec h2 {
    font-size: 42px;
    font-weight: 700;
    letter-spacing: 0.08em;
    margin-top:-4%;
}

.ss-hm-inn-log-sec {
    border-bottom: 2px solid #0073C7;
}

ul{
	padding:0;
	margin:0;
	list-style-type:none;
}
p{
	margin:0;
	padding:0;
}

.ss-invo-man-div ul {
    display: inline-block;
    width: 100%;
}

.ss-invoice-right-sec ul {
    display: inline-block;
    width: 100%;
    float:right;
    margin-left:60%;
    margin-top:-12%;
}

.ss-invo-man-div li {
    width: 100%;
}

.ss-invoice-right-sec li {
    width: 100%;
}

.ss-invo-man-div p {
    font-size: 15px;
}

.ss-invoice-right-sec li {
    font-size: 15px;
    line-height: 32px;
}

table.table.table-striped thead {
    background: #E63833;
    color: #fff;
    font-weight: 400 !important;
}

table.table.table-striped thead th {
    font-weight: 400;
}
.ss-form-year-sec {
    margin-top: 30px;
    margin-bottom: 30px;
}

.ss-invo-man-div {
    margin-top: 30px;
}

tr.ss-tbl-grand-sec {
    background: #e63833;
    color: #fff;
}

tr.ss-tbl-grand-sec span {
    padding: 0 28px;
}

.table td, .table th{
	font-weight:400;
}
        </style>
  </head>
  <body>

<section class="ss-any-main-sec">
<div class="ss-hm-inn-log-sec">
<ul>

<li>
<img src="<?=base_url()?>app_assets/uploads/logo.png" />
</li>
<li>
<h2>INVOICE</h2>
</li>
</ul>
</div>

<div class="ss-invo-man-div">
<ul>
<li>
<p>Invoice to :</p>
<h6><?=$nurse->cg_fname.' '.$nurse->cg_lname?></h6>
<p><?=$nurse->cg_address?><br>
<?=$nurse->cg_city?>, <?=$nurse->state?> <?=$nurse->cg_zipcode?></p>
</li>
<li>
<div class="ss-invoice-right-sec">
<ul>
<li>Invoice No    <span class="ss--invo-name-code">: #ANYSHYFT<?=$nurse->id.time()?><span></li>
<li>Invoice Date    <span>: <?=date('d M, Y')?><span></li>
<!-- <li>Due Date   <span>: 2023-03-01<span></li> -->
</ul>
</div>
</li>
</ul>

</div>
<div class="ss-form-year-sec">
<h5>From <?=$clock_from_date?> to <?=$clock_to_date?></h5>
</div>

<div class="ss-table-sec">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="width:20%">Date</th>
      <th scope="col" style="width:30%">In-Out</th>
      <th scope="col">Hourly Rate</th>
      <th scope="col">Hours</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <?php $total_hours=0; foreach($clock_data as $row){ ?>
    <tr>
      <th scope="row" style="width:20%"><?=$row->clock_date?></th>
      <td  style="width:30%"><?=$row->clock_in.' - '.$row->clock_out?></td>
      <td style="text-align: right">$<?php if($is_premium == 'yes'){ echo $rate = $job_prem_rate; }else{ echo $rate = $job_rate; } ?></td>
      <td style="text-align: right"><?=$row->total_hours?></td>
      <td style="text-align: right"><?php echo ($row->total_hours * $rate); $total_hours = $total_hours + ($row->total_hours * $rate); ?></td>
    </tr>
    <?php } ?>
   
	
	<tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td style="text-align: right">Subtotal : </td>
      <td style="text-align: right">$<?=$total_hours?></td>
    </tr>
	
	<tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td style="text-align: right">tax (0%) : </td>
      <td style="text-align: right">$0</td>
    </tr>
	
		<tr class="ss-tbl-grand-sec">
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td style="text-align: right">GRAND TOTAL : </td>
      <td style="text-align: right">$<?=$total_hours?></td>
    </tr>
  </tbody>
</table>

</div>


</section>


  </body>
</html>