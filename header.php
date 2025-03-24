<div class="navbar">
    <div class="navbar-brand">
        <h1 class="logo">Global Gazette</h1>
        <div class="tagline">Your World, Your Blogs</div>
    </div>

    <nav class="nav-links">
        <a href="#" class="nav-link active">Home</a>
        <a href="about-us" class="nav-link">About</a>
        <a href="post-new-blog" class="nav-link highlight">Post a Blog</a>
    </nav>


</div>

<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: #2c3e50;
        color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0px;
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
        background: linear-gradient(90deg, #3498db, #2ecc71);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .tagline {
        font-size: 0.8rem;
        opacity: 0.8;
        margin-top: -5px;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 0;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #2ecc71;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #2ecc71;
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link.active {
        color: #2ecc71;
    }

    .nav-link.active::after {
        width: 100%;
    }
</style>