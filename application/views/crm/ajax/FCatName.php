<ul class="list-group">
 <?php  
 if(!empty($ajax_data)) { foreach($ajax_data as $data){?>
 
	<li class="list-group-item " onclick="fcatShow('<?php echo $data['id'];?>','<?php echo trim($data['fc_name']);?>');" ><?php echo trim($data['fc_name']);?></li>
	<?php } }else{?>
	<li class="list-group-item">No Facility Category Found</li>
	<?php } ?>
</ul>

                    