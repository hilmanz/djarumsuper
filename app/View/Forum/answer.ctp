<div id="container">
    <div id="content" class="meetingpostPage">
        <div class="wrapper">
        	<div class="messageBox">
                <h4>Pesan Kamu berhasil terkirim</h4>
                <?php echo $msg;?>
                <?php echo $this->Html->link("Kembali","/forum/view/{$id}", array("class" => "backBtn"));?>
            </div>
          </div>
    </div><!-- end #content -->
</div><!-- end #container -->