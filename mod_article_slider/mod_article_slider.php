<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$document = Factory::getDocument();
$document->addScript(Uri::root() . 'modules/mod_article_slider/assets/admin.js');  // Load JavaScript file

require JModuleHelper::getLayoutPath('mod_article_slider');


if ($_GET['method'] == 'getArticles' && isset($_GET['category_id'])) {
    $categoryId = (int) $_GET['category_id'];
    
/*     $db = Factory::getDbo();
    $query = $db->getQuery(true)
        ->select($db->quoteName(['id', 'title']))
        ->from($db->quoteName('#__content'))
        ->where($db->quoteName('catid') . ' = ' . $db->quote($categoryId))
        ->where($db->quoteName('state') . ' = 1')
        ->order($db->quoteName('title') . ' ASC');

    $db->setQuery($query);
    $articles = $db->loadObjectList();

    echo json_encode([
        'success' => true,
        'articles' => array_map(function ($article) {
            return ['value' => $article->id, 'text' => $article->title];
        }, $articles)
    ]);
    exit; */
}
