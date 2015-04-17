<?php

if (!class_exists("EzAdsWidget")) {
  require_once 'EzWidget.php';

  class EzAdsWidget extends EzWidget {

    function __construct() {
      parent::__construct("EzAdsWidget", "Easy AdSense: Widget");
    }

    function getAdText() {
      $plg = self::$plg;
      EzGA::preFilter("", true);
      if (EzGA::$noAds) {
        return;
      }
      $metaOptions = EzGA::getMetaOptions();
      $show_widget = $metaOptions['show_widget'];
      if ($show_widget == 'no') {
        return;
      }
      $plg->options['text_widget'] = EzGA::handleDefaultText($plg->options['text_widget'], '160x600');
      $ezMax = EzGA::$options['max_count'];
      if ($plg->ezCount() < $ezMax) {
        return $plg->mkAdBlock("widget");
      }
    }

    function getTitle() {
      $plg = self::$plg;
      if (empty($plg->options['title_widget'])) {
        $title = __('Sponsored Links', 'easy-adsenser');
      }
      else {
        $title = stripslashes(htmlspecialchars($plg->options['title_widget']));
      }
      return $title;
    }

    function decorate($adText) {
      if (!empty($adText)) {
        echo "<div class='adsense adsense-widget'>$adText</div>\n";
      }
    }

  }

  add_action('widgets_init', create_function('', 'return register_widget("EzAdsWidget");'));

  class EzAdsSearch extends EzWidget {

    function __construct() {
      parent::__construct("EzAdsSearch", "Easy AdSense: Google Search");
    }

    function getAdText() {
      $plg = self::$plg;
      EzGA::preFilter("", true);
      if (EzGA::$noAds) {
        return;
      }
      $plg->options['text_gsearch'] = EzGA::handleDefaultText($plg->options['text_gsearch'], '200x90');
      $metaOptions = EzGA::getMetaOptions();
      if (isset($metaOptions['adsense']) && $metaOptions['adsense'] == 'no') {
        return;
      }
      $title_gsearch = $metaOptions['title_gsearch'];
      if ($title_gsearch == 'no') {
        return;
      }
      if (!empty($plg->options['kill_linebreaks'])) {
        $linebreak = "";
      }
      else {
        $linebreak = "\n";
      }
      $margin = $plg->options['margin_gsearch'];
      if (!empty($plg->options['kill_inline'])) {
        $inline = '';
      }
      else {
        $inline = "style='margin:{$margin}px;'";
      }
      $text = stripslashes("<div class='ezAdsense adsense adsense-search'><div $inline>"
              . "$linebreak {$plg->options['text_gsearch']}"
              . "$linebreak</div></div>");
      return $text;
    }

    function getTitle() {
      $plg = self::$plg;
      $title = '';
      $metaOptions = EzGA::getMetaOptions();
      $title_gsearch = $metaOptions['title_gsearch'];
      if ($title_gsearch != 'no') {
        $imgUrl = plugins_url('admin/img', __FILE__);
        $title = $title_gsearch;
        if ($title_gsearch == 'dark') {
          $title = "<img src='$imgUrl/google-dark.gif' border=0 alt='[Google]' align='middle'/>";
        }
        else if ($title_gsearch == 'light') {
          $title = "<img src='$imgUrl/google-light.gif' border=0 alt='[Google]' align='middle'/>";
        }
        else if ($title_gsearch == 'customized') {
          $title = $plg->options['title_gsearch_custom'];
        }
      }
      return $title;
    }

    function decorate($adText) {
      if (!empty($adText)) {
        echo "<div class='adsense adsense-search'>$adText</div>\n";
      }
    }

  }

  add_action('widgets_init', create_function('', 'return register_widget("EzAdsSearch");'));

  class EzAdsLU extends EzWidget {

    function __construct() {
      parent::__construct("EzAdsLU", "Easy AdSense: Google Link Unit");
    }

    function getAdText() {
      $plg = self::$plg;
      EzGA::preFilter("", true);
      if (EzGA::$noAds) {
        return;
      }
      $plg->options['text_lu'] = EzGA::handleDefaultText($plg->options['text_lu'], '200x90');
      $metaOptions = EzGA::getMetaOptions();
      if (isset($metaOptions['adsense']) && $metaOptions['adsense'] == 'no') {
        return;
      }
      $show_lu = $metaOptions['show_lu'];
      if ($show_lu == 'no') {
        return;
      }
      return $plg->mkAdBlock("lu");
    }

    function getTitle() {
      $plg = self::$plg;
      if (empty($plg->options['title_lu'])) {
        $title = __('Link Units', 'easy-adsenser');
      }
      else {
        $title = stripslashes(htmlspecialchars($plg->options['title_lu']));
      }
      return $title;
    }

    function decorate($adText) {
      if (!empty($adText)) {
        echo "<div class='adsense adsense-lu'>$adText</div>\n";
      }
    }

  }

  add_action('widgets_init', create_function('', 'return register_widget("EzAdsLU");'));
}