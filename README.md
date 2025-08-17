# Kapikol Website

This is the static website for Kapikol - a SocialFi platform that enables micro-influencers to capitalize their influence through Web3 primitives.

## 🚀 Quick Start

### Local Development

1. Clone the repository:
```bash
git clone https://github.com/YOUR_USERNAME/kapikol-site.git
cd kapikol-site
```

2. Serve the site locally:
```bash
# Using Python 3
python -m http.server 8000

# Using Node.js
npx serve

# Using PHP
php -S localhost:8000
```

3. Open http://localhost:8000 in your browser

## 📄 Pages

- **Home** (`index.html`) - Landing page showcasing the platform
- **About** (`about.html`) - Mission, vision, and platform features
- **News** (`news.html`) - Latest updates and blog posts
- **Events** (`events.html`) - Upcoming workshops, summits, and meetups
- **Contact** (`contacts.html`) - Contact form and community links

## 🚀 Deployment

### GitHub Pages

This site is configured to automatically deploy to GitHub Pages when you push to the `main` branch.

1. Enable GitHub Pages in your repository settings:
   - Go to Settings → Pages
   - Source: Deploy from a branch
   - Branch: `main` (or your default branch)
   - Folder: `/ (root)`

2. The GitHub Actions workflow will automatically deploy your site when you push changes.

3. Your site will be available at: `https://YOUR_USERNAME.github.io/kapikol-site/`

### Important Notes

- **Contact Forms**: GitHub Pages only hosts static sites. The PHP form handler (`form.php`) won't work. Consider using:
  - [Formspree](https://formspree.io/)
  - [Netlify Forms](https://www.netlify.com/products/forms/)
  - [EmailJS](https://www.emailjs.com/)
  - [Google Forms](https://forms.google.com/)

- **Media Assets**: All images and videos are currently placeholders. See `Media-Requirements.md` for a list of required assets.

## 🎨 Customization

### Updating Content
- Edit the HTML files directly
- All content is static and can be modified in the HTML

### Styling
- CSS files are minified in the `css/` directory
- The site uses Bootstrap and custom SCSS

### JavaScript
- JS files are minified in the `js/` directory
- Includes libraries like Swiper, AOS, and Lottie

## 📁 Project Structure

```
kapikol-site/
├── index.html          # Homepage
├── about.html          # About page
├── news.html           # News/Blog page
├── events.html         # Events page
├── contacts.html       # Contact page
├── form.php           # Form handler (requires server)
├── css/               # Stylesheets
├── js/                # JavaScript files
├── img/               # Images
├── svg/               # SVG graphics
├── fonts/             # Web fonts
├── video/             # Video files
├── lottie/            # Lottie animations
├── sourcemaps/        # Source maps
└── .github/
    └── workflows/     # GitHub Actions
        ├── deploy.yml # Auto-deploy to GitHub Pages
        └── test-build.yml # PR validation

```

## 🛠️ Technologies

- HTML5
- CSS3 (Bootstrap, SCSS)
- JavaScript (ES6+)
- Libraries: Swiper, AOS, Lottie, LazyLoad
- Deployment: GitHub Pages

## 📝 License

Copyright © 2025 Kapikol. All rights reserved.

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📧 Contact

- Website: [kapikol.io](https://kapikol.io)
- Email: hello@kapikol.io
- Twitter: [@kapikol_io](https://twitter.com/kapikol_io)