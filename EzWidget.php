<?php

abstract class EzWidget extends WP_Widget {

  var $widgetName;
  static $plg;

  function __construct($className = 'EzWidget', $widgetName = '') {
    $this->widgetName = $widgetName;
    $widget_ops = array('classname' => $className,
        'description' => sprintf(__("Show %s ad block in your sidebar as a widget.", 'easy-ads'), $widgetName));
    parent::__construct($className, $widgetName, $widget_ops);
  }

  abstract function getAdText();

  abstract function getTitle();

  abstract function decorate($adText);

  function widget($args, $instance) {
    $adText = $this->getAdText();
    if (!empty($adText)) {
      $before_widget = $before_title = $after_title = $after_widget = '';
      extract($args);
      $title = $this->getTitle();
      if (empty($title)) {
        $title = apply_filters('widget_title', $instance['title']);
      }
      echo $before_widget;
      echo $before_title . $title . $after_title;
      echo $this->decorate($adText);
      echo $after_widget;
    }
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = '';
    if (!empty($new_instance['title'])) {
      $instance['title'] = strip_tags($new_instance['title']);
    }
    return $instance;
  }

  function form($instance) {
    require 'EzGA.php';
    $plgName = EzGA::getPlgName();
    echo "<p>" . sprintf(__("Configure it at %s", 'easy-ads'), "<br /><a href='options-general.php?page=wp-google-adsense.php'> " . __("Settings", 'easy-ads') . " &rarr; $plgName</a></p>\n");
  }

  static function setPlugin(&$plg) {
    self::$plg = $plg;
  }

}
