# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
- change all Javascript dependencies to ES6 Modules
- add more action hooks
- cleanup scss folder and file structure
- intrinsic vanilla lazyload for images
- update jquery to 3.0.0 or complete remove for better performance
- more documentation for the functions
- some parts are still from evolution framework, cleanup
- improve template constant definitions, less constants for every single path... building a separte function for this or somethin that is nicer

---

## [2.0.0] - 2020-03-13
### Changed
- update from Gulp 3 to Gulp 4; whole rewrite of ```gulpfile.js```
    - scss
    - javascript
    - svg rendering
    - browserify
    - babel for ES6 converting
- Prepare Template for usage with Parent and Child Themes
- remove more deprecated / unused code

### Added
- a lot of action hooks for better usage as Child Theme
- Browsersync for faster developement environment
- imageoptim for template elements and images
- ACF Support for gutenberg blocks
- some fields for Template "Customizer"
- submodules for:
    - Custom post types
    - custom taxonomy
    - eu tracking cookie Plugin
    - gutenberg block extra stylings

### Removed
- Must Use Plugins for ACF and Template Setup

### Deprecated
- some old functions from the first voodookit versions, they will die in the next updates

---

## [1.1.0]
- some changes and improvements for the wp config files
- add function for tiny mce editor style configuration
- change template version constant

## [1.0.0]
- start project, with many function which I currently would not describe, because I am lazy and out of order ;-)
