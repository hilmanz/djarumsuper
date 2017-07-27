<?php $this->Html->css("CcakeFileManager.CcakeFileManager",null,array('inline'=>false)); ?>
<?php
	$this->Html->script(array('Ccake.ccake'),array('inline'=>false));
?>
<div class="navbar">
	<div class="navbar-inner">
		<div class="fm-plugin-title">Assets</div>
		<div id="assetslist" class="navbar-form pull-left">
		  
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span-12">
		<div id="folder-content" class="fm-content fm-scroll">
					
		</div>
	</div>
</div>

<script id="tplfolders" type="text/template">
<select name="assets" class="select-block">
<% for(var i in rs){ var FolderList = rs[i].FolderList;%>
	<option value="<%=FolderList.name%>"><%=FolderList.name%></option>
<% } %>
</select>
</script>
<script id="tplfolderload" type="text/template">
<span class="loading">
<img src="<?=$this->Html->url('/img/ajax-loader.gif')?>" class="fl" style="margin-top:8px;margin-right:10px">
<p style="">Retrieving Files, Please wait..</p>
</span>
</script>


<script id="tplfoldercontent" type="text/template">
<% for(var i in files){ %>
<div class="fm-files fl file-<%=i%>">

	<span class="fr">
	
	<strong>
		<a href="javascript:plugin_attach_content('<%=files[i].download_url%>');" title="<%=files[i].filename%>">
		<% if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(files[i].filename)){  %>
			<div class="thumb"><img src="<%=files[i].thumb_url+files[i].filename%>"/></div>
		<% } %>
		<% 
		var filename = files[i].filename;
		if(filename.length > 20){
			filename = filename.substring(0,20)+'...';
		}
		%>
		<%=filename%>
		</a>
	</strong>
	
	</span>
</div>
<% } %>
</script>


<script>
var current_folder = '';
folder_list();
function folder_list(){
	//render_view(tplfoldercontent,'#folder-content',response.data);
	api_call('<?=$this->Html->url("/adm/ccake_file_manager/upload/get_folders")?>',
		function(response){
			if(response.status==1){
				render_view(tplfolders,'#assetslist',{rs:response.data});
				if(current_folder==''){
					try{
						current_folder = response.data[0].FolderList.name;
					}catch(e){
						current_folder = '';
					}
				}
				read_folder(current_folder);
				init_events();
			}
	});
}

function plugin_attach_content(url){
    var parentWin = (!window.frameElement && window.dialogArguments) || opener || parent || top;
    var parentEditor = parentWin.ccake_editor;
    var html = '';
    //ok we need to see if its an image or just the other file.
    if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(url)){
    	html = "<img src='"+url+"'/>";
    }else{
    	html = "<a href='"+url+"'>"+url+"</a>";
    }
    parentEditor.insertContent(html);
    parentWin.ccake_popup.close();
}
function init_events(){
	$(".fm-files").mouseover(function(e){
		$(this).addClass('fm-files-over');
	}).mouseout(function(e){
		$(this).removeClass('fm-files-over');
	});

	$("select[name=assets]").change(function(e){
		current_folder = $(this).val();
		read_folder(current_folder);
	});
}
function read_folder(folder){
	current_folder = folder;
	$('.fm-folder-content').find('h5.title').html('/'+folder);
	//loader
	render_view(tplfolderload,'#folder-content',[]);
	api_call('<?=$this->Html->url("/adm/ccake_file_manager/upload/folder?folder=")?>'+S(folder).slugify().s,
		function(response){
			if(response.status==1){
				render_view(tplfoldercontent,'#folder-content',response.data);
				init_events();
			}
	});
}
</script>