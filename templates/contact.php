<section class="page-hero">
    <div class="container narrow"><p class="eyebrow">Contact</p><h1>Start a conversation.</h1><p>Use the form for project enquiries, freelance opportunities, technical work or questions about the projects shown here.</p></div>
</section>
<section class="section" id="form">
    <div class="container contact-grid">
        <div>
            <p class="eyebrow">Get in touch</p>
            <h2>Tell me what you are working on.</h2>
            <p>I will review the details and reply using the contact information you provide.</p>
            <p><strong>Email</strong><br><a href="mailto:<?= e($portfolio['email']) ?>"><?= e($portfolio['email']) ?></a></p>
            <p><strong>Availability</strong><br><?= e($portfolio['availability']) ?></p>
        </div>
        <form class="contact-form" method="post" action="/contact" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <div class="honeypot" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <?php if (!empty($formErrors['form'])): ?><div class="form-alert" role="alert"><?= e($formErrors['form']) ?></div><?php endif; ?>
            <div class="field"><label for="name">Name</label><input id="name" name="name" type="text" autocomplete="name" required maxlength="100" value="<?= e((string) ($formData['name'] ?? '')) ?>"><?php if (!empty($formErrors['name'])): ?><small><?= e($formErrors['name']) ?></small><?php endif; ?></div>
            <div class="field"><label for="email">Email</label><input id="email" name="email" type="email" autocomplete="email" required maxlength="254" value="<?= e((string) ($formData['email'] ?? '')) ?>"><?php if (!empty($formErrors['email'])): ?><small><?= e($formErrors['email']) ?></small><?php endif; ?></div>
            <div class="field"><label for="message">Message</label><textarea id="message" name="message" rows="9" minlength="20" maxlength="3000" required><?= e((string) ($formData['message'] ?? '')) ?></textarea><?php if (!empty($formErrors['message'])): ?><small><?= e($formErrors['message']) ?></small><?php endif; ?></div>
            <button class="button primary" type="submit">Send message</button>
            <p class="form-note">Your message is sent by SMTP. The site does not expose mail credentials to visitors.</p>
        </form>
    </div>
</section>
