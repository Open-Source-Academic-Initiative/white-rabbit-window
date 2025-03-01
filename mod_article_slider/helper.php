<?php
defined('_JEXEC') or die;

class ModArticleSliderHelper {
    public static function getArticles($params) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Select fields
        $query->select('id, title, introtext, images, hits, alias')
              ->from($db->quoteName('#__content'))
              ->where($db->quoteName('state') . ' = 1') // Only published articles
              ->order('hits DESC'); // Order by most viewed

        // Filter by category
        if ($params->get('catid')) {
            $query->where($db->quoteName('catid') . ' = ' . (int) $params->get('catid'));
        }

        // Filter by selected articles
        $selectedArticles = $params->get('selected_articles', []);
        if (!empty($selectedArticles)) {
            $query->where('id IN (' . implode(',', array_map('intval', $selectedArticles)) . ')');
        }

        // Limit results
        $query->setLimit((int) $params->get('limit', 5));

        $db->setQuery($query);
        return $db->loadObjectList();
    }
    public static function getCategoryOptions()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select($db->quoteName(['id', 'title']))
            ->from($db->quoteName('#__categories'))
            ->where($db->quoteName('extension') . ' = ' . $db->quote('com_content'))
            ->where($db->quoteName('published') . ' = 1')
            ->order($db->quoteName('title') . ' ASC');

        $db->setQuery($query);
        $categories = $db->loadObjectList();

        $options = '';
        foreach ($categories as $category) {
            $options .= '<option value="' . htmlspecialchars($category->id) . '">' . htmlspecialchars($category->title) . '</option>';
        }

        return $options;
    }
}
