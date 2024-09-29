<?php
/**
 * @var HomeViewModel $data
 */
use Models\ViewModels\HomeViewModel;
?>

<div class="search-bar">
    <input id="dvd-search-input" type="text" name="search" placeholder="Search DVDs..." value="<?php echo htmlspecialchars($_GET['Search'] ?? '', ENT_QUOTES); ?>" class="search-input" />
    <button type="submit" class="search-button" onclick="search()">Filter</button>
</div>

<?php foreach ($data->DVDCollections as $collection): ?>
    <div class="home-category">
        <h3>
            <?php echo $collection->Name; ?>
        </h3>
        <div class="card-container">

            <?php foreach ($collection->DVDs as $row): ?>
                <div class="card clickable" onclick="document.location.href='/dvd/<?php echo $row->Id; ?>'">
                    <div class="card-content">
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

    </div>

<?php endforeach; ?>
