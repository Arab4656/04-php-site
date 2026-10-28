<?php
declare(strict_types=1);

$pageTitle = 'Contact';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <p class="eyebrow">Let's talk</p>
        <h1>How can we help?</h1>
        <p>Reach out with a product question or ask our team for a recommendation.</p>
    </div>
</section>
<section class="section container contact-layout">
    <div class="content-narrow">
        <h2>Contact details</h2>
        <p>We would love to hear from you. Give us a call or send us a message using the details below.</p>
        <dl class="contact-list">
            <div>
                <dt>Phone</dt>
                <dd><a href="tel:<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?></a></dd>
            </div>
            <div>
                <dt>Email</dt>
                <dd><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></dd>
            </div>
        </dl>
    </div>
    <aside class="contact-note">
        <h2>Here to make it easy</h2>
        <p>Whether you are choosing a new gadget or need help understanding your options, our team is ready to point you in the right direction.</p>
    </aside>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
