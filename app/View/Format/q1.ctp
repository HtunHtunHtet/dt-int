
<div id="message1">


<?php echo $this->Form->create('Type',array('id'=>'form_type','type'=>'file','class'=>'','method'=>'POST','autocomplete'=>'off','inputDefaults'=>array(
				
				'label'=>false,'div'=>false,'type'=>'text','required'=>false)))?>
	
<?php echo __("Hi, please choose a type below:")?>
<br><br>

<?php $options_new = array(
 		'Type1' => __('<span class="showDialog" data-id="dialog_1" style="color:blue">Type1</span>
                                <div id="dialog_1" class="hide dialog-description-holder" title="Type 1">
                                    <span class="dialog-description" >
                                        <ul>
                                            <li>Description .......</li>
                                            <li>Description 2</li>
                                        </ul>
                                    </span>
                                </div>
                                '),
		'Type2' => __('<span class="showDialog" data-id="dialog_2" style="color:blue">Type2</span>
                                <div id="dialog_2" class="hide dialog-description-holder" title="Type 2">
 				                    <span class="dialog-description" >
                                        <ul>
                                            <li>Desc 1 .....</li>
                                            <li>Desc 2...</li>
                                        </ul>
 				                    </span>
                                </div>')
		);?>

<?php echo $this->Form->input('type', array('legend'=>false,'required'=>'required', 'type' => 'radio', 'options'=>$options_new,'before'=>'<label class="radio line notcheck decrease-height">','after'=>'</label>' ,'separator'=>'</label><label class="radio line notcheck decrease-height">'));?>

<?php echo $this->Form->button('Submit Form', array('type'=>'submit' , 'class' => 'btn black')); ?>
<?php echo $this->Form->end();?>

</div>

<style>
.showDialog:hover{
	text-decoration: underline;
}

#message1 .radio{
	vertical-align: top;
	font-size: 13px;
}

.control-label{
	font-weight: bold;
}

.wrap {
	white-space: pre-wrap;
}

.dialog-description-holder {
    position: relative;
    top: -2em;
    left: 3em;
}

.decrease-height {
    height:3em;
}

.dialog-description-holder {
    background: white;
    width: 12em;
    padding: 7px;
    margin-left: 11px;
    border:10px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}

.dialog-description-holder:after {
    content: '';
    position: absolute;
    left: -3%;
    top: 10px;
    width: 0;
    height: 0;
    border-bottom: solid 15px white;
    border-right: solid 15px transparent;
    transform: rotate(45deg);
}
</style>

<?php $this->start('script_own')?>
<script>

$(document).ready(function(){
	$(".dialog").dialog({
		autoOpen: false,
		width: '500px',
		modal: true,
		dialogClass: 'ui-dialog-blue'
	});

	
	//$(".showDialog").click(function(){ var id = $(this).data('id'); $("#"+id).dialog('open'); });
	
	$(".showDialog,.dialog-description").on("mouseenter",function () {
	   var getDataId =  $(this).data('id');
	   $("#"+getDataId).removeClass('hide');
    
    }).on("mouseleave",function(){
        var getDataId =  $(this).data('id');
        $("#"+getDataId).addClass('hide');
    })
    
    

})


</script>
<?php $this->end()?>