<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Interfaces\PageInterface;

class PhotonHighlightPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPageInitialized' => ['onPageInitialized', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPageInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $defaults = (array) $this->config->get('plugins.photon-highlight');

        /** @var PageInterface $page */
        $page = $this->grav['page'];
        if (isset($page->header()->highlight)) {
            $this->config->set('plugins.photon-highlight', array_merge($defaults, $page->header()->highlight));
        }
        if ($this->config->get('plugins.photon-highlight.enabled')) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        }
    }

    /**
     * if enabled on this page, load the JS + CSS theme.
     */
    public function onTwigSiteVariables()
    {
        $init = "hljs.initHighlightingOnLoad();\n";
        if ($this->config->get('plugins.photon-highlight.lines')) {
            $init .= "hljs.initLineNumbersOnLoad();\n";
        }
        $theme = $this->config->get('plugins.photon-highlight.theme') ?: 'default';
        $this->grav['assets']->addCss('plugin://photon-highlight/css/'.$theme.'.css');
        $this->grav['assets']->addJs('plugin://photon-highlight/js/highlight.pack.js');
        if ($this->config->get('plugins.photon-highlight.lines')) {
            $this->grav['assets']->addJs('plugin://photon-highlight/js/highlightjs-line-numbers.min.js');
            $this->grav['assets']->addCss('plugin://photon-highlight/css/highlightjs-line-numbers.css');
        }
        $this->grav['assets']->addInlineJs($init);
    }
}
