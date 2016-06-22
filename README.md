# Installation

## With Symlink

### 1. Create Symlink

`ln -s your_path_to_wordpress/ core`

### 2. Create wp-config.php

Create `wp-config.php` in `core/` folder just with this code:

`<?php
 include_once("${_SERVER['DOCUMENT_ROOT']}/wp-config.php");
 ?>`
 
## Without Symlink

### 1. Download core files

Download latest Wordpresscore Files from offical Website: [Wordpress Core Files](https://wordpress.org/latest.zip)

### 2. Install

Move core file in `core` folder