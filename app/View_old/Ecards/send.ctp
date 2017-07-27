<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo Configure::read('Facebook2.appId');?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="application/javascript">
	function postToFeed() {
        // calling the API ...
        var obj = {
          method: 'feed',
          link: '<?php echo $domain.$this->Html->url("/ecards/view/?card={$card_token}");?>',
          picture: '<?php echo $domain.$this->Html->url("/content/ecard/{$thumb}");?>',
          name: 'Multimedia E-Card',
          caption: '<?php echo "Check out my e-card";?>',
          description: 'lorem ipsum dolor sit amet'
        };
        function callback(response) {}
        FB.ui(obj, callback);
      }
</script>
<div id="fbroot"></div>
<div style="background-color:white;min-height:650px;">
		<div style="margin:5px;"><h3>SENDING YOUR ECARD</h3></div>
		<div style="margin:5px;"><?php echo $msg;?></div>
		<div>
		<?php if(isset($success)):?>
		<a href="javascript:void(0);" onclick="postToFeed();return false;" class="shareFB">&nbsp;</a>&nbsp;&nbsp;
		<?php endif;?>
		<a href="<?php echo $this->Html->url('/ecards/create',true);?>">Continue &gt;&gt;</a>
		</div>
</div>
