<div id="subBar">
    <h3 class="titleModule">Administrator Accounts - Create User</h3>
</div><!-- end #subBar -->
<div class="content">
    <?php
    echo $this->Session->flash('good');
    echo $this->Session->flash('bad');
    ?>
    <h4 class="titlePage">Edit User</h4>
    <div class="addForm">
        <?php echo $this->Form->create('User');?>
        <div class="row">
        <label>Name</label>
        <input name="name" size="50" type="text" value="<?=$user['User']['name']?>"/>
        </div>
        <div class="row">
        <label>Username</label>
        <?=$user['User']['username']?>
        <input type="hidden" name="username" value="<?=$user['User']['username']?>"/>
        </div>
        <div class="row">
        <label>Password</label>
        <input name="password" value="" size="50" type="password"/>
        </div>
        <div class="rowSubmit">
        <input type="hidden" name="id" value="<?=intval($user['User']['id'])?>"/>
        <input type="submit" name="btnSubmit" value="Save"/>
        </div>

        <?php echo $this->Form->end();?>

    </div><!-- end .addForm -->
     <div class="btnYes" style="float:left;margin:10px;">
    <a style="width:100px;" href="<?=$this->Html->url('/admin/users/list')?>">
        Back To List
    </a></div>
</div><!-- end .content -->

