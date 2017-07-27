<div id="subBar">
    <h3 class="titleModule">Administrator Accounts - Create User</h3>
</div><!-- end #subBar -->
<div class="content">
    <?php
    echo $this->Session->flash('good');
    echo $this->Session->flash('bad');
    ?>
    <h4 class="titlePage">Create User</h4>
    <div class="addForm">
        <?php echo $this->Form->create('User');?>
        <div class="row">
        <label>Name</label>
        <input name="name" value="" size="50" type="text"/>
        </div>
        <div class="row">
        <label>Username</label>
        <input name="username" value="" size="50" type="text"/>
        </div>
        <div class="row">
        <label>Password</label>
        <input name="password" value="" size="50" type="password"/>
        </div>
        <div class="rowSubmit">
        <input type="submit" name="btnSubmit" value="Add User"/>

        </div>

        <?php echo $this->Form->end();?>

    </div><!-- end .addForm -->
     <div class="btnYes" style="float:left;margin:10px;">
    <a style="width:100px;" href="<?=$this->Html->url('/admin/users/list')?>">
        Back To List
    </a></div>
</div><!-- end .content -->

