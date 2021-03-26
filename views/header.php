<nav class="navbar navbar-expand-md navbar-dark bg-dark h-10">
    <a href="dashboard.php" class="navbar-brand">
        <h1 class="h3">AWESOME MATCH</h1>
    </a>

    <div class="ml-auto">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="update.php?user_id=<?=$_SESSION['id']?>" class="nav-link"><?=$_SESSION['username']?></a>
            </li>
            <li class="nav-item">
                <a href="../actions/logout.php" class="nav-link text-danger">Log out</a>
            </li>
        </ul>    
    </div>
</nav>