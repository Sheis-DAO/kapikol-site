# Form Handling Alternatives for GitHub Pages

Since GitHub Pages only serves static content, the PHP form handler won't work. Here are recommended alternatives:

## 1. Formspree (Recommended)
Simple form backend service with free tier.

```html
<!-- Replace your form action with Formspree endpoint -->
<form action="https://formspree.io/f/YOUR_FORM_ID" method="POST">
    <!-- Your form fields remain the same -->
</form>
```

- Sign up at: https://formspree.io
- Free tier: 50 submissions/month
- No coding required

## 2. Netlify Forms
If you deploy to Netlify instead of GitHub Pages.

```html
<!-- Add netlify attribute to your form -->
<form name="contact" method="POST" data-netlify="true">
    <!-- Your form fields -->
</form>
```

## 3. EmailJS
Client-side email sending (exposes credentials in JavaScript).

```javascript
// Add EmailJS SDK
emailjs.send("service_id", "template_id", {
    name: document.getElementById("feedbackName").value,
    email: document.getElementById("feedbackEmail").value,
    message: document.getElementById("feedbackMessage").value
});
```

## 4. Google Forms
Embed a Google Form or redirect to it.

```html
<!-- Embed Google Form -->
<iframe src="https://docs.google.com/forms/d/e/YOUR_FORM_ID/viewform?embedded=true" 
        width="640" height="800" frameborder="0">
</iframe>
```

## 5. Static Form Services Comparison

| Service | Free Tier | Setup Complexity | Features |
|---------|-----------|------------------|----------|
| Formspree | 50/month | Easy | Email notifications, spam protection |
| EmailJS | 200/month | Medium | Client-side, template support |
| FormSubmit | Unlimited | Easy | No registration required |
| Getform | 50/month | Easy | File uploads, webhooks |
| FormCarry | 100/month | Easy | Dashboard, integrations |

## Implementation Example (Formspree)

1. Sign up at formspree.io
2. Create a new form
3. Update your forms in HTML:

```html
<!-- In contacts.html -->
<form class="form_main-form" action="https://formspree.io/f/YOUR_FORM_ID" method="POST">
    <input type="hidden" name="_subject" value="New Kapikol Contact Form Submission">
    <input type="text" name="name" id="feedbackName" required>
    <input type="email" name="email" id="feedbackEmail" required>
    <select name="interest" id="feedbackSubject" required>
        <!-- options -->
    </select>
    <textarea name="message" id="feedbackMessage" required></textarea>
    <button type="submit">Send Message</button>
</form>

<!-- Newsletter form in footer -->
<form class="footer_about-form" action="https://formspree.io/f/YOUR_NEWSLETTER_ID" method="POST">
    <input type="email" name="email" placeholder="Your Email Address" required>
    <input type="hidden" name="_subject" value="New Kapikol Newsletter Signup">
    <button type="submit">Get Early Access</button>
</form>
```

## AJAX Form Submission (Optional)

To maintain the single-page feel, use AJAX:

```javascript
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Show success message
        alert('Thank you! We\'ll get back to you soon.');
        this.reset();
    })
    .catch(error => {
        alert('Oops! There was a problem submitting your form');
    });
});
```

## Security Note

Always validate forms client-side AND use a service with server-side validation and spam protection.