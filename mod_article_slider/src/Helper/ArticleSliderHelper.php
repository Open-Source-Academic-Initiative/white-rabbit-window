<?php
namespace OpenSAI\Article\Slider\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;

use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Factory;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;

class ArticleSliderHelper
{
    public static function getLoggedonUsername(string $default)
    {
        $user = Factory::getApplication()->getIdentity();
        if ($user->id !== 0)  // found a logged-on user
        {
            return $user->username;
        }
        else
        {
            return $default;
        }
    }

    public static function getRandom($params)
    {
        // Get module "random?" parameter
        $randomFlag = $params->get('random', '');
        return $randomFlag;
    }

    public static function getArticles($params)
    {
        
        //from official documentation at https://manual.joomla.org/docs/general-concepts/database/select-data/
        $db = Factory::getContainer()->get('DatabaseDriver'); 

        //works but not suggested at: https://api.joomla.org/cms-5/classes/Joomla-CMS-Factory.html
        //$db = Factory::getContainer()->get(DatabaseInterface::class); 

        //works but deprecated? https://github.com/joomla/joomla-cms/discussions/38111
        //$db = Factory::getDbo();
        
        $query = $db->getQuery(true);

        // Get module parameter (comma-separated article IDs)
        $articleIds = $params->get('article_ids', '');
   
        // Convert the string to an array and sanitize values
        $articleIds = array_filter(array_map('intval', explode(',', $articleIds)));

        // Convert array back to a string with comma separation for SQL query
        $articleIdsList = implode(',', $articleIds);

        //$randomFlag = $this->getRandom($params);
        $randomFlag = $params->get('random', '');

        // Ensure we have valid IDs
        if (empty($articleIds)) {
            return [];
        }
        
        if ($randomFlag){
        // Build the query to fetch article details
            $query->select($db->quoteName(['id', 'title', 'introtext', 'images']))
                ->from($db->quoteName('#__content'))
                ->where($db->quoteName('id') . ' IN (' . implode(',', $articleIds) . ')')
                ->order('RAND()'); // random order
        }else{
            $query->select($db->quoteName(['id', 'title', 'introtext', 'images']))
                ->from($db->quoteName('#__content'))
                ->where($db->quoteName('id') . ' IN (' . implode(',', $articleIds) . ')')
                ->order('FIELD(id, ' . $articleIdsList . ')');
        }

        $db->setQuery($query);

        // Fetch and return articles as an array of objects
        return $db->loadObjectList();
    }
}