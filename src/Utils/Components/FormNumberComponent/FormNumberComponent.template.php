<label>
    <span><?php echo $this->label; ?></span>
    <input type="number"
           name="<?php echo $this->name; ?>"
           value="<?php echo $this->value; ?>"
           min="<?php echo $this->min; ?>"
           max="<?php echo $this->max; ?>"
           step="<?php echo $this->step; ?>"
        <?php echo $this->required?"required":""; ?>
        <?php echo $this->readOnly?"readOnly":""; ?>
    />
</label>