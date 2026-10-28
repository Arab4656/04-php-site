<?php
$pageTitle = 'Services';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <p class="eyebrow">How we can help</p>
        <h1>More than just gadgets.</h1>
        <p>Get helpful advice and reliable support at every step.</p>
    </div>
</section>
<section class="section container">
    <div class="card-grid">
        <article class="card">
            <span class="card-icon" aria-hidden="true">01</span>
            <h2>Product advice</h2>
            <p>Tell us what you want to do and we will help compare devices and accessories that fit your needs.</p>
        </article>
        <article class="card">
            <span class="card-icon" aria-hidden="true">02</span>
            <h2>Device setup</h2>
            <p>Get a hand with the basics of setting up a new device and getting familiar with its features.</p>
        </article>
        <article class="card">
            <span class="card-icon" aria-hidden="true">03</span>
            <h2>After-sales support</h2>
            <p>Contact us with questions about your purchase and we will point you toward the right next step.</p>
        </article>
    </div>
</section>
<section class="callout">
    <div class="container callout-content">
        <div>
            <p class="eyebrow">Need a recommendation?</p>
            <h2>We are happy to help.</h2>
        </div>
        <a class="button button-light" href="contact.php">Get in touch</a>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
