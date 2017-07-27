
<?php $this->Html->css("CcakeFileManager.CcakeFileManager",null,array('inline'=>false)); ?>
<?php
	$this->Html->script(array('Ccake.ccake','CcakeFileManager.d_uploader'),array('inline'=>false));
?>

<div class='container'>
	<div class="row fm-header">
		<div class="span12">
			<h3 class="fl">File Manager</h3>
			
		</div>
	</div>
	<div class="row">
		<div class='span3'>
			<div class="fm-sidebar">
				
			</div>
			<div>
				<div class="fm-addFolder" data-toggle="modal" data-target="#newFolderModal">
				<h5>New Folder</h5>
				</div>
				
			</div>
		</div>
		<div class='span9'>
			<div class="fm-folder-content">
				<span class="fl"><h5 class="title">Loading Folders..</h5></span>
				<span class="fr">
					<a id="btn_upload" href="#popup-upload" class="btn btn-warning fr fr-button" 
					data-toggle="modal" data-target="#uploadModal"><li class="icon-circle-arrow-up"></li>&nbsp;UPLOAD FILE</a>
					<!--<a id="btn_remove_folder" href="#" class="btn btn-warning fr fr-button" 
					data-toggle="modal" data-target="#DeleteFolderModal"><li class="icon-trash"></li>&nbsp;REMOVE FOLDER</a>-->

				</span>
			</div>
			<hr class="hr-folder-content">
			<div id="folder-content" class="fm-content fm-scroll">
				
				
			</div>
		</div>
	</div>
</div>

<!-- modals -->
<div id="uploadModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Upload New File</h4>
  </div>
  <div class="modal-body">
  	<div class="fileuploadform">
	    <p>Click browse button and then select 1 or more files to be uploaded.</p>
	    <form id="uploadForm" enctype="multipart/form-data" method="post">
	        <input type="file" name="file[]" multiple='multiple'/>
	        <input type="hidden" name="container" value="images"/>
	    </form>
	</div>
	<div class="uploadresult">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn-upload btn btn-primary">Upload</button>
  </div>
</div>

<div id="newFolderModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Create New Folder</h4>
  </div>
  <div class="modal-body">
  	<div class="newfolderform">
	    <form id="newfolder" enctype="application/x-www-form-urlencoded" method="post">
	        <input type="text" name="name" value="" placeholder="Type A Folder Name Here" style="width:510px;"/>
	    </form>
	</div>
	<div class="result">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn-create-folder btn btn-primary">CREATE FOLDER</button>
  </div>
</div>

<div id="DeleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Deleting File</h4>
  </div>
  <div class="modal-body">
  	<div class="txt">
	    
	</div>
	<div class="result">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn-delete-file btn btn-primary">YES DELETE IT !</button>
  </div>
</div>

<div id="DeleteFolderModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Removing Folder</h4>
  </div>
  <div class="modal-body">
  	<div class="txt">
	    
	</div>
	<div class="result">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">CANCEL</button>
    <button class="btn-delete-folder btn btn-primary">YES REMOVE IT !</button>
  </div>
</div>

<script id="tplfoldercontent" type="text/template">
<% for(var i in files){ %>
<div class="fm-files fl file-<%=i%>">

	<span class="fr">
	
	<strong>
		<a href="<%=files[i].download_url%>" target="_blank" title="<%=files[i].filename%>">
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
	<p><%=toFileSizeFormat(files[i].size,2)%>&nbsp;<a href="#" class='deleteBtn' data-no="<%=i%>" data-filename="<%=files[i].filename%>"><i class="icon-trash" title='delete'></i></a></p>
	</span>
</div>
<% } %>
</script>

<script id="tplfolders" type="text/template">
<% for(var i in rs){ var FolderList = rs[i].FolderList;%>
<% try { %>
<div class="fm-folders folder-<%=FolderList.name%>" data-total="<%=FolderList.total_files%>">
	<h5><a href="#/d/<%=S(FolderList.name).slugify().s%>"><%=FolderList.name%></a>
	<span class="fui-arrow-right"></span></h5>
	<p><%=number_format(FolderList.total_files)%> Files</p>
</div>
<% }catch(e){} %>
<% } %>
</script>

