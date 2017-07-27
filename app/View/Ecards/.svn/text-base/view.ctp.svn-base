<div style="background-color:white;min-height:650px;">
	<div style="margin:5px;"><h3>Ecard</h3></div>
	<?php if(isset($is_login)):?>
	<?php if($is_ecard_valid):?>
		<div style="margin:5px;width:640px;height:480px;">
			<div id="altContent"></div>
			<script type="application/javascript">
			docroot = "<?php echo $this->Html->url('/',true);?>";
				//load swf
					var flashvars = {
						req:"<?php echo $data['content'];?>",
						base:docroot,
						seq:""
					};
					var params = {
						menu: "false",
						scale: "noScale",
						allowFullscreen: "false",
						allowScriptAccess: "always",
						bgcolor: "",
						wmode: "direct" // can cause issues with FP settings & webcam
					};
					var attributes = {
						id:"player"
					};
					swfobject.embedSWF(
						docroot+"player.swf", 
						"altContent", "100%", "100%", "10.0.0", 
						docroot+"expressInstall.swf", 
						flashvars, params, attributes);
			</script>
		</div>
		<div>
		<a href="<?php echo $this->Html->url('/ecards',true);?>">Create Your Own Ecard &gt;&gt;</a>
		</div>
	<?php else:?>
		<div style="margin:5px;">
			Maaf, Ecard anda tidak tersedia.
		</div>
	<?php endif;?>
	<?php else:?>
	<!-- not login yet -->
		<div id="fb-root"></div>
		<div>
			You need to login before playing the ecard.
		</div>
		<div class="fb-login-button" scope="read_stream,publish_stream,email,user_likes" >
		Login with Facebook
		</div>
	<?php endif;?>
</div>
<?php if(!isset($is_login)):?>
<script>
window.fbAsyncInit = function() {
  FB.init({
    appId      : '<?php echo Configure::read('Facebook2.appId');?>', // App ID
    channelUrl : '<?php echo Configure::read('Facebook2.channel');?>', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });
  // Additional initialization code here
  FB.getLoginStatus(function(response) {
	if (response.authResponse) {
		var accessToken = response.authResponse.accessToken;
		document.cookie="ac_tk=" + accessToken + ";path=/";
		console.log('login nih');
	}else{
		console.log("blm login");
	}
  });
	 FB.Event.subscribe('auth.authResponseChange', function(response) {
 	 	console.log(response.status);
	 	if (response.status === 'connected') {
	   	  	document.location = "<?php echo $this->Html->url('/ecards/howto',true);?>";
	 	}
	});
};
// Load the SDK Asynchronously
(function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));
</script>
<?php endif;?>
