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
      // TODO: merge fails when page has 'highlight: true'
      // $this->config->set('plugins.photon-highlight', array_merge($defaults, $page->header()->highlight));
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
    $page = $this->grav['page'];
    $assets = $this->grav['assets'];

    // only load the vars if this datatype page
    $header = $page->header();
    $highlight = isset($header->highlight) ? $header->highlight : false;

    if ( $highlight ) {
      $theme = $this->config->get('plugins.photon-highlight.theme') ?: 'default';
      $assets->addCss('plugin://photon-highlight/assets/highlight-10.5.0/styles/'.$theme.'.css');
      $assets->addJs('plugin://photon-highlight/assets/highlight-10.5.0/highlight.pack.js');

      $init = "
      hljs.initHighlightingOnLoad();\n";
        if ($this->config->get('plugins.photon-highlight.lines')) {
          $init .= "
      hljs.initLineNumbersOnLoad();\n";
        }
      $assets->addInlineJs($init);
    }
  }
}