<script id="tplfolderload" type="text/template">
<span class="loading">
<img src="<?=$this->Html->url('/img/ajax-loader.gif')?>" class="fl" style="margin-top:8px;margin-right:10px">
<p style="">Retrieving Files, Please wait..</p>
</span>
</script>

<script id="tplspin" type="text/template">
<span class="loading">
<img src="<?=$this->Html->url('/img/ajax-loader.gif')?>" class="fl" style="margin-top:8px;margin-right:10px">
<p style="">Please wait..</p>
</span>
</script>

<script>
var App = Backbone.Router.extend({
  routes: {
    "d/:folder_name": "read_folder",   
  },
  read_folder: function(folderName) {
  	folderName.split('__').join('/');
    read_folder(folderName);
  },
});
var app = new App();
Backbone.history.start();
var current_folder = '';
var file_to_delete = '';
var file_no = 0;
function folder_list(){
	//render_view(tplfoldercontent,'#folder-content',response.data);
	api_call('<?=$this->Html->url("/adm/ccake_file_manager/upload/get_folders")?>',
		function(response){
			if(response.status==1){
				prepend_view(tplfolders,'.fm-sidebar',{rs:response.data});
				if(current_folder==''){
					try{
						current_folder = response.data[0].FolderList.name;
					}catch(e){
						current_folder = '';
					}
					
				}
				read_folder(current_folder);
				init_folder_btn_events();
			}
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
				if(folder!=''){
					$("#btn_remove_folder").show();
					$("#btn_upload").show();
				}else{
					$("#btn_remove_folder").hide();
					$("#btn_upload").hide();
				}
				//attach events
				$(".deleteBtn").click(function(e){
					file_to_delete = $(this).attr('data-filename');
					file_no = $(this).attr('data-no');
					$("#DeleteModal").find('div.txt').html('Are you sure to delete `'+file_to_delete+'` permanently ?');
					$("#DeleteModal").modal('show');
				});
				$(".fm-files").mouseover(function(e){
					$(this).addClass('fm-files-over');
				}).mouseout(function(e){
					$(this).removeClass('fm-files-over');
				});
			}else{

			}
	});
}

