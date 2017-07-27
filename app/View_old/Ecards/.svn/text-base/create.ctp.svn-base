<div style="background-color:white;min-height:650px;">
	<div style="margin:5px;"><h3>Make Your Own Ecard</h3></div>
	<div style="margin:5px;">drag and drop the videos or pictures from the left side to the workspace</div>
	<div class="tab">
		<a href="javascript:void(0)" onclick="show_images();return false;">Photos</a>
		<a href="javascript:void(0)" onclick="show_videos();return false;">Videos</a>
	</div>
	<div class="item_container">
	</div>
	<!-- Workspace -->
	<div class="workspace">
		<div class="dropzone">
			<div style="width:2000px;" id="framedragger">
			<div class="segment">
				<span class="bg">Frame 1</span>
				<span id="frame1" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 2</span>
				<span id="frame2" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 3</span>
				<span id="frame3" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 4</span>
				<span id="frame4" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 5</span>
				<span id="frame5" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 6</span>
				<span id="frame6" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 7</span>
				<span id="frame7" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 8</span>
				<span id="frame8" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 9</span>
				<span id="frame9" class="content droppable"></span>
			</div>
			<div class="segment">
				<span class="bg">Frame 10</span>
				<span id="frame10" class="content droppable"></span>
			</div>
			</div>
		</div>
		<div>Drag the frame with mouse.</div>
		<div style="width:100%">
			<span class="previewbtn">
				<a href="javascript:void(0);">Preview Sequence</a>
			</span>
			<span class="savebtn">
				<a href="javascript:void(0);">Save and Send</a>
			</span>
		</div>
		<div class="ecard_preview" style="display:none;">
			<div id="altContent">
				
			</div>
		</div>
		<div class="sendform" style="display:none;">
			<h3>Send To a Friend</h3>
			<div class="sendoption">
				<span class="btn"><a href="javascript:void(0);" onclick="$('.opt_facebook').hide();$('.opt_email').show();return false;">By Email</a></span>
				<span class="btn"><a href="javascript:void(0);" onclick="$('.opt_email').hide();$('.opt_facebook').show();return false;">By Facebook</a></span>
			</div>
			<div class="opt_facebook" style="display:none;">
				<div>
					
				</div>
			</div>
			<div class="opt_email" style="display:none;">
				<?php echo $this->Form->create('Ecard',array('controller'=>'ecards','action'=>'save','type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
				<!--<table>
					<tr>
						<td>Friend Name</td>
						<td><input type="text" name="friend_name" maxlength="20" size="20"/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="friend_email" maxlength="32" size="20"/></td>
					</tr>
					<tr>
						<td colspan="2">-->
							<input type="hidden" id="seqstr" name="seq" value=""/>
							<!--<input type="submit" name="send" value="Send"/>-->
						<!--</td>
					</tr>
				</table>-->
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
	<!-- workspace -->
</div>
<div id="preview" class="reveal-modal">
	
</div>
<script type="application/javascript">
	docroot = "<?php echo $this->Html->url('/',true);?>";
	$(document).ready(function(){
		//-275px - 0px
		$("#framedragger").draggable({axis:"x",
									  drag: function(event, ui) {
									  	if(ui.position.left<-275){
									  		ui.position.left = -275;
									  	}
									  	if(ui.position.left>0){
									  		ui.position.left = 0;
									  	}
									  }});
		$.ajax({
			  url: "<?php echo $this->Html->url("/sample.json",true);?>",
			  dataType:'json',
			  success:function(response){
			  	$.each(response,function(i,v){
			  		ecard_add_item(v);
			  	});
			  	ecard_render_items();
			  }
			});
			$('.previewbtn a').click(function(){
				if(sequence_filled()){
					$(".ecard_preview").html('<div id="altContent"></div>');
					
					$(".ecard_preview").fadeIn();
					//player.set('currentFrame',1);
					//load swf
					var flashvars = {
						req:getSequences(),
						base:docroot,
						seq:""
					};
					var params = {
						menu: "false",
						scale: "noScale",
						allowFullscreen: "false",
						allowScriptAccess: "always",
						bgcolor: "",
						wmode: "direct" // can cause issues with FP settings & webcam
					};
					var attributes = {
						id:"player"
					};
					swfobject.embedSWF(
						docroot+"player.swf", 
						"altContent", "100%", "100%", "10.0.0", 
						docroot+"expressInstall.swf", 
						flashvars, params, attributes);
					//-->
					//console.log("loading player");
					$(".savebtn").fadeIn();
				}
			});
			$('.savebtn a').click(function(){
				//$(".ecard_preview").hide();
				$("#seqstr").val(getSequences());
				//$(".sendform").fadeIn();
				$("#EcardSaveForm").submit();
			});
			
	});
</script>
