<label>
    <span><?php echo $this->label; ?></span>
    <textarea style="display: none;" id="<?php echo $this->name; ?>" name="<?php echo $this->name; ?>"><?php echo $this->value; ?></textarea>
    <input type="file"
           accept="image/*"
           onchange="fileHelper('<?php echo $this->name; ?>', event)"
           id="file-<?php echo $this->name; ?>"
        <?php echo $this->required?"required":""; ?>
    />
    <img src="data:<?php echo $this->imgType; ?>;base64,<?php echo $this->base64Value; ?>" alt="Image preview"/>
</label>