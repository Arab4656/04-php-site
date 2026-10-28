<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';

$serviceTitles = array_column($services, 'title', 'slug');

if (!isset($_SESSION['messages_csrf_token']) || !is_string($_SESSION['messages_csrf_token'])) {
    $_SESSION['messages_csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['messages_csrf_token'];
$loginError = null;
$storageError = null;
$messages = [];
$isAuthenticated = ($_SESSION['messages_authenticated'] ?? false) === true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedToken = $_POST['csrf_token'] ?? null;
    if (!is_string($postedToken) || !hash_equals($csrfToken, $postedToken)) {
        $loginError = 'Your session expired. Reload the page and try again.';
    } elseif (($_POST['action'] ?? '') === 'logout') {
        unset($_SESSION['messages_authenticated']);
        session_regenerate_id(true);
        header('Location: messages.php', true, 303);
        exit;
    } elseif (!$isAuthenticated) {
        $postedPassword = $_POST['password'] ?? null;
        if (is_string($postedPassword) && hash_equals($messagesPassword, $postedPassword)) {
            session_regenerate_id(true);
            $_SESSION['messages_authenticated'] = true;
            header('Location: messages.php', true, 303);
            exit;
        }

        $loginError = 'The password was incorrect. Please try again.';
    }
}

$isAuthenticated = ($_SESSION['messages_authenticated'] ?? false) === true;

if ($isAuthenticated) {
    $messagesPath = __DIR__ . '/storage/messages.jsonl';

    if (is_file($messagesPath)) {
        $messagesFile = @fopen($messagesPath, 'rb');

        if ($messagesFile === false) {
            $lastError = error_get_last();
            error_log('Unable to open contact messages file: ' . ($lastError['message'] ?? $messagesPath));
            $storageError = 'Messages could not be loaded. Check the storage file permissions and try again.';
        } elseif (!flock($messagesFile, LOCK_SH)) {
            error_log('Unable to acquire a shared lock on contact messages file: ' . $messagesPath);
            fclose($messagesFile);
            $storageError = 'Messages could not be loaded. Please try again later.';
        } else {
            $contents = stream_get_contents($messagesFile);
            flock($messagesFile, LOCK_UN);
            fclose($messagesFile);

            if ($contents === false) {
                error_log('Unable to read contact messages file: ' . $messagesPath);
                $storageError = 'Messages could not be loaded. Check the storage file and try again.';
            } else {
                foreach (preg_split('/\r\n|\n|\r/', trim($contents)) as $line) {
                    if ($line === '') {
                        continue;
                    }

                    try {
                        $message = json_decode($line, true, 512, JSON_THROW_ON_ERROR);
                    } catch (JsonException $exception) {
                        error_log('Skipping malformed contact message JSON: ' . $exception->getMessage());
                        continue;
                    }

                    if (is_array($message)) {
                        $messages[] = $message;
                    } else {
                        error_log('Skipping contact message record that is not a JSON object.');
                    }
                }

                $messages = array_reverse($messages);
            }
        }
    }
}

$pageTitle = 'Messages';
require_once __DIR__ . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <p class="eyebrow">Private inbox</p>
        <h1>Contact messages</h1>
        <p>Review submissions sent through the website contact form.</p>
    </div>
</section>
<section class="section container">
    <?php if (!$isAuthenticated): ?>
        <div class="messages-login content-narrow">
            <h2>Sign in to view messages</h2>
            <p>This page is intended for local learning use. Enter the password configured in <code>includes/config.php</code>.</p>
            <?php if ($loginError !== null): ?>
                <p class="form-alert form-alert-error" role="alert"><?= e($loginError) ?></p>
            <?php endif; ?>
            <form class="contact-form" method="post" action="messages.php">
                <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
                <div class="form-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                </div>
                <button class="button" type="submit">View messages</button>
            </form>
        </div>
    <?php else: ?>
        <div class="messages-toolbar">
            <p class="count-badge"><span><?= e((string) count($messages)) ?></span> <?= count($messages) === 1 ? 'message' : 'messages' ?></p>
            <form method="post" action="messages.php">
                <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
                <input type="hidden" name="action" value="logout">
                <button class="button button-outline" type="submit">Log out</button>
            </form>
        </div>

        <?php if ($storageError !== null): ?>
            <p class="form-alert form-alert-error" role="alert"><?= e($storageError) ?></p>
        <?php elseif ($messages === []): ?>
            <p class="empty-state">There are no messages yet.</p>
        <?php else: ?>
            <div class="messages-table-wrap">
                <table class="messages-table">
                    <thead>
                        <tr>
                            <th scope="col">Received</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Service</th>
                            <th scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?= e(is_string($message['timestamp'] ?? null) ? $message['timestamp'] : 'Unknown') ?></td>
                                <td><?= e(is_string($message['name'] ?? null) ? $message['name'] : 'Unknown') ?></td>
                                <td><?= e(is_string($message['email'] ?? null) ? $message['email'] : 'Unknown') ?></td>
                                <td><?= e(is_string($message['phone'] ?? null) && $message['phone'] !== '' ? $message['phone'] : '—') ?></td>
                                <?php $serviceSlug = is_string($message['service'] ?? null) ? $message['service'] : ''; ?>
                                <td><?= e($serviceTitles[$serviceSlug] ?? ($serviceSlug !== '' ? $serviceSlug : 'Unknown')) ?></td>
                                <td><?= nl2br(e(is_string($message['message'] ?? null) ? $message['message'] : '')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
