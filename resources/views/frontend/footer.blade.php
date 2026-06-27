<footer class="brand-footer">
    <div class="footer-top-section">
        <div class="footer-container">
            <div class="footer-grid">
                <!-- Column 1 -->
                <div class="footer-col">
                    <h4>Customer Care</h4>
                    <ul>
                        <li><a href="{{ route('help-faqs') }}">Help & FAQs</a></li>
                        <li><a href="{{ route('track-order') }}">Track Order</a></li>
                        <li><a href="{{ route('return-policy') }}">Return Policy</a></li>
                        <li><a href="{{ route('jewellery-care') }}">Jewellery Care</a></li>
                        <li><a href="{{ route('store-locator') }}">Store Locator</a></li>
                    </ul>
                </div>
                <!-- Column 2 -->
                <div class="footer-col">
                    <h4>About Lexoria</h4>
                    <ul>
                        <li><a href="{{ route('our-story') }}">Our Story</a></li>
                        <li><a href="{{ route('heritage') }}">Heritage</a></li>
                        <li><a href="{{ route('craftsmanship') }}">Craftsmanship</a></li>
                        <li><a href="{{ route('ethical-diamonds') }}">Ethical Diamonds</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Column 3 -->
                <div class="footer-col">
                    <h4>Our Policies</h4>
                    <ul>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('shipping-policy') }}">Shipping Policy</a></li>
                        <li><a href="{{ route('exchange-buyback') }}">Exchange & Buy Back</a></li>
                        <li><a href="{{ route('cookie-policy') }}">Cookie Policy</a></li>
                    </ul>
                </div>
                <!-- Column 4: Newsletter & Social -->
                <div class="footer-col contact-col">
                    <h4>Join Lexoria</h4>
                    <p>Subscribe to receive updates on new collections and exclusive invitations.</p>
                    <div class="newsletter-box">
                        <input type="email" placeholder="Email Address">
                        <button><i class="bi bi-arrow-right"></i></button>
                    </div>
                    <div class="footer-social">
                        <a href="{{ route('collections') }}"><i class="bi bi-facebook"></i></a>
                        <a href="{{ route('collections') }}"><i class="bi bi-instagram"></i></a>
                        <a href="{{ route('collections') }}"><i class="bi bi-twitter-x"></i></a>
                        <a href="{{ route('collections') }}"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-container">
            <div class="bottom-flex">
                <div class="bottom-left">
                    <span><i class="bi bi-geo-alt"></i> UNITED STATES | EN</span>
                </div>
                <div class="bottom-center">
                    <p>&copy; {{ date('Y') }} LEXORIA DIAMOND PRIVATE LIMITED. ALL RIGHTS RESERVED.</p>
                </div>
                <div class="bottom-right">
                    <div class="payment-icons">
                        <i class="bi bi-credit-card"></i>
                        <i class="bi bi-paypal"></i>
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Premium Minimalist Dark Green Footer with Geometric Pattern */
    .brand-footer {
        background-color: #0F1F17; /* Deep Luxury Forest Green */
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%23d4af37' stroke-opacity='0.08' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23d4af37' stroke-opacity='0.08' stroke-width='1'/%3E%3C/svg%3E");
        color: #FBFAFA;
        font-family: 'Inter', sans-serif;
        position: relative;
        z-index: 10;
        border-top: 1px solid #1a2a22;
    }

    .footer-top-section {
        padding: 80px 0 60px;
    }

    .footer-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 60px;
    }

    /* Headings */
    .footer-col h4 {
        color: #FBFAFA;
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        margin-bottom: 25px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Lists & Links */
    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-col li {
        margin-bottom: 16px;
    }

    .footer-col a {
        text-decoration: none;
        color: rgba(251, 250, 250, 0.7); /* Slightly muted for unhovered links */
        font-size: 0.95rem; /* Increased size for readability */
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        display: inline-block;
        padding: 6px 0; /* Increase touch target */
    }

    .footer-col a:hover {
        color: #d4af37; /* Luxury Gold Hover */
        transform: translateX(5px);
    }

    /* Newsletter Box */
    .contact-col p {
        font-size: 0.9rem;
        color: rgba(251, 250, 250, 0.7);
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .newsletter-box {
        display: flex;
        border-bottom: 1px solid rgba(251, 250, 250, 0.3);
        padding-bottom: 8px;
        margin-bottom: 40px;
        transition: border-color 0.3s;
    }

    .newsletter-box:focus-within {
        border-color: #FBFAFA;
    }

    .newsletter-box input {
        border: none;
        padding: 10px 0;
        flex: 1;
        outline: none;
        font-size: 0.95rem;
        background: transparent;
        color: #FBFAFA;
        font-family: 'Inter', sans-serif;
    }

    .newsletter-box input::placeholder {
        color: rgba(251, 250, 250, 0.5);
    }

    .newsletter-box button {
        background: transparent;
        border: none;
        color: #FBFAFA;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0 10px;
        transition: all 0.3s;
    }

    .newsletter-box button:hover {
        transform: translateX(5px);
        color: #d4af37;
    }

    /* Social Icons */
    .footer-social {
        display: flex;
        gap: 20px;
    }

    .footer-social a {
        font-size: 1.3rem; /* Larger icon */
        color: #FBFAFA;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px; /* Better tap target */
        height: 48px;
        border: 1px solid rgba(251, 250, 250, 0.3);
        border-radius: 50%;
        background: transparent;
    }

    .footer-social a:hover {
        background: #FBFAFA;
        color: #0F1F17;
        border-color: #FBFAFA;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    /* Footer Bottom */
    .footer-bottom {
        padding: 30px 0;
        background-color: #0F1F17; /* Luxury dark green */
        position: relative;
    }

    .footer-bottom::before {
        content: '';
        position: absolute;
        top: 0;
        left: 5%;
        right: 5%;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
    }

    .bottom-flex {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        font-size: 0.75rem;
        color: #FFFFFF;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .bottom-left {
        display: flex;
        align-items: center;
    }

    .bottom-left span {
        cursor: pointer;
        transition: color 0.3s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .bottom-left span:hover {
        color: #d4af37; /* Gold hover */
    }

    .bottom-center {
        text-align: center;
    }

    .bottom-right {
        display: flex;
        justify-content: flex-end;
    }

    .payment-icons {
        display: flex;
        gap: 20px;
        font-size: 1.2rem;
        color: #FFFFFF;
    }

    .payment-icons i {
        transition: color 0.3s;
    }

    .payment-icons i:hover {
        color: #d4af37;
    }

    /* Mobile Responsiveness */
    @media (max-width: 991px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }
    }

    @media (max-width: 768px) {
        .footer-top-section {
            padding: 60px 0 40px;
        }

        .footer-container {
            padding: 0 25px;
        }

        .bottom-flex {
            grid-template-columns: 1fr;
            gap: 20px;
            text-align: center;
        }

        .bottom-right, .bottom-left {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }
</style>
