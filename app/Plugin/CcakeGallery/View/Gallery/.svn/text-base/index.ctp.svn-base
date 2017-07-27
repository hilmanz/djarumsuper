<?php
	$this->Html->css(array("CcakeGallery.gallery"),null,array('inline'=>false));
?>
<div class="row">
	<div class="span8">
		<div><h3>Gallery</h3></div>
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
	<a href="<?=$this->Html->url('/gallery/view/')?><%=files[i].Gallery.id%>">
		<div class="thumb">
			<img src="<%=S(files[i].Gallery.thumb).escapeHTML().s%>"/>
		</div>
		<div class="caption">
			<%=files[i].Gallery.id+' #'+S(files[i].Gallery.name).escapeHTML().s%>
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
function gallery(){
	if(!loaded[since_id]){
		api_call('<?=$this->Html->url('/gallery/load?since_id=')?>'+since_id,
			function(response){
				if(response.status==1){
					loaded[since_id] = true;
					since_id = response.since_id;
					append_view(tplgallery,'.gallery-list',{files:response.data});
					loading = false; // reset value of loading once content loaded
					$("div.pic").fadeIn(1000);
				}
			});
	}
	
}

$(document).ready(function(){
	gallery();


$(window).scroll(function() {
    if (!loading &&  ($(window).scrollTop() >  $(document).height() - $(window).height()- 100)) {
        loading= true;
        // your content loading call goes here.
        gallery();
       
    }
});

});
</script>