<footer class="site-footer">
    <div class="footer-container">

        <div class="footer-columns">
            <div class="footer-column">
                <h3 class="footer-title">Global Gazette</h3>
                <p class="footer-about">Bringing you the latest stories and insights from around the world.</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog Posts</a></li>

                </ul>
            </div>



            <div class="footer-column">
                <h3 class="footer-title">Newsletter</h3>
                <p class="newsletter-text">Subscribe to our newsletter for the latest updates.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>



    </div>
</footer>

<style>
    .site-footer {
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 60px 0 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-columns {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-column {
        margin-bottom: 30px;
    }

    .footer-title {
        color: #fff;
        font-size: 1.2rem;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background: #3498db;
    }

    .footer-about {
        margin-bottom: 20px;
        line-height: 1.6;
        color: #bdc3c7;
    }

    .social-links {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: #fff;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: #3498db;
        transform: translateY(-3px);
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #bdc3c7;
        text-decoration: none;
        transition: color 0.3s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: #3498db;
        transform: translateX(5px);
    }

    .newsletter-text {
        color: #bdc3c7;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .newsletter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .newsletter-form input {
        flex: 1;
        min-width: 200px;
        padding: 12px 15px;
        border: none;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .newsletter-form input::placeholder {
        color: #bdc3c7;
    }

    .newsletter-form button {
        padding: 12px 25px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .newsletter-form button:hover {
        background: #2980b9;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 20px 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .copyright {
        color: #bdc3c7;
        font-size: 0.9rem;
    }

    .legal-links {
        display: flex;
        gap: 20px;
    }

    .legal-links a {
        color: #bdc3c7;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .legal-links a:hover {
        color: #3498db;
    }

    @media (max-width: 768px) {
        .footer-columns {
            grid-template-columns: 1fr;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .legal-links {
            justify-content: center;
        }
    }
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">