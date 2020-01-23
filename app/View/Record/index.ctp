
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<tbody>
			<?php foreach($records as $key=>$record):?>
			<tr>
				<td><?php echo $key?></td>
				<td><?php echo $record?></td>
			</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
</div>
<?php $this->start('script_own')?>
<script>
    let routeName  = '<?= Router::url(["controller"=>"record","action"=>"getRecords"]); ?>';
    $(document).ready(function(){
        $("#table_records").dataTable({
        
        });
    })
    </script>
<?php $this->end()?>