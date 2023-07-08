
<ul class="list-group">
 <?php  
 if(!empty($ajax_data)) { foreach($ajax_data as $data){?>
 
	<li class="list-group-item " onclick="NcatShow('<?php echo $data['id'];?>','<?php echo trim($data['nc_name']);?>');" ><?php echo trim($data['nc_name']);?></li>
	<?php } }else{?>
	<li class="list-group-item">No Care Giver Category Found</li>
	<?php } ?>
</ul>

                    