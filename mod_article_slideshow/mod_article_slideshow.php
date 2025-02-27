<?php
defined('_JEXEC') or die;

// Load helper
require_once __DIR__ . '/helper.php';

// Get articles
$articles = ModArticleSlideshowHelper::getArticles($params);

// Load the layout
require JModuleHelper::getLayoutPath('mod_article_slideshow', 'default');
