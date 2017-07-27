<div style="background-color:white;min-height:650px;">
	<div style="margin:5px;"><h3>Create Your Own Ecard</h3></div>
	<div style="margin:5px;">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque elementum blandit massa, vel sagittis enim vehicula quis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur eget massa dui, eget lacinia massa. Nunc ut elit sed urna lacinia imperdiet. Sed risus risus, tincidunt quis ultricies sit amet, dictum eget massa. Morbi consectetur pulvinar leo, sit amet tempor mi porttitor nec. Donec nec blandit nunc. Quisque eleifend consectetur dignissim. Duis non felis nec nunc rutrum fermentum dapibus aliquam nunc.</p>

		<p>Phasellus dignissim consequat eros nec luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at urna eget est euismod adipiscing id vitae eros. Sed eu nisl sed metus laoreet facilisis. Nulla hendrerit dui tellus, vel ultrices elit. Aliquam facilisis malesuada dolor in interdum. Pellentesque porta commodo diam. Nunc in magna et justo fringilla aliquam in quis est. Maecenas dapibus gravida pellentesque. Phasellus ipsum libero, commodo quis dictum sed, interdum ac dui. Nunc venenatis nulla scelerisque orci euismod tempor aliquet ante luctus. Donec non felis eget orci egestas consequat nec ac eros. Ut mi risus, vehicula sed accumsan a, vestibulum at ipsum.</p>
	</div>
	<!-- FB Container -->
	<div id="fb-root"></div>
	<?php if(!isset($is_login)):?>
	<div class="fb-login-button" scope="read_stream,publish_stream,email,user_likes" >
		Login with Facebook
	</div>
	<?php else:?>
		<div>
		<a href="<?php echo $this->Html->url('/ecards/create',true);?>">Continue &gt;&gt;</a>
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