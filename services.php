<?php
declare(strict_types=1);

$pageTitle = 'Services';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';
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
        <?php foreach ($services as $service): ?>
            <?= renderServiceCard($service) ?>
        <?php endforeach; ?>
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
