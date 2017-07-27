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
          link: '<?php echo $domain.$this->Html->url("/ecards/view/?card={$ecard_token}");?>',
          picture: '<?php echo $domain.$this->Html->url("/content/ecard/{$thumb}");?>',
          name: 'Multimedia E-Card',
          caption: '<?php echo "Check out my e-card";?>',
          description: 'lorem ipsum dolor sit amet'
        };
        function callback(response) {}
        FB.ui(obj, callback);
      }
      
      function send_to_fb_friend(){
      	FB.ui({
          method: 'send',
          name: 'Multimedia E-Card',
          link: '<?php echo $domain.$this->Html->url("/ecards/view/?card={$ecard_token}");?>',
          picture: '<?php echo $domain.$this->Html->url("/content/ecard/{$thumb}");?>',
          caption: '<?php echo "Check out my e-card";?>',
          description: 'lorem ipsum dolor sit amet'
          });
      }
</script>
<div id="fb-root"></div>
<div style="background-color:white;min-height:650px;">
	<?php if(isset($msg)):?>
		<div style="margin:5px;"><h3>SAVING YOUR ECARD</h3></div>
			<div style="margin:5px;"><?php echo $msg;?></div>
		<div>
			<a href="<?php echo $this->Html->url('/ecards/create',true);?>">Continue &gt;&gt;</a>
		</div>
	<?php else:?>
		<h3>Send To a Friend</h3>
			<div class="sendoption">
				<span class="btn"><a href="javascript:void(0);" onclick="$('.opt_facebook').hide();$('.opt_email').show();return false;">By Email</a></span>
				<span class="btn"><a href="javascript:void(0);" onclick="$('.opt_email').hide();$('.opt_facebook').show();return false;">By Facebook</a></span>
			</div>
			<div class="opt_facebook" style="display:none;margin-top:20px;">
				<div>
					<a href="javascript:void(0);" onclick="send_to_fb_friend();">Send Via Facebook</a>
				</div>
			</div>
			<div class="opt_email" style="display:none;margin-top:20px;">
		<?php echo $this->Form->create('Ecard',array('controller'=>'ecards','action'=>'send','type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
				<table>
					<tr>
						<td>Friend Name</td>
						<td><input type="text" name="friend_name" maxlength="20" size="20"/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="friend_email" maxlength="32" size="20"/></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" id="ecard_token" name="ecard_token" value="<?php echo $ecard_token;?>"/>
							<input type="submit" name="send" value="Send"/>
						</td>
					</tr>
				</table>
				<?php echo $this->Form->end();?>
		</div>
	<?php endif;?>
</div>
