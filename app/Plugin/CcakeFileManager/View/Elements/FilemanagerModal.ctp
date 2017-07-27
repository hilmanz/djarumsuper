
<div id="fmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:<?=$width?>px;margin-left:<?=((-$width/2) - 30)?>px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Browse Files</h4>
  </div>
  <div class="modal-body">
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
	</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
     <button id="fm_btnSelect" class="btn-upload btn btn-primary">SELECT</button>
  </div>
</div>


<script>
var current_folder = '';
var image_only = <?=intval($image_only)?>;
</script>
<script id="tplfolders" type="text/template">
<select name="assets" class="select-block">
<% for(var i in rs){ var FolderList = rs[i].FolderList;%>
  <% if(FolderList.name != null) {  %>
  <option value="<%=FolderList.name%>"><%=FolderList.name%></option>
  <% } %>
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
  <% if(image_only==0){ %>
    <strong>
    <a id="<%=i%>" href="javascript:plugin_attach_content('<%=files[i].download_url%>','<%=i%>');" title="<%=files[i].filename%>" data-filename='<%=files[i].filename%>'>
    <div class="flag"><p class="input-icon fui-check-inverted" style="display:none;"></p></div>
    <% if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(files[i].filename)){  %>
      <div class="thumb">
      <img src="<%=files[i].thumb_url+files[i].filename%>"
          onerror="$(this).attr('src','<%=files[i].download_url%>');"/></div>
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

  <% } else { %>
      
      <% if((/\.(gif|jpg|jpeg|tiff|png)$/i).test(files[i].filename) ){ %>
        <strong>
        <a id="<%=i%>" href="javascript:plugin_attach_content('<%=files[i].download_url%>','<%=i%>');" title="<%=files[i].filename%>" data-filename='<%=files[i].filename%>'>
        <div class="flag"><p class="input-icon fui-check-inverted" style="display:none;"></p></div>
        <div class="thumb">
        <img src="<%=files[i].thumb_url+''+files[i].filename%>"
          onerror="$(this).attr('src','<%=files[i].download_url%>');"/></div>
        </a>
         <% 
          var filename = files[i].filename;
          if(filename.length > 20){
            filename = filename.substring(0,20)+'...';
          }
          %>
          <%=filename%>

      <% } %>

  <% } %>
  </span>
</div>
<% } %>
</script>


<script>
var selectedAssets = [];

function folder_list(){
  //render_view(tplfoldercontent,'#folder-content',response.data);
  api_call('<?=$this->Html->url("/ccake_file_manager/upload/get_folders")?>',
    function(response){
      if(response.status==1){
        try{
          render_view(tplfolders,'#assetslist',{rs:response.data});  
        }catch(e){console.log(e.message);}
        
        if(current_folder==''){
          try{
            current_folder = response.data[0].FolderList.name;
          }catch(e){
            current_folder = '';
          }
        }
        init_plugin_events();
        read_folder(current_folder);
        
      }
  });
}

function plugin_attach_content(url,id){
    var is_exists = false;
    if(typeof selectedAssets[id] === 'undefined'){
      selectedAssets[id] = 0;
    }
    if(selectedAssets[id]==0){
      selectedAssets[id] = 1;
      $("#"+id).find('.flag').find('p').show();
    }else{
      selectedAssets[id] = 0;
      $("#"+id).find('.flag').find('p').hide();
    }
}

function init_plugin_events(){
  
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
  api_call('<?=$this->Html->url("/ccake_file_manager/upload/folder?folder=")?>'+S(folder).slugify().s,
    function(response){
      if(response.status==1){
          if(response.data.files.length>0){
            render_view(tplfoldercontent,'#folder-content',response.data);
            init_plugin_events();  
          }
      }
  });
}

$(document).ready(function(){
  $("#fm_btnSelect").click(function(e){
      filenames = [];
      for(var i in selectedAssets){
        if(selectedAssets[i]==1){
          filenames.push($("#"+i).attr('data-filename'));  
        }
      }
      <?php if(isset($callback)):?>
      <?=$callback?>(current_folder,filenames);
      <?php endif;?>
      $("#fmModal").modal('hide');
  });

  $("#fmModal").bind('shown',function(e){
      selectedAssets = [];
      $(".flag").find('p').hide();
      
  });

  folder_list();
});
</script>