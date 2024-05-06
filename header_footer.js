// Insert Header
function insertHeader() {
    const headerHTML = `
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="lo.png" alt="">
                    <span>tree</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tree.php">Help Me Tree</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search_tree.php">Search Tree</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_services.php">Display Tree Services</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="login-btn" href="logout.php">Logout</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    `;
    document.getElementById('header').innerHTML = headerHTML;
}

// Insert Footer
function insertFooter() {
    const footerHTML = `
    <footer>
        <div class="footer-bottom">
            <p>Contact us: <a href="mailto:info@helptrees.com">info@helptrees.com</a> | Phone: 123-456-7890</p>
            <div class="footer-bottom-list">
                <a href="#">About Us</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </footer>
    `;
    document.getElementById('footer').innerHTML = footerHTML;
}

// Execute the functions
insertHeader();
insertFooter();
