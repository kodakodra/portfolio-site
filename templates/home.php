<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow"><?= e($portfolio['hero']['eyebrow']) ?></p>
            <h1><?= e($portfolio['hero']['title']) ?></h1>
            <p class="hero-body"><?= e($portfolio['hero']['body']) ?></p>
            <div class="actions">
                <a class="button primary" href="<?= e($portfolio['primary_action']['href']) ?>"><?= e($portfolio['primary_action']['label']) ?></a>
                <a class="button secondary" href="<?= e($portfolio['secondary_action']['href']) ?>"><?= e($portfolio['secondary_action']['label']) ?></a>
            </div>
        </div>
        <aside class="hero-panel" aria-label="Profile summary">
            <span class="hero-mark">K</span>
            <p class="hero-role"><?= e($portfolio['title']) ?></p>
            <p><?= e($portfolio['availability']) ?></p>
            <p class="muted"><?= e($portfolio['location']) ?></p>
        </aside>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow"><?= e($portfolio['intro']['eyebrow']) ?></p>
            <h2><?= e($portfolio['intro']['title']) ?></h2>
            <p><?= e($portfolio['intro']['body']) ?></p>
        </div>
        <div class="project-grid">
            <?php foreach ($portfolio['projects'] as $project): ?>
                <article class="project-card">
                    <div class="project-meta"><span><?= e($project['category']) ?></span><span><?= e($project['status']) ?></span></div>
                    <h3><a href="/projects/<?= e($project['slug']) ?>"><?= e($project['title']) ?></a></h3>
                    <p><?= e($project['summary']) ?></p>
                    <div class="tag-list">
                        <?php foreach ($project['stack'] as $tech): ?><span><?= e($tech) ?></span><?php endforeach; ?>
                    </div>
                    <a class="text-link" href="/projects/<?= e($project['slug']) ?>">View project <span aria-hidden="true">→</span></a>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="section-link"><a class="button secondary" href="/projects">View all projects</a></div>
    </div>
</section>

<section class="section tinted">
    <div class="container split">
        <div>
            <p class="eyebrow">Skills</p>
            <h2>Tools and disciplines used across projects.</h2>
        </div>
        <div class="skill-groups">
            <?php foreach ($portfolio['skills'] as $group): ?>
                <div class="skill-group"><h3><?= e($group['group']) ?></h3><div class="tag-list"><?php foreach ($group['items'] as $item): ?><span><?= e($item) ?></span><?php endforeach; ?></div></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div>
            <p class="eyebrow">Approach</p>
            <h2>Understand the problem, build it properly, test it, then refine it.</h2>
        </div>
        <div class="process-grid">
            <?php foreach ($portfolio['process'] as $step): ?>
                <article class="process-card"><span><?= e($step['number']) ?></span><h3><?= e($step['title']) ?></h3><p><?= e($step['body']) ?></p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <div><p class="eyebrow">Have a project in mind?</p><h2>Let’s discuss what needs building.</h2></div>
        <a class="button primary" href="/contact">Get in touch</a>
    </div>
</section>
