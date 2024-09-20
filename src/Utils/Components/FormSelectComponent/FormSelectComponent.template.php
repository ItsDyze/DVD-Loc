<label>
    <span><?php echo $this->label; ?></span>
    <select name="<?php echo $this->name; ?>"
        <?php echo $this->required?"required":""; ?>
        <?php echo $this->readOnly?"readOnly":""; ?>>
        <option disabled selected>Select a value</option>
        <?php foreach ($this->availableValues as $item): ?>
            <option value="<?php echo $item->Id; ?>" <?php echo $item->Id == $this->value ? "selected" : ""; ?>>
                <?php echo $item->Name; ?>
            </option>
        <?php endforeach; ?>
    </select>
</label>