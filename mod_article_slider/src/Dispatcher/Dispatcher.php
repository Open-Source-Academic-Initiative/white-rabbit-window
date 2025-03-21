<?php
namespace OpenSAI\Article\Slider\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
use OpenSAI\Article\Slider\Site\Helper\ArticleSliderHelper;


class Dispatcher implements DispatcherInterface
{
    protected $module;
    
    protected $app;

    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        $this->module = $module;
        $this->app = $app;
    }
    
    public function dispatch()
    {
        $language = $this->app->getLanguage();

        //$language->load('mod_article_slider', JPATH_BASE . '/modules/mod_article_slider');
        
        $params = new Registry($this->module->params);
        
        $username = ArticleSliderHelper::getLoggedonUsername('Guest');
        $articles = ArticleSliderHelper::getArticles($params);
        $randomFlag = ArticleSliderHelper::getRandom($params);


        //$hello = Text::_('MOD_HELLO_GREETING') . $username;
        $hello="Hello {$username}";       

        //require ModuleHelper::getLayoutPath('mod_hello');
        require ModuleHelper::getLayoutPath('mod_article_slider');    

        
        // $username = ArticleSliderHelper::getLoggedonUsername('Guest');
        
        // $hello="Hello {$username}";

        // require ModuleHelper::getLayoutPath('mod_article_slider');    
    }
}