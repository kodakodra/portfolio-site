<section class="page-hero">
    <div class="container narrow">
        <p class="eyebrow">Projects</p>
        <h1>Selected work.</h1>
        <p>Projects and case-study style entries can explain the problem, implementation, technology choices and outcome.</p>
    </div>
</section>
<section class="section">
    <div class="container project-list">
        <?php foreach ($portfolio['projects'] as $project): ?>
            <article class="project-feature">
                <div class="project-feature-head">
                    <div><p class="eyebrow"><?= e($project['category']) ?></p><h2><?= e($project['title']) ?></h2></div>
                    <span class="status-pill"><?= e($project['status']) ?></span>
                </div>
                <p class="project-summary"><?= e($project['summary']) ?></p>
                <p><?= e($project['description']) ?></p>
                <div class="tag-list"><?php foreach ($project['stack'] as $tech): ?><span><?= e($tech) ?></span><?php endforeach; ?></div>
                <a class="text-link" href="/projects/<?= e($project['slug']) ?>">Read project details <span aria-hidden="true">→</span></a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
