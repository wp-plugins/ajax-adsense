<?php
include('ezKillLite.php');

if (is_admin()) {
  if (!class_exists("GoogleAdSense")) {
    require_once 'EZWP.php';

    class GoogleAdSense {

      var $isPro, $plgName, $plgDir, $plgURL, $options;
      var $ezTran, $slug, $domain;

      function GoogleAdSense() { //constructor
        $this->plgDir = dirname(__FILE__);
        $this->plgURL = plugin_dir_url(__FILE__);
        $this->isPro = file_exists("{$this->plgDir}/admin/options-advanced.php");
        $this->slug = EZWP::getSlug("{$this->plgDir}/admin");
        $this->plgName = EZWP::getPlgName("{$this->plgDir}/admin");
        require_once 'EzTran.php';
        $this->ezTran = new EzTran(__FILE__, $this->plgName, $this->slug);
        $this->ezTran->setLang();
      }

      function getQuery($atts) {
        $query = "";
        $vars = array("id" => "", "code" => "", "key" => "");
        $vars = shortcode_atts($vars, $atts);
        foreach ($vars as $k => $v) {
          if (!empty($v)) {
            $query = "&$k=$v";
            return $query;
          }
        }
      }

      function addAdminPage() {
        add_options_page($this->plgName, $this->plgName, 'activate_plugins', basename(__FILE__), array($this, 'printAdminPage'));
      }

      function addWidgets() {
        $widgetFile = "{$this->plgDir}/{$this->slug}-widget.php";
        if (file_exists($widgetFile)) {
          require_once $widgetFile;
        }
        return;
      }

      static function install() {
        require_once 'admin/Migrator.php';
        $migrator = new Migrator();
        $migrator->migrate();
        return;
      }

      function printAdminPage() {
        $isPro = $this->isPro;
        $installImg = $this->plgURL . "admin/img/install.png";
        echo "<div class='error'>";
        require $this->plgDir . '/admin/no-ajax.php';
        if (!empty($_POST['ez_force_admin'])) {
          update_option('ez_force_admin', true);
        }
        $forceAdmin = get_option('ez_force_admin');
        if (!empty($_POST['ez_force_admin_again'])) {
          update_option('ez_force_admin_again', true);
        }
        $forceAdminAgain = get_option('ez_force_admin_again');
        $src = plugins_url("admin/index.php", __FILE__);
        if (!$forceAdmin && !@file_get_contents($src)) {
          ?>
          <div style='padding:10px;margin:10px;font-size:1.3em;color:red;font-weight:500'>
            <p>This plugin needs direct access to its files so that they can be loaded in an iFrame. Looks like you have some security setting denying the required access. If you have an <code>.htaccess</code> file in your <code>wp-content</code> or <code>wp-content/plugins</code>folder, please remove it or modify it to allow access to the php files in <code><?php echo $this->plgDir; ?>/</code>.
            </p>
            <p>
              If you would like the plugin to try to open the admin page, please set the option here:
            </p>
            <form method="post">
              <input type="submit" value="Force Admin Page" name="ez_force_admin">
            </form>
            <p>
              <strong>
                Note that if the plugin still cannot load the admin page after forcing it, you may see a blank or error page here upon reload. If that happens, please deactivate and delete the plugin. It is not compatible with your blog setup.
              </strong>
            </p>
          </div>
          <?php
          return;
        }
        if ($forceAdmin && !$forceAdminAgain) {
          ?>
          <script type="text/javascript">
            var errorTimeout = setTimeout(function () {
              jQuery('#the_iframe').replaceWith("<div class='error' style='padding:10px;margin:10px;font-size:1.3em;color:red;font-weight:500'><p>This plugin needs direct access to its files so that they can be loaded in an iFrame. Looks like you have some security setting denying the required access. If you have an <code>.htaccess</code> file in your <code>wp-content</code> or <code>wp-content/plugins</code>folder, please remove it or modify it to allow access to the php files in <code><?php echo $this->plgDir; ?>/</code>.</p><p><strong>If the plugin still cannot load the admin page after forcing it, please deactivate and delete it. It is not compatible with your blog setup.</strong></p><p><b>You can try forcing the admin page again, which will kill this message and try to load the admin page. <form method='post'><input type='submit' value='Force Admin Page Again' name='ez_force_admin_again'></form><br><br>If you still have errors on the admin page or if you get a blank admin page, you really have to consider one of non-AJAX the options listed above.</b></p></div>");
              jQuery("#noAjax").show();
            }, 1000);
          </script>
          <?php
        }
        echo "</div>";
        ?>
        <script>
          function calcHeight() {
            var w = window,
                    d = document,
                    e = d.documentElement,
                    g = d.getElementsByTagName('body')[0],
                    y = w.innerHeight || e.clientHeight || g.clientHeight;
            document.getElementById('the_iframe').height = y - 70;
          }
          if (window.addEventListener) {
            window.addEventListener('resize', calcHeight, false);
          }
          else if (window.attachEvent) {
            window.attachEvent('onresize', calcHeight);
          }
          jQuery(document).ready(function () {
            jQuery("#noAjax").hide();
          });
        </script>
        <?php
        echo "<iframe src='$src' frameborder='0' style='width:100%;position:absolute;top:5px;left:-10px;right:0px;bottom:0px;' width='100%' height='900px' id='the_iframe' onLoad='calcHeight();'></iframe>";
      }

      static function switchTheme() {
        $oldTheme = EZWP::getGenOption('theme');
        $newTheme = get_option('stylesheet');
        global $wpdb;
        $table = $wpdb->prefix . "ez_adsense_options";
        $sql = "INSERT IGNORE INTO $table (plugin_slug, theme, provider, optionset, name, value) SELECT plugin_slug, '$newTheme', provider, optionset, name, value FROM $table s WHERE theme = '$oldTheme'";
        if ($wpdb->query($sql) === false) {
          // A warning may be shown, but not being able to create the options
          // is not serious enough. They will become defaults anyway.
        }
        EZWP::putGenOption('theme', $newTheme);
      }

      function verifyDB() {
        global $wpdb;
        $table = $wpdb->prefix . "ez_adsense_options";
        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
          $this->install();
        }
        if (!empty($_POST['ez_force_admin'])) {
          update_option('ez_force_admin', true);
        }
        $forceAdmin = get_option('ezadsense_force_admin');
        if ($forceAdmin) {
          update_option('ez_force_admin', true);
          delete_option('ezadsense_force_admin');
        }
      }

    }

    //End Class GoogleAdSense
  }
  else {
    $ezFamily = array("google-adsense/google-adsense.php",
        "google-adsense-lite/google-adsense.php",
        "google-adsense-pro/google-adsense.php",
        "easy-adsense/easy-adsense.php",
        "easy-adsense-pro/easy-adsense.php",
        "easy-adsense-lite/easy-adsense.php",
        "easy-adsense-lite/easy-adsense-lite.php",
        "adsense-now/adsense-now.php",
        "adsense-now-pro/adsense-now.php",
        "adsense-now-lite/adsense-now.php",
        "adsense-now-lite/adsense-now-lite.php");
    $ezActive = array();
    foreach ($ezFamily as $lite) {
      $ezKillLite = new EzKillLite($lite);
      $liteName = $ezKillLite->deny();
      if (!empty($liteName)) {
        $ezActive[$lite] = $liteName;
      }
    }
    if (count($ezActive) > 1) {
      $ezAdminNotice = '<ul>';
      foreach ($ezActive as $k => $p) {
        $ezAdminNotice .= "<li><code>$k</code>: <b>{$p}</b></li>\n";
      }
      $ezAdminNotice .= "</ul>";
      EzKillLite::$adminNotice .= '<div class="error"><p><b><em>Ads EZ Family of Plugins</em></b>: Please have only one of these plugins active.</p>' . $ezAdminNotice . 'Otherwise they will interfere with each other and work as the last one.</div>';
      add_action('admin_notices', array('EzKillLite', 'admin_notices'));
    }
  }

  if (class_exists("GoogleAdSense")) {
    $gAd = new GoogleAdSense();
    if (isset($gAd)) {
      if (method_exists($gAd, 'verifyDB')) {
        $gAd->verifyDB();
      }
      add_action('admin_menu', array($gAd, 'addAdminPage'));
      $gAd->addWidgets();
      $file = dirname(__FILE__) . "/{$gAd->slug}.php";
      register_activation_hook($file, array("GoogleAdSense", 'install'));
      add_action('switch_theme', array("GoogleAdSense", 'switchTheme'));
    }
  }
}
else {
  require plugin_dir_path(__FILE__) . 'EzGA.php';
  EzGA::doPluginActions();
}