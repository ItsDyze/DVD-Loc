<?php
/**
 * @var ManageDVDListViewModel $data
 */
use Models\ViewModels\ManageDVDListViewModel;

?>

<h2>
    DVD Management
</h2>
<div class="table-wrapper">
    <div class="table-header">
        <div class="table-search">
            <input id="dvd-search-input" type="text" name="search" placeholder="Chercher un DVD..." value="<?php echo htmlspecialchars($_GET['Search'] ?? '', ENT_QUOTES); ?>" class="search-input">
            <button type="submit" class="search-button" onclick="search()">Filtrer</button>
            <a href="/manage/dvd/-1">Ajouter un nouveau</a>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th scope="col" onclick="orderBy('LocalTitle')">Titre</th>
            <th scope="col" onclick="orderBy('Year')">Année</th>
            <th scope="col" onclick="orderBy('IsOffered')">Dans l'offre</th>
            <th scope="col" onclick="orderBy('Price')">Prix</th>
            <th scope="col" onclick="orderBy('Quantity')">Quantité</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data->DVDs as $row): ?>
            <tr class="clickable" onclick="document.location.href='/manage/dvd/<?php echo $row->Id; ?>'" >
                <th scope="row"><?php echo $row->LocalTitle; ?></th>
                <th scope="col" class="col-short"><?php echo $row->Year; ?></th>
                <th scope="col" class="col-short"><?php echo $row->IsOffered; ?></th>
                <th scope="col" class="col-price"><?php echo number_format((float)$row->Price, 2, ',', '') . " € "; ?></th>
                <th scope="col" class="col-number"><?php echo $row->Quantity; ?></th>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($data->CurrentPage > 1): ?>
            <a onclick="changePage(<?php echo $data->Query->Offset - $data->Query->Limit; ?>)" class="pagination-prev">Previous</a>
        <?php endif; ?>
        <?php
        echo "Page $data->CurrentPage of $data->TotalPages";
        ?>
        <?php if ($data->CurrentPage < $data->TotalPages): ?>
            <a onclick="changePage(<?php echo $data->Query->Offset + $data->Query->Limit; ?>)" class="pagination-next">Next</a>
        <?php endif; ?>
    </div>
</div>
