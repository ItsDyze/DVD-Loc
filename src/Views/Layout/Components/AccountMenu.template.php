<div class="user-menu">
    <div class="user" title="Hi <?php echo $this->layoutData->displayName; ?>">
        <img src="/assets/person.svg">
    </div>
    <ul class="menu-items">
        <li><a href="/home">Home</a></li>
        <?php if($this->layoutData->isAdmin)
            echo "<li><a href='/manage'>Back office</a></li>"
        ?>
        <li><a href="/auth/logout">Logout</a></li>
    </ul>
</div>