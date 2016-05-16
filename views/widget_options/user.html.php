<div class="input-group">
    <label for="<?= $this->get_field_id('username'); ?>">Username</label>
    <input type="text" id="<?= $this->get_field_id('username'); ?>" name="<?= $this->get_field_name('username'); ?>" value="<?= !empty($username) ? $username : ''; ?>" class="form-control" />
</div>