<div class="otherFeature">
    <div class="widget" id="subscribebox">
        <h3>Subscription</h3>
        <div class="subscribebox" id="forminput">
            <p>Daftarkan email kamu untuk mendapatkan update terbaru</p>
            <input type="text" name="optin_email" value=""/>
            <input type="button" name="btn" class="btns redBtn" value="Subscribe"/>
        </div>
        <div class="subscribebox" style="display:none;" id="formtext">
            <p>Terima kasih !</p>
        </div>
    </div><!-- end .widget -->
    <div class="line"></div>
</div>
<?php
if(isset($profile)):
?>
    <script>
    $("input[name='btn']").click(function(){
        api_post('<?=$this->Html->url('/subscribe/save')?>',
                 {
                    email:$("input[name='optin_email']").val(),
                    id:<?=intval($profile['Login']['id'])?>
                 },
                 function(response){
                    if(response.status==1){
                        $("#forminput").hide();
                        $("#formtext").fadeIn();
                    }
                 });
    });
    </script>
<?php
endif;
?>