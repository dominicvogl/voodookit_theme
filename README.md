# Installation

## 1. Create Symlink

`ln -s your_path_to_wordpress/ core`

## 2. Create wp-config.php

Create `wp-config.php` with this code
`<?php
 include_once("${_SERVER['DOCUMENT_ROOT']}/wp-config.php");
 ?>`