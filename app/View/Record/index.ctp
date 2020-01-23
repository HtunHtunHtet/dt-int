
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<!--<tbody>
			<?php /*foreach($records as $record):*/?>
			<tr>
				<td><?php /*echo $record['Record']['id']*/?></td>
				<td><?php /*echo $record['Record']['name']*/?></td>
			</tr>	
			<?php /*endforeach;*/?>
		</tbody>-->
	</table>
</div>
<?php $this->start('script_own')?>
<script>
    let routeName  = '<?= Router::url(["controller"=>"record","action"=>"getRecords"]); ?>';
    $(document).ready(function(){
    
        /*
            $.ajax({
                url: routeName
            }).success(function (result) {
               console.log(result);
            });
            */
        
        $("#table_records").dataTable({
            ajax : {
                url: routeName,
                "processing": true,
                "serverSide": true,
                columns:[
                    {data: 'id'},
                    {data: 'name'}
                ]
            }
        });
        

      
    })
    </script>
<?php $this->end()?>