function init_folder_btn_events(){
	//fm-folders mouseover/out
	$('.fm-folders, .fm-files').mouseover(function(e){
		$(this).addClass('fm-folders-over');
	}).mouseout(function(e){
		$(this).removeClass('fm-folders-over');
	}).click(function(e){
		document.location = $(this).find('a').attr('href');
	});
}
$(document).ready(function(){
	folder_list();
	$('ul.folder').superfish();
	$('.fm-addFolder').mouseover(function(e){
		$(this).addClass('fm-folders-over');

	}).mouseout(function(e){
		$(this).removeClass('fm-folders-over');		
	});


	
	$(".btn-create-folder").click(function(e){
		var fd = $("#newfolder").find('input[name=name]').val();
		$('#newFolderModal div.result').show();
		$("#newFolderModal div.newfolderform").hide();
		render_view(tplspin,'#newFolderModal div.result p',[]);
		$("#newFolderModal .btn-create-folder").hide();
		api_call('<?=$this->Html->url("/adm/ccake_file_manager/upload/new_folder?name=")?>'+S(fd).slugify().s,
			function(response){
				if(response.status==1){
					//$("#newFolderModal").fadeOut();
					$("#newFolderModal").find('div.result').find('p').html('New Folder has been added successfully !');
					prepend_view(tplfolders,'.fm-sidebar',{rs:[response.data]});
				}else{
					$("#newFolderModal").find('div.result').find('p').html('Sorry, unable to create new folder. Please try again later !');
				}
		});
		
	});

	$("#uploadForm").file_uploader('<?=$this->Html->url("/adm/ccake_file_manager/upload")?>',
	{
	    beforeSend:function(e){
	        $(this).parent().find('.progress').removeClass('hidden');
	    },
	    success:function(e){
	        $(".fileuploadform").hide();
	        $(".uploadresult").fadeIn();

	        var o = JSON.parse(e);
	        
	        if(o.status==1){
	          $(".uploadresult").find('p').html('Upload Completed !');
	          $(".fm-sidebar").find('.folder-'+current_folder).attr('data-total',parseInt(o.total));
	          $(".fm-sidebar").find('.folder-'+current_folder).find('p').html(parseInt(o.total)+' Files');
	        }else{
	           $(".uploadresult").find('p').html('Upload Failed ! Please try again later !');
	        }
	        read_folder(current_folder);
	        $('.btn-upload').hide();
	    },
	    error:function(e){
	        console.log("error : "+e);
	    },
	    data:{
	    	'path':'images/'
	    },
	    trigger:'.btn-upload'
	});
	$('#uploadModal').on('shown', function () {
		$("#uploadForm").find('input[name=container]').val(current_folder);
		$("#uploadForm").find('input[type=file]').show();
		$("#progress").hide();
		$(".fileuploadform").show();
		$(".uploadresult").hide();
		$('.btn-upload').show();
	});
	$("#newFolderModal").on('shown',function(){
		$('#newFolderModal div.result').hide();
		$("#newFolderModal .btn-create-folder").show();
		$("#newFolderModal div.newfolderform").show();
		$("#newfolder").find('input[name=name]').val('');

	});

	
	$("#DeleteModal").on('show',function(e){
		$("#DeleteModal").find('div.txt').show();
		$("#DeleteModal").find('div.result').hide();
		$("#DeleteModal").find('div.modal-footer').show();
		
	});
	$(".btn-delete-file").click(function(e){
		$("#DeleteModal").find('div.txt').hide();
		$("#DeleteModal").find('div.modal-footer').hide();
		$("#DeleteModal").find('div.result').show();
		$("#DeleteModal").find('div.result').find('p').text('Deleting the file...');
		api_call('<?=$this->Html->url("/adm/ccake_file_manager/upload/delete?folder=")?>'+
					S(current_folder).slugify().s+
					'&file='+file_to_delete,
			function(response){
				if(response.status==1){
					//$("#newFolderModal").fadeOut();
					$("#DeleteModal").find('div.result').find('p').html('`'+file_to_delete+'` has been removed successfully !');
					//remove the file from the list
					$('.file-'+file_no).remove();
					$(".fm-sidebar").find('.folder-'+current_folder).attr('data-total',parseInt(response.data.total));
	          		$(".fm-sidebar").find('.folder-'+current_folder).find('p').html(parseInt(response.data.total)+' Files');
				}else{
					$("#DeleteModal").find('div.result').find('p').html('Sorry, unable to remove `'+file_to_delete+'`. Please try again later !');
				}

		});
	});


	$("#DeleteFolderModal").on('shown',function(e){
		$("#DeleteFolderModal").find('div.txt').show();
		$("#DeleteFolderModal").find('div.result').hide();
		$("#DeleteFolderModal").find('div.modal-footer').show();
		$("#DeleteFolderModal").find('div.txt').html('Removing `'+current_folder+'` will also deleting all the files inside permanently. Are you sure ?');
		
		
	});
	$(".btn-delete-folder").click(function(e){
		$("#DeleteFolderModal").find('div.txt').hide();
		$("#DeleteFolderModal").find('div.modal-footer').hide();
		$("#DeleteFolderModal").find('div.result').show();
		$("#DeleteFolderModal").find('div.result').find('p').text('Deleting the folder...');
		api_call('<?=$this->Html->url("/adm/ccake_file_manager/upload/remove_folder?folder=")?>'+
					S(current_folder).slugify().s,
			function(response){
				if(response.status==1){
					//$("#newFolderModal").fadeOut();
					$("#DeleteFolderModal").find('div.result').find('p').html('`'+current_folder+'` has been removed successfully !');
					//refresh the folder list
					current_folder = '';
					folder_list();
				}else{
					$("#DeleteFolderModal").find('div.result').find('p').html('Sorry, unable to remove `'+current_folder+'`. Please try again later !');
				}
				$("#DeleteModal").find('div.txt').find('p').html();
		});
	});

	document.location="#";
});


</script>