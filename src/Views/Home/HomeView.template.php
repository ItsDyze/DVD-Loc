<div class="search-bar">
    <input id="dvd-search-input" type="text" name="search" placeholder="Search DVDs..." value="<?php echo htmlspecialchars($_GET['Search'] ?? '', ENT_QUOTES); ?>" class="search-input" />
    <button type="submit" class="search-button" onclick="search()">Filter</button>
</div>

<div class="card-container">
    <?php foreach ($data->DVDs as $row): ?>
        <div class="card clickable" onclick="document.location.href='/dvd/<?php echo $row->Id; ?>'">
            <div class="card-content">
                <h3><?php echo $row->LocalTitle; ?></h3>
                <?php if($row->Image): ?>
                    <img src="<?php echo $row->Image; ?>" alt="preview" />
                <?php else: ?>
                    <div class="no-preview">
                        <span>No Preview Available</span>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    <?php endforeach; ?>
</div>
