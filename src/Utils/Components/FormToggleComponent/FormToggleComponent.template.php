<label>
    <span><?php echo $this->label; ?></span>
    <input type="checkbox"
           onclick="checkboxHelper(this)"
           id="<?php echo $this->name; ?>"
           name="<?php echo $this->name; ?>"
           <?php echo $this->value ? "checked": ""; ?>
           <?php echo $this->required?"required":""; ?>
           <?php echo $this->readOnly?"readOnly":""; ?>
    />
</label>