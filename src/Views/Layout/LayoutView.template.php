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
            <h1><a href="/">DVD-Loc</a></h1>
            <div class="login-btn" onClick="document.location.href='/Auth/Login'">
                Login
            </div>
        </header>
        <main>
            <?php echo $this->subContent ?>
        </main>
        <footer>
            <p>Footer content here</p>
        </footer>
    </div>
</body>
</html>