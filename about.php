<?php
declare(strict_types=1);

$pageTitle = 'About';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <p class="eyebrow">A little about us</p>
        <h1>Technology should work for everyone.</h1>
        <p><?= e($siteName) ?> is a fictional local gadget shop built around honest advice, useful products, and approachable service.</p>
    </div>
</section>
<section class="section container content-narrow">
    <h2>Our approach</h2>
    <p>Choosing a new device can feel complicated. We make it easier by listening to what you need, explaining your options in plain language, and helping you find a practical solution for your budget.</p>
    <p>From everyday accessories to the latest smart technology, our goal is to make every visit straightforward and welcoming.</p>
    <a class="text-link" href="contact.php">Talk to our team <span aria-hidden="true">&rarr;</span></a>
</section>
<section class="section team-section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Meet the people</p>
            <h2>Here to help you find your fit.</h2>
        </div>
        <div class="card-grid team-grid">
            <?php foreach ($team as $member): ?>
                <article class="card team-card">
                    <h3><?= e($member['name']) ?></h3>
                    <p class="team-role"><?= e($member['role']) ?></p>
                    <p><?= e($member['bio']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
