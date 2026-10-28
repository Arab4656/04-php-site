<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="container hero-content">
        <p class="eyebrow">Technology made simple</p>
        <h1>Find your next favourite gadget.</h1>
        <p class="hero-copy">Discover dependable devices, practical accessories, and helpful advice from a team that puts your needs first.</p>
        <a class="button" href="services.php">Explore our services</a>
    </div>
</section>
<section class="section container">
    <div class="section-heading">
        <p class="eyebrow">Why shop with us?</p>
        <h2>Good tech, with people here to help.</h2>
    </div>
    <div class="card-grid">
        <article class="card">
            <span class="card-icon" aria-hidden="true">01</span>
            <h3>Carefully chosen</h3>
            <p>Browse useful gadgets and accessories selected for quality, value, and everyday life.</p>
        </article>
        <article class="card">
            <span class="card-icon" aria-hidden="true">02</span>
            <h3>Friendly guidance</h3>
            <p>Get clear recommendations so you can choose the right device with confidence.</p>
        </article>
        <article class="card">
            <span class="card-icon" aria-hidden="true">03</span>
            <h3>Support you can reach</h3>
            <p>Have a question? Contact our team for practical help before and after your purchase.</p>
        </article>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
