<label>
    <span><?php echo $this->label; ?></span>
    <input type="hidden" id="<?php echo $this->name; ?>" name="<?php echo $this->name; ?>" value="<?php echo $this->base64Value; ?>"/>
    <input type="file"
           accept="image/*"
           onchange="fileHelper('<?php echo $this->name; ?>', event)"
           id="file-<?php echo $this->name; ?>"
        <?php echo $this->required?"required":""; ?>
    />
    <img id="preview-<?php echo $this->name; ?>" src="<?php echo $this->base64Value; ?>" alt="preview"/>
</label>
