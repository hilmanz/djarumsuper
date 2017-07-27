<div id="subBar">
    <h3 class="titleModule">Article Management</h3>
    <div class="subnav">
		<?php
         echo $this->element('article_admin_navigation');
        ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
        <h4 class="titlePage">Create Article</h4>
    	<div class="addForm">
            <?php echo $this->element('tinymce'); ?>
            <?php echo $this->Form->create('Article',array('type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
            <div class="row">
                <label>Categories</label>
	        	<div class="categoryList row">
	        		
	        	</div>
                <select id="category" name="category_id">
                    <?php
                        foreach($category as $c):
                    ?>
                    <option value="<?php echo $c['Category']['id']?>"><?php echo $c['Channel']['name']."-".$c['Category']['name']?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
                <input type="button" name="btnSubmit" value="Set Category" id="btnSetCategory"/> <span><a href="#" title="help" id="btnhelp1">?</a></span>
            </div>
            <div class="row">
			<label>Province / Location</label>
			</div>
			<div class="row">
				<select id="province_id" name="province_id">
					<?php
						foreach($provinces as $p):
					?>
					<option value="<?php echo $p['Province']['id']?>"><?php echo $p['Province']['name'];?></option>
					<?php
						endforeach;
					?>
				</select> *) Optional  <span><a href="#" title="help" id="btnhelp2">?</a></span>
			</div>
            <div class="row">
            <label>Title</label>
            <input type="text" id="title" name="title" value="" size="50"/>
            </div>
            <div class="row">
            <label>Summary</label>
            <textarea id="summary" name="summary" value="" cols="50" rows="5"></textarea>
            </div>
            <div class="row">
            <label>Content</label>
            <textarea id="content" name="content" value="" cols="100" rows="20" class="tinymce"></textarea>
            </div>
            <div class="row">
			Youtube Embed Script (optional):
			</div>
			<div class="row">
				<textarea id="youtube" name="youtube"></textarea>
			</div>
            <div class="row">
	        	<label>Status</label>
				<input type="radio" name="status" value="1"/> Published
				<input type="radio" name="status" value="0" checked='checked'/> Unpublished
				</div>
            <div class="rowSubmit">
            <input type="hidden" name="categories" id="categories" value=""/>
            <input type="submit" name="btnSubmit" value="Save Article"/>
            </div>
            <?php echo $this->Form->end();?>
        </div><!-- end .addForm -->
</div><!-- end .content -->

<!-- help dialogs -->
<div id="help1" class="reveal-modal">
  <h2>CATEGORIES</h2>
  <p class="lead">Set kategori untuk artikel ini</p>
  <p>Pilih kategori yang ada di dropdown, lalu klik tombol [Set Category]. <br/>Tips : Anda bisa menset lebih dari 1 kategori untuk artikel ini.</p>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="help2" class="reveal-modal">
  <h2>PROVINCE / LOCATION</h2>
  <p class="lead">Pilihan ini akan membuat artikel anda otomatis masuk ke halaman Trip Advisor</p>
  <p>Pilih Propinsi melalui dropdown. Jika anda tidak ingin memasukkan artikel ini ke dalam halaman trip advisor,
  	 maka cukup memilih "-".</p>
  <a class="close-reveal-modal">&#215;</a>
</div><!-- end of dialogs --> 
<script type="text/javascript">
  $(document).ready(function() {
    $('#btnhelp1').click(function() {
      $('#help1').reveal();
    });
    $('#btnhelp2').click(function() {
      $('#help2').reveal();
    });
  });
</script>
<script type="application/javascript">
<?php if(isset($categories)):foreach($categories as $n=>$cat):?>
	DS.get('edit_article_categories').add(new Category({id:'<?php echo $cat['Category']['id']?>',name:'<?php echo $cat['Category']['name']?>'}));
<?php endforeach;endif;?>
</script>

