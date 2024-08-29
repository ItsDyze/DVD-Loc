<label>
    <span><?php echo $this->label; ?></span>
    <textarea
           name="<?php echo $this->name; ?>"
           placeholder="<?php echo $this->placeholder; ?>"
           rows="10"
           cols="100"
        <?php echo $this->required?"required":""; ?>
        <?php echo $this->readOnly?"readOnly":""; ?>
    ><?php echo $this->value; ?></textarea>
</label>