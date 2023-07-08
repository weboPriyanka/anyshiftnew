<!-- [ Main Content ] start -->
<div class="row" style="display:none;">
    <!-- [Total-user section] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body" style="padding:10px;">
                <div class="col-sm-9" style="clear:right;float:left">
                    <button id="btn0" type="button" class="btn btn-info load_ajax_data" data-value="0">All</button>
                    <button id="btn1" type="button" class="btn btn-warning load_ajax_data" data-value="1">Today</button>
                    <button id="btn2" type="button" class="btn btn-warning load_ajax_data" data-value="2">Yesterday</button>
                    <button id="btn3" type="button" class="btn btn-warning load_ajax_data" data-value="3">This Week</button>
                    <button id="btn4" type="button" class="btn btn-warning load_ajax_data" data-value="4">Last Week</button>
                    <button id="btn5" type="button" class="btn btn-warning load_ajax_data" data-value="5">This Month</button>
                    <button id="btn6" type="button" class="btn btn-warning load_ajax_data" data-value="6">Last Month</button>
                </div>
                <div class="col-sm-3" style="float:right">
                    <div class="input-daterange input-group " id="datepicker_range">
                        <input type="text" class="form-control text-left" placeholder="Start date" id="start_date_stat" name="start">
                        <input type="text" class="form-control text-right" placeholder="End date" id="end_date_stat" name="end">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<div class="clear-fix clearfix"></div>
    <section id="divUsersStats">
    <div class="row">
    <!-- [Total-user section] start -->
								
   </div>
    </section>
<style>
    .datepicker>.datepicker-days {
        display: block !important;
    }
	.modebar-container{display:none;}
</style>

  <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
   
  <!-- Plotly.js -->
  <script src="https://cdn.plot.ly/plotly-2.16.1.min.js"></script>
<script> 
var data = [
  {
    domain: { x: [0, 1], y: [0, 1] },
    value: <?php echo $percentage;?>,
    title: { text: "Speed" },
    type: "indicator",
    mode: "gauge+number",
    delta: { reference: 380 },
    gauge: {
      axis: { range: [null, 100] },
      
      threshold: {
        line: { color: "<?php echo $color;?>", width: 4 },
        thickness: 1,
        value: 490
      }
    }
  }
];
var data = [
  {
    type: "indicator",
    mode: "gauge+number",
    value: <?php echo $balance;?>,
    gauge: {
      axis: { range: [null, <?php echo $credit;?>], tickwidth: 1, tickcolor: "<?php echo $color;?>" },
      bar: { color: "<?php echo $color;?>" },
      bgcolor: "white",
      borderwidth: 2,
      bordercolor: "gray",
	  
      threshold: {
        line: { color: "<?php echo $color;?>", width: 4 },
        thickness: 0.75,
        value:  <?php echo $credit;?>
      }
    }
  }
];
var layout = {
  width: '50%',
  height: '50%',
  margin: { t: 25, r: 25, l: 25, b: 25 },
  font: { color: "#111", family: "inherit",size:"14px",weight:"400" }
};

Plotly.newPlot('myDiv', data, layout);

</script>
