<?php $this->Html->css(array('Ccake.ccake',"CcakeGallery.CcakeGallery"),null,array('inline'=>false)); ?>
<?php
	$this->Html->script(array('Ccake.ccake'),array('inline'=>false));
?>
<div class='container'>
	<div class="row gallery-header">
		<div class="span12">
			<h3 class="fl"><?=h(strtoupper($gallery['Gallery']['name']))?></h3>
		</div>
	</div>
	<div class="row">
		<div class="span12 gallery-desc">
			<span class="txtdesc"><?=$gallery['Gallery']['description']?></span>
			<span class="txtdesc-edit" style="display:none"><input type="text" name="edited_desc" value="<?=$gallery['Gallery']['description']?>"/></span>
			<a href="#" class="btn-edit-desc"><span class="icon-pencil"></span></a>
		</div>
	</div>
	<div class="row">
		<div class="span12 gl-form">

			<?php echo $this->Filemanager->uploadButton('Upload Manually');?>
			<?php
				echo $this->Filemanager->triggerButton('Browse from Assets');
			?>
			<div class="img-msg alert" style="display:none;"></div>
			<a href="#" class="btn btn-warning btn-save fr" style="display:none;">
				Save Changes
			</a>
			<a href="<?=$this->Html->url('/adm/ccake_gallery/')?>" class="btn btn-info fr" >
				Back to List
			</a>
		</div>
	</div>
	<div class="row">
		<div class="span12 gl-content">
			<div class="gallery-list">

			</div>
		</div>
	</div>
</div>


<div id="confirmDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Confirmation</h4>
  </div>
  <div class="modal-body">
  	<div class="confirmtext">
	    <p>Do you really want to delete these picture ? </p>
	</div>
	<div class="result">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn-confirm-delete-pic btn btn-primary">Yes</button>
  </div>
</div>

<script id="tplpics" type="text/template">
<% for(var i in pics){ %>
<div class="gallery-panels new-img" data-filename="<%=pics[i].file%>" data-folder="<%=pics[i].folder%>">
	<div class="thumb">
		<img src="<?=$this->Html->url('/files')?>/<%=pics[i].folder%>/thumbs/0_<%=pics[i].file%>"
		onerror="$(this).attr('src','<?=$this->Html->url('/files/')?><%=pics[i].folder%>/<%=pics[i].file%>');"
		/>
	</div>
	<div class="caption">
		<input type="text" name="caption" value="" placeholder="Type here.."/>
	</div>
</div>
<% } %>
</script>
<script id="tplcurrent" type="text/template">
<% for(var i in pics){ %>
<div class="gallery-panels panel-<%=pics[i].id%>">
	<div class="thumb">
		<img src="<?=$this->Html->url('/files')?><%=pics[i].thumbs%>" onerror="$(this).attr('src','<?=$this->Html->url('/files/')?><%=pics[i].file%>');"/>
	</div>
	<div class="caption">
		<span class="fl txtcaption"><%=pics[i].caption%></span>
		<a href="#" data-id='<%=pics[i].id%>' class="btn-delete-pic">
			<span class="icon-trash"></span></a>
		<a href="#" class="btn-edit-caption"><span class="icon-pencil"></span></a>
	</div>
	<div class="caption-edit" style="display:none;" data-id="<%=pics[i].id%>">
		<input type="text" name="caption" value="<%=pics[i].caption%>" placeholder="Type here.." class="caption-new"/>
	</div>
</div>
<% } %>
</script>

<?php
	$this->Filemanager->setDefaultFolder($gallery['Gallery']['name']);
	echo $this->Filemanager->embed(960,true,'onBrowseAssets','onFileUploaded');
