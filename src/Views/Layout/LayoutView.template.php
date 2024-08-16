<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C218 - <?php echo $this->layoutData->pageSubTitle ?? "Home" ?></title>
</head>
<body>
    <style>
        <?php include ASSETS . 'styles.css'; ?>
        <?php include 'LayoutView.style.css'; ?>
        <?php echo $this->cssInclude; ?>
    </style>
    <div class="wrapper">
        <header>
            <?php include "Components/Menu.template.php"; ?>
            <h1><a href="/">DVD-Loc</a></h1>
            <?php
                if(!$this->layoutData->isLoggedIn)
                {
                    include "Components/LoginBtn.template.php";
                }
                else
                {
                    include "Components/AccountMenu.template.php";
                }

            ?>
        </header>
        <main>
            <?php echo $this->subContent ?>
        </main>
        <footer>
            <p>Dessiné, conçu, développé et hébergé par Dylan Zelmar</p>
        </footer>
    </div>
</body>
</html>