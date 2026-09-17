<?php /** @var array $project */ ?>
<section class="page-hero">
    <div class="container narrow"><p class="eyebrow"><?= e($project['category']) ?></p><h1><?= e($project['title']) ?></h1><p><?= e($project['summary']) ?></p><div class="tag-list"><?php foreach ($project['stack'] as $tech): ?><span><?= e($tech) ?></span><?php endforeach; ?></div></div>
</section>
<section class="section">
    <div class="container detail-grid">
        <div><h2>Overview</h2><p><?= e($project['description']) ?></p></div>
        <aside class="detail-panel"><h2>Project status</h2><p><?= e($project['status']) ?></p><?php if ($project['url'] !== ''): ?><a class="button primary" href="<?= e($project['url']) ?>" target="_blank" rel="noopener noreferrer">View repository</a><?php endif; ?></aside>
    </div>
</section>
<section class="section tinted">
    <div class="container narrow"><p class="eyebrow">Highlights</p><h2>What this project demonstrates.</h2><div class="feature-list"><?php foreach ($project['highlights'] as $highlight): ?><div class="feature-item"><span aria-hidden="true">✓</span><p><?= e($highlight) ?></p></div><?php endforeach; ?></div></div>
</section>
<section class="section"><div class="container narrow"><a class="text-link" href="/projects">← Back to projects</a></div></section>
