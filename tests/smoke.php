<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$files = [];
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
foreach ($iterator as $file) {
    if (!$file->isFile()) {
        continue;
    }
    $path = str_replace('\\', '/', $file->getPathname());
    if (str_contains($path, '/vendor/') || str_contains($path, '/.git/')) {
        continue;
    }
    if (str_ends_with($path, '.php')) {
        $files[] = $path;
    }
}

$failures = [];
foreach ($files as $file) {
    exec('php -l ' . escapeshellarg($file) . ' 2>&1', $output, $status);
    if ($status !== 0) {
        $failures[] = [$file, implode("\n", $output)];
    }
    $output = [];
}

$required = [
    '/composer.json',
    '/.env.example',
    '/config/portfolio.php',
    '/public/index.php',
    '/public/router.php',
    '/public/.htaccess',
    '/src/bootstrap.php',
    '/src/helpers.php',
    '/src/contact.php',
    '/templates/layout.php',
    '/templates/home.php',
    '/templates/projects.php',
    '/templates/project.php',
    '/templates/about.php',
    '/templates/contact.php',
];
foreach ($required as $requiredPath) {
    if (!is_file($root . $requiredPath)) {
        $failures[] = [$root . $requiredPath, 'Required file is missing.'];
    }
}

if (is_file($root . '/vendor/autoload.php')) {
    require_once $root . '/vendor/autoload.php';
    if (!class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
        $failures[] = [$root . '/vendor/autoload.php', 'PHPMailer dependency is unavailable.'];
    }
}

if ($failures !== []) {
    foreach ($failures as [$file, $message]) {
        fwrite(STDERR, $file . ': ' . $message . PHP_EOL);
    }
    exit(1);
}

echo 'Portfolio smoke tests passed (' . count($files) . ' PHP files checked).' . PHP_EOL;
