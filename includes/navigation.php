    <nav class="main-navigation ui stackable inverted menu fixed">
        <a id="nav-menu-burger" class="ui small header item"><i class="sidebar icon"></i>Menu</a>
        <div class="ui container" id="nav-menu">
            <h3 id="brand-name" class="ui header item">Gallery</h3>
            <a href="<?=ROOT?>" class="item">Home</a>

            <?php if ($session->isLoggedIn()): ?>
                <a href="<?=ADMIN?>" class="item">Admin</a>
            <?php endif; ?>
            
            <a href="<?=ROOT?>contact" class="item">Contact</a>

            <?php if ($session->isLoggedIn()): ?>
                <div class="ui simple right floated dropdown item"><i class="icon user"></i><?=$session->userInfo()?><i class="dropdown icon"></i>
                    <div class="menu">
                        <a href="<?=ADMIN?>logout" class="ui big header item"><i class="icon shutdown"></i>Logout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>