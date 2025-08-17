# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview
Kapikol is a SocialFi platform for micro-influencers currently built on an HTML template. The project aims to implement fan-initiated token launches, staking-based ranking, and AI-powered growth verification.

## Current State
This is a static HTML/CSS/JavaScript template (originally "UpCreators" by Merkulove) being adapted for the Kapikol platform. The template is pre-built with no active build system.

## Development Commands
Currently no build commands are configured. To develop:
1. Serve HTML files with a local web server (e.g., `python -m http.server 8000` from Template directory)
2. Edit SCSS files in `Template/scss/` (requires manual compilation to CSS)
3. JavaScript modules are in `Template/js/modules/`

## Architecture
### Directory Structure
- `Template/` - Main website files
  - `index.html` - Homepage
  - `scss/` - SCSS source files (base, blocks, global, libs, pages)
  - `js/modules/` - JavaScript modules (effects, forms, gallery, etc.)
  - `css/` - Compiled CSS (pre-minified)
  
### Key Technologies
- Bootstrap for responsive grid
- SCSS for styling (pre-compiled)
- Vanilla JavaScript with modular architecture
- Libraries: Swiper, AOS, Lottie, LazyLoad

### JavaScript Module Pattern
Modules follow this pattern:
```javascript
const ModuleName = (() => {
    const init = () => { /* initialization code */ };
    return { init };
})();
```

### Form Handling
Contact forms use `Template/form.php` - requires server-side configuration.

## Future Integration Needs
Based on PROJECT.md, the following Web3 features need implementation:
- Wallet connection (MetaMask, WalletConnect)
- Smart contract integration for token launches
- Staking mechanism
- On-chain data fetching
- IPFS integration for decentralized storage

## Important Notes
- No package.json or node_modules - consider initializing npm project for Web3 dependencies
- No test framework configured
- CSS/JS files are pre-minified - source maps available in `Template/sourcemaps/`
- Multiple page templates available (shop, blog, portfolio) for different platform sections