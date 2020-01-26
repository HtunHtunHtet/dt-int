<div class="row-fluid">
    <div class="alert alert-info">
        <h3>Database Migration</h3>
    </div>
    
    <hr />

    <div class="alert">
        <h3>Import Migration file</h3>
    </div>
	<?php
		echo $this->Form->create('FileUpload',array('enctype'=>'multipart/form-data','type'=>'file'));
		echo $this->Form->input('file', array('label' => 'File Upload', 'type' => 'file'));
		echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
		echo $this->Form->end();
	?>

    <hr />
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ref No</th>
            <th>Receipt No</th>
            <th>Member Name</th>
            <th>Member Pay Type</th>
            <th>Date</th>
            <th>Year</th>
            <th>Month</th>
            <th>Payment Method</th>
            <th>Payment Type</th>
            <th>Renewal Year</th>
            <th>Subtotal</th>
            <th>Tax</th>
            <th>Total</th>
            <th>Created Date</th>
        </tr>
        </thead>
        <tbody>
		<?php
			foreach ($all_transaction as $transaction) :
				?>
                <tr>
                    <td><?php echo $transaction['Transactions']['id']; ?></td>
                    <td><?php echo $transaction['Transactions']['ref_no']; ?></td>
                    <td><?php echo $transaction['Transactions']['receipt_no']; ?></td>
                    <td><?php echo $transaction['Transactions']['member_name']; ?></td>
                    <td><?php echo $transaction['Transactions']['member_paytype']; ?></td>
                    <td><?php echo $transaction['Transactions']['date']; ?></td>
                    <td><?php echo $transaction['Transactions']['year']; ?></td>
                    <td><?php echo $transaction['Transactions']['month']; ?></td>
                    <td><?php echo $transaction['Transactions']['payment_method']; ?></td>
                    <td><?php echo $transaction['Transactions']['payment_type']; ?></td>
                    <td><?php echo $transaction['Transactions']['renewal_year']; ?></td>
                    <td><?php echo $transaction['Transactions']['subtotal']; ?></td>
                    <td><?php echo $transaction['Transactions']['tax']; ?></td>
                    <td><?php echo $transaction['Transactions']['total']; ?></td>
                    <td><?php echo $transaction['Transactions']['created']; ?></td>
                </tr>
			<?php
			endforeach;
		?>
        </tbody>
    </table>
</div>