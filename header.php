<div class="navbar">
    <div class="navbar-brand">
        <h1 class="logo">Global Gazette</h1>
        <div class="tagline">Your World, Your Blogs</div>
    </div>

    <nav class="nav-links">
        <a href="/" class="nav-link">Home</a>
        <a href="/about-us" class="nav-link">About</a>
        <a href="/post-new-blog" class="nav-link highlight">Post a Blog</a>
    </nav>
</div>

<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: white;
        color: black;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0px;
        border-bottom: 1px solid #eee;
        background-color: #CCCCCC;

    }

    .navbar-brand {
        display: flex;
        flex-direction: column;
    }

    .logo {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        background: linear-gradient(90deg, #9c27b0, #4caf50);
        /* Purple to green gradient */
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .tagline {
        font-size: 0.8rem;
        opacity: 0.8;
        margin-top: -5px;
        color: #555;
        /* Darker gray for better contrast */
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
    }

    .nav-link {
        color: #333;
        /* Dark gray for normal state */
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 0;
        position: relative;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #4caf50;
        /* Bright green for hover */
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #4caf50;
        /* Green underline */
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link.active {
        color: #9c27b0;
        /* Purple for active link */
    }

    .nav-link.active::after {
        background-color: #9c27b0;
        /* Purple underline for active */
        width: 100%;
    }

    .nav-link.highlight {
        background-color: #4caf50;
        /* Green button */
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .nav-link.highlight:hover {
        background-color: #3d8b40;
        /* Darker green on hover */
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav-link.highlight::after {
        display: none;
        /* Remove underline for button-style link */
    }
</style>