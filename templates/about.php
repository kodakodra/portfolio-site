<section class="page-hero">
    <div class="container narrow"><p class="eyebrow"><?= e($portfolio['about']['eyebrow']) ?></p><h1><?= e($portfolio['about']['title']) ?></h1><p><?= e($portfolio['about']['body']) ?></p></div>
</section>
<section class="section">
    <div class="container split">
        <div><p class="eyebrow">Experience</p><h2>Work shaped by building, fixing and improving software.</h2></div>
        <div class="timeline">
            <?php foreach ($portfolio['experience'] as $item): ?><article class="timeline-item"><p class="eyebrow"><?= e($item['period']) ?></p><h3><?= e($item['title']) ?></h3><p><?= e($item['body']) ?></p></article><?php endforeach; ?>
        </div>
    </div>
</section>
<section class="section tinted">
    <div class="container">
        <div class="section-heading"><p class="eyebrow">Skills</p><h2>Technical skills and delivery disciplines.</h2></div>
        <div class="skill-groups wide"><?php foreach ($portfolio['skills'] as $group): ?><div class="skill-group"><h3><?= e($group['group']) ?></h3><div class="tag-list"><?php foreach ($group['items'] as $item): ?><span><?= e($item) ?></span><?php endforeach; ?></div></div><?php endforeach; ?></div>
    </div>
</section>
<section class="section">
    <div class="container split">
        <div><p class="eyebrow">Education & qualifications</p><h2>Formal study alongside hands-on engineering experience.</h2></div>
        <div class="timeline">
            <?php foreach ($portfolio['education'] as $item): ?><article class="timeline-item"><p class="eyebrow"><?= e($item['period']) ?></p><h3><?= e($item['title']) ?></h3><p><?= e($item['body']) ?></p></article><?php endforeach; ?>
        </div>
    </div>
</section>
<section class="section tinted">
    <div class="container split">
        <div><p class="eyebrow">Working approach</p><h2>Structured enough to be reliable, practical enough to adapt.</h2></div>
        <div class="process-grid"><?php foreach ($portfolio['process'] as $step): ?><article class="process-card"><span><?= e($step['number']) ?></span><h3><?= e($step['title']) ?></h3><p><?= e($step['body']) ?></p></article><?php endforeach; ?></div>
    </div>
</section>
