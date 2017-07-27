
<?php
  $this->Html->script(array('CcakeFileManager.d_uploader'),array('inline'=>false));
?>
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
          <input type="hidden" name="base_path" value="<?=Configure::read('UPLOAD_DIR')?>"/>
	    </form>
	</div>
	<div class="uploadresult">
		<p></p>
	</div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-close" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn-upload btn btn-primary">Upload</button>
  </div>
</div>

<script>
var base_path = '<?=$base_path?>';
var current_folder = S("<?=$current_folder?>").slugify().s;

$("#uploadForm").file_uploader('<?=$this->Html->url("/ccake_file_manager/upload")?>',
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
           
          }else{
             $(".uploadresult").find('p').html('Upload Failed ! Please try again later !');
          }
          $('.btn-upload').hide();
          <?php
            if(!isset($callback)){
              $callback = "upload_callback";
            }
          ?>
          <?php echo $callback;?>(current_folder,o.files);
      },
      error:function(e){
          console.log("error : "+e);
      },
      data:{
        'path':'images/',
        'base_path':base_path
      },
      trigger:'.btn-upload'
  });
  $(".btn-file-upload").click(function(){
    $('#uploadModal').addClass('in');
    $('#uploadModal').fadeIn();
    $("#uploadForm").find('input[name=container]').val(current_folder);
    $("#uploadForm").find('input[name=base_path]').val(base_path);
    console.log(base_path);
    $("#uploadForm").find('input[type=file]').show();
    $("#progress").hide();
    $(".fileuploadform").show();
    $(".uploadresult").hide();
    $('.btn-upload').show();
  });
  $('button.close,.btn-close').click(function(e){
    $('#uploadModal').fadeOut();
    $(".modal-backdrop").hide();
  });

  
</script>