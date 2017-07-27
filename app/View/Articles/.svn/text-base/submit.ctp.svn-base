<?php $this->Html->css(array("Ccake.ccake"),null,array('inline'=>false)); ?>
<?php $this->Html->script(array("Ccake.ccake"),array('inline'=>false)); ?>

<div class="container">
	<div id="content" class="jurnalPageDetail">
		<div class="wrapper">
			
			 <div class="KirimArtikel">
			 	<?php if(isset($fb_id)):?>
			        <div id="respond" class="replies">
			        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
			            <thead>
			                <tr>
			                    <th colspan="3">
			                        <span>Kirim Artikel</span>
			                    </th>
			                </tr>
			            </thead>
			            <tbody>
			                <tr>
			                    <td valign="top">
									<?php if($submit_trip):?>
										<form action = "<?=$this->Html->url('/articles/submit/trip')?>" 
										method = "post"
										enctype = "application/x-www-form-urlencode">
									<?php else:?>
										<form action = "<?=$this->Html->url('/articles/submit/adventure')?>" 
										method = "post"
										enctype = "application/x-www-form-urlencode">
									<?php endif;?>
			                            <div class="row">
			                                <label>Judul :</label>
			                                <input name="title" type="text" value="" />
			                            </div>
			                            <div class="row">
			                              <label>Jenis Aktifitas :</label>
			                               <select name="category_id">
			                               		<?php foreach($categories as $category):?>
			                               			<option value="<?=$category['Category']['id']?>">
			                               				<?=h($category['Category']['name'])?>
			                               			</option>
			                               		<?php endforeach;?>
			                              	</select> 
			                            </div>
			                            <div class="row">
			                              <label>Propinsi</label>
			                               <select name="province_id">
			                               		<?php foreach($provinces as $province):?>
			                               			<option value="<?=$province['Province']['id']?>">
			                               				<?=h($province['Province']['name'])?>
			                               			</option>
			                               		<?php endforeach;?>
			                              	</select> 
			                            </div>
			                            <?php if(!isset($hide_handicap)):?>
			                            <div class="row">
			                              <label>Tingkat Kesulitan</label>
			                               <select name="province_id">
			                               		<?php for($t=1;$t<=5;$t++):?>
			                               			<option value="<?=$t?>">
			                               				<?=h($t)?>
			                               			</option>
			                               		<?php endfor;?>
			                              	</select> 
			                              	<span class="smalltext">1 -> termudah | 
			                              	5 -> tersulit
			                              	</span>
			                            </div>
			                        	<?php endif;?>
			                            <div class="row">
			                                <label>Koordinat :</label>
			                                <div>
			                                Latitude : <input name="lat" class="koordinat" type="text" value="0.0000" />
			                                Longitude : <input name="lon" class="koordinat" type="text" value="0.0000" />
			                            	</div>
			                            </div>
			                            <div class="row">
			                                <label>Artikel</label>
			                                <textarea name="content" class="tinymce"></textarea>
			                            </div>
			                            <div class="row">
			                                <div style="margin-top:10px;margin-bottom:10px">
												<?php echo $this->Filemanager->uploadButton('Upload Foto');?>
											</div>
											<div class="attachments" style="width:100%;float:left;">
												<table id="attached_pics" width="100%">
													
												</table>
											</div>
			                            </div>
			                            <div class="row">
			                                <label>Embed Code Video (jika ada) :</label>
			                                <textarea name="youtube_video"></textarea>
			                            </div>
			                            <div class="rowSubmit">
			                            	<input type="hidden" name="attachments" value=""/>
			                                <input type="submit" value="SUBMIT" />
			                            </div>
			                        </form>
			                    </td>
			                </tr>
			            </tbody>
			        </table>
			        </div><!-- end .replies -->
		       <?php else:?>
		       		<div class="notLoginMessage">
		       			Untuk bisa mengirimkan jawaban, silahkan 
								<a href="javascript:fblogin();">Login</a> terlebih dahulu.
					</div>
		       	<?php endif;?>
			 </div>
			
			 
		</div>
	</div>
</div>

 <?php echo $this->element('tinymce',array('minimalist'=>true)); ?>

 <?php
	$this->Filemanager->setDefaultFolder('');
	$this->Filemanager->setBaseUploadPath('');
	echo $this->Filemanager->embed(960,true,'onBrowseAssets','onFileUploaded');
?>
<script id="tplpics" type="text/template">

	<% for(var i in pics){ %>
	<tr>
		<td>
			<div class="gallery-panels new-img" data-filename="<%=pics[i].file%>" data-folder="<%=pics[i].folder%>">
				<span class="thumb fl">
					<img style="height:auto;width:200px;" src="<?=Configure::read('UPLOAD_DIR_WWW')?>thumb_<%=pics[i].file%>"
					onerror="$(this).attr('src','<?=$this->Html->url('/img/no_image.gif')?>');"
					/>
					<p>
					
					</p>
				</span>
			</div>
		</td>
		<td>
			<a href='javascript:void(0);' class="icon-trash btn-remove" style="padding-left:20px;" title="Remove">Hapus</a>
		</td>
	</tr>
<% } %>

</script>
<script>

	var pictures = [];
	var selected_id = 0;

	function onFileUploaded(folder_name,files){
		pictures = [];
		var str = '';
		console.log('files',files);
		for(var i in files){
			if(i>0){
				str+=',';
			}
			str += ''+files[i];
			pictures.push({folder:folder_name,file:files[i]});	
		}
		append_view(tplpics,"#attached_pics",{pics:pictures});
		//display the table
		$('.attachments').show();


		if($("input[name='attachments']").val()==''){
			$("input[name='attachments']").val(str);	
		}else{
			$("input[name='attachments']").val($("input[name='attachments']").val()+','+str);
		}

		//attach events
		$('.btn-remove').click(function(e){
			//$(this).parent().parent().parent().attr('data-filename');

			$(this).parent().parent().remove();

			$("input[name='attachments']").val('');
			$('.new-img').each(function(k,item){
				if(k>0){
					$("input[name='attachments']").val($("input[name='attachments']").val()+',');
				}
				$("input[name='attachments']").val($("input[name='attachments']").val() + 
													$(item).attr('data-filename'));
				
			});
		});
	}


</script>