?>
<script>
var default_folder = S("<?=$gallery['Gallery']['name']?>").slugify().s;
var pictures = [];
var selected_id = 0;
function onFileUploaded(folder_name,files){
	pictures = [];
	for(var i in files){
		pictures.push({folder:folder_name,file:files[i]});	
	}
	append_view(tplpics,".gallery-list",{pics:pictures});
	$(".btn-save").show();
}
function onBrowseAssets(folder_name,files){
	pictures = [];
	for(var i in files){
		pictures.push({folder:folder_name,file:files[i]});	
	}
	append_view(tplpics,".gallery-list",{pics:pictures});
	$(".btn-save").show();
}
function reload_pictures(){
	$(".gallery-list").html('loading..');
	api_call('<?=$this->Html->url('/adm/ccake_gallery/gallery/load/?gallery_id='.$gallery_id)?>',
				function(response){
					if(response.status==1){
						if(response.data.length>0){
							$(".gallery-list").html('');
							append_view(tplcurrent,".gallery-list",{pics:response.data});
							init_events();
						}else{
							$(".gallery-list").html('');
							$(".img-msg").html('No Pictures available yet');
							$(".img-msg").show().fadeOut(10000);
						}
					}else{
						$(".gallery-list").html('Failed to load the pictures. Please reload !');

					}
				});
}
$(".btn-save").click(function(e){
	
	var files = [];
	var caption = [];
	
	$(".new-img").each(function(i,v){
		files.push($(v).attr('data-folder')+ '/' + $(v).attr('data-filename'));
		caption.push($(v).find('input[name=caption]').val());
	});

	$(".img-msg").html('Saving Assets..');
	api_post('<?=$this->Html->url('/adm/ccake_gallery/gallery/save')?>',
			{gallery_id:<?=$gallery_id?>,files:files,caption:caption},
			function(response){
				if(response.status == 1){
					//upload completed
					$(".img-msg").html('Save completed !').fadeOut(10000);
				}else{
					$(".img-msg").html('Failed to save the new pictures !').fadeOut(10000);
				}
			reload_pictures();
			$(".btn-save").hide();
	});
});

function init_events(){
	$('.btn-edit-caption').click(function(e){
		$(this).parent().parent().find('div.caption').hide();
		$(this).parent().parent().find('div.caption-edit').show();
	});

	$('.caption-new').change(function(e){
		var pic_id = $(this).parent().attr('data-id');
		$(".panel-"+pic_id).find('div.caption-edit').hide();
		$(".panel-"+pic_id).find('div.caption').show();
		var old_caption = $(".panel-"+pic_id).find('div.caption').find('span.txtcaption').html();
		var new_caption = $(this).val();
		$(".panel-"+pic_id).find('div.caption').find('span.txtcaption').html('Updating..');
		api_post('<?=$this->Html->url('/adm/ccake_gallery/gallery/update_pic')?>',
				 {
				 	pic_id:pic_id,
				 	caption:new_caption
				 },
		function(response){
			if(response.status==1){
				$(".panel-"+pic_id).find('div.caption').find('span.txtcaption').html(new_caption);
			}else{
				$(".panel-"+pic_id).find('div.caption').find('span.txtcaption').html(old_caption);
			}
		});
	});

	
	$('.btn-delete-pic').click(function(e){
		selected_id = parseInt($(this).attr('data-id'));
		$("#confirmDelete").find('div.confirmtext').show();
		$("#confirmDelete").find('div.result').hide();
		
		$('.modal-footer').show();
		$("#confirmDelete").modal('show');

	});

}
$('.btn-confirm-delete-pic').click(function(e){
		
		//$("#confirmDelete").modal('hide');
		
		$("#confirmDelete").find('div.confirmtext').hide();
		$("#confirmDelete").find('div.result').show();
		$("#confirmDelete").find('div.result').find('p').html('Deleting the gallery, please wait..');
		
		api_call('<?=$this->Html->url('/adm/ccake_gallery/gallery/delete_picture?id=')?>'+selected_id,
			function(response){
				if(response.status==1){
					$("#confirmDelete").find('div.result').find('p').html('The picture has been removed from the gallery successfully !<br/>In order to remove it permanently from server, please delete the file directly from <a href="<?=$this->Html->url('/adm/ccake_file_manager')?>">File Manager</a>');
				}else{
					$("#confirmDelete").find('div.result').find('p').html('Sorry, something is wrong, please try again later !');
				}
				$('.modal-footer').hide();

				$(".panel-"+selected_id).remove();
				selected_id = 0;
		});
		
	});

$(".btn-edit-desc").click(function(e){
	$(this).parent().find('span.txtdesc').hide();
	$(this).parent().find('span.txtdesc-edit').show();
});
$("input[name=edited_desc]").change(function(e){
	$('.gallery-desc').parent().find('span.txtdesc').show();
	$('.gallery-desc').parent().find('span.txtdesc-edit').hide();
	var old_txt = $('.gallery-desc').parent().find('span.txtdesc').html();
	var new_txt = $(this).val();

	$('.gallery-desc').parent().find('span.txtdesc').html('Updating..');
	api_post('<?=$this->Html->url('/adm/ccake_gallery/gallery/update_desc')?>',
				 {
				 	id:<?=intval($gallery['Gallery']['id'])?>,
				 	description:new_txt
				 },
		function(response){
			if(response.status==1){
				$('.gallery-desc').parent().find('span.txtdesc').html(new_txt);
			}else{
				$('.gallery-desc').parent().find('span.txtdesc').html(old_txt);
			}
		});

});
reload_pictures();

</script>