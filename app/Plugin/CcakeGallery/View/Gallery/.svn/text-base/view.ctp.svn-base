<?php
	$this->Html->css(array("CcakeGallery.gallery"),null,array('inline'=>false));
?>
<div class="row">
	<div class="span8">
		<div><h3>Gallery - <?=h($gallery['name'])?></h3></div>
		<div class="gallery-list">

		</div>
	</div>
	<div class="span4">
		side bar nih
	</div>
</div>

<script id="tplgallery" type="text/template">
<% for(var i in files) { %>
	
<% try { %>
<div class="pic" style="display:none">
	<a href="<?=$this->Html->url('/')?><%=files[i].Picture.file%>" class="fancybox" 
		title="<%=S(files[i].Picture.caption).escapeHTML().s%>">
		<div class="thumb">
			<img src="<%=S(files[i].Picture.thumb).escapeHTML().s%>"/>
		</div>
		<div class="caption">
			<%=S(files[i].Picture.caption).escapeHTML().s%>
		</div>
	</a>
</div>
<% } catch(e){console.log(e.message);} %>
<% } %>
</script>

<script>
var since_id = 0;
var loading= false;
var loaded = [];
function pics(){
	if(!loaded[since_id]){
		api_call('<?=$this->Html->url('/gallery/pics/'.$gallery['id'].'?since_id=')?>'+since_id,
			function(response){
				if(response.status==1){
					loaded[since_id] = true;
					since_id = response.since_id;
					append_view(tplgallery,'.gallery-list',{files:response.data});
					loading = false; // reset value of loading once content loaded
					$("div.pic").fadeIn(1000);
					$(".fancybox").fancybox({
						helpers		: {
											title	: { type : 'inside' },
											buttons	: {}
										}
					});
				}
			});
	}
	
}

$(document).ready(function(){
	pics();


$(window).scroll(function() {
    if (!loading &&  ($(window).scrollTop() >  $(document).height() - $(window).height()- 100)) {
        loading= true;
        // your content loading call goes here.
       pics();
       
    }
});

});
</script>