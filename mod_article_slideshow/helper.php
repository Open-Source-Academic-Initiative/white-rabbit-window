<?php
defined('_JEXEC') or die;

class ModArticleSlideshowHelper
{
    public static function getArticles($params)
    {
        $limit = (int) $params->get('article_limit', 5);
        $categoryId = (int) $params->get('category');

        // Load Joomla's database object
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title, introtext, images')
            ->from('#__content')
            ->where('catid = ' . $db->quote($categoryId))
            ->where('state = 1')
            ->order('created DESC')
            ->setLimit($limit);

        $db->setQuery($query);
        return $db->loadObjectList();
    }
}

