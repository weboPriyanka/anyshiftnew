
<ul class="list-group">
 <?php  
 if(!empty($ajax_data)) { foreach($ajax_data as $data){?>
 
	<li class="list-group-item " onclick="jobShow('<?php echo $data['id'];?>','<?php echo trim($data['job_title']);?>');" ><?php echo trim($data['job_title']);?></li>
	<?php } }else{?>
	<li class="list-group-item">No Job Found</li>
	<?php } ?>
</ul>

                    