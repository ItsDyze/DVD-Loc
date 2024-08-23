<label>
    <span><?php echo $this->label; ?></span>
    <input type="text"
           name="<?php echo $this->name; ?>"
           placeholder="<?php echo $this->placeholder; ?>"
           value="<?php echo $this->value; ?>"
           <?php echo $this->required?"required":""; ?>
           <?php echo $this->readOnly?"readOnly":""; ?>
    />
</label>