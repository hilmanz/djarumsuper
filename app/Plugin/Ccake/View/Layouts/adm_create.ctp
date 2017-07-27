<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script(array("Ccake.ccake","ace/ace"),array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_layouts_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Create New Layout</h4>
			</div>
			
			<div class="row">
				<div class="alert msg" style="display:none;"></div>	
					<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
						<tr><td>
							<input type="text" name="name" value="" placeholder="Type layout name.."/>
						</td></tr>
						<tr>
							<td>
							<div id="editor" style="width:100%;height:600px;">write html here..</div>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#" class="btn btn-hg btn-success" id="btn-save">Create</a>
							</td>
						</tr>
					</table>
			</div>
		</div>

	</div>
</div>

<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/html");

    $("#btn-save").click(function(e){
    	api_post('<?=$this->Html->url('/adm/ccake/layouts/add')?>',
    				{name:$('input[name=name]').val(),
    				 slug:S($('input[name=name]').val()).slugify().s,
    				 html:editor.getSession().getValue()},
    				function(response){
    					if(response.status==1){
    						$('.msg').html('The new layout has been saved successfully !');
    						$('.msg').show();
    						setTimeout(function(){
    							$('.msg').fadeOut();
    						},5000);
    					}else{
    						$('.msg').html('Cannot save the layout, please try again later !');
    						$('.msg').show();
    						setTimeout(function(){
    							$('.msg').fadeOut();
    						},5000);
    					}
    				});
    });
</script>