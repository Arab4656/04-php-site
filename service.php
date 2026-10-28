<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';

$slug = $_GET['slug'] ?? null;
$service = null;

if (is_string($slug)) {
    foreach ($services as $availableService) {
        if ($availableService['slug'] === $slug) {
            $service = $availableService;
            break;
        }
    }
}

if ($service === null) {
    http_response_code(404);
    $pageTitle = 'Service not found';
} else {
    $pageTitle = $service['title'];
}

require_once __DIR__ . '/includes/header.php';
?>
<?php if ($service === null): ?>
    <section class="page-banner">
        <div class="container">
            <p class="eyebrow">404 - Not found</p>
            <h1>We couldn't find that service.</h1>
            <p>It may have moved or the link may be incorrect. Browse our services to find what you need.</p>
            <a class="button" href="services.php">Browse services</a>
        </div>
    </section>
<?php else: ?>
    <section class="page-banner">
        <div class="container">
            <p class="eyebrow">Our services</p>
            <h1><span aria-hidden="true"><?= e($service['icon']) ?></span> <?= e($service['title']) ?></h1>
            <p><?= e($service['description']) ?></p>
        </div>
    </section>
    <section class="section container content-narrow service-detail">
        <p class="eyebrow">Service price</p>
        <h2><?= e(formatPrice((float) $service['price'])) ?></h2>
        <p>Contact us if you have questions or would like help with this service.</p>
        <a class="button" href="contact.php">Contact our team</a>
        <p><a class="text-link" href="services.php">&larr; Back to all services</a></p>
    </section>
<?php endif; ?>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
