<?php
if (!class_exists("EzPlugin")) {

  class EzPlugin {

    var $name, $key, $slogan;
    var $adminLogo, $mainLogo;
    var $isPro, $strPro, $plgDir, $plgURL;
    var $css = array();
    var $wpRoot, $keyEp, $endPoint, $siteUrl;

    function __construct($file) { //constructor
      if (defined('ABSPATH')) {
        $this->plgDir = dirname($file);
        $this->plgURL = plugin_dir_url($file);
        $this->siteUrl = site_url();
        $this->wpRoot = parse_url($this->siteUrl, PHP_URL_PATH);
        if (empty($this->wpRoot) || $this->wpRoot == DIRECTORY_SEPARATOR) {
          $this->wpRoot = "";
        }
        else {
          $this->wpRoot .= DIRECTORY_SEPARATOR;
        }
        $this->siteUrl .= '/';
        $this->keyEp = $this->key . '-ep';
        $this->endPoint = $this->siteUrl . $this->keyEp;
        $this->isPro = file_exists("{$this->plgDir}/admin/options-advanced.php");
      }
      if ($this->isPro) {
        $this->strPro = 'Pro';
      }
      else {
        $this->strPro = 'Lite';
      }
    }

    static function isEmptyHtaccess($data) {
      if (empty($data)) {
        return true;
      }
      $lines = explode("\n", $data);
      foreach ($lines as $l) {
        $l = trim($l);
        if (empty($l)) {
          continue;
        }
        if ($l[0] == '#') {
          continue;
        }
        return false;
      }
      return true;
    }

    function mkHtaccess() {
      $file = ABSPATH . ".htaccess";
      $data = "
# BEGIN WordPress: Inserted by $this->name
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase $this->wpRoot
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . {$this->wpRoot}index.php [L]
</IfModule>
# END WordPress: Inserted by $this->name
";
      if (file_exists($file)) {
        // Dangerous to create
        $currentData = file_get_contents($file);
        if (!self::isEmptyHtaccess($currentData)) {
          $currentData = htmlspecialchars($currentData);
          $data = htmlspecialchars($data);
          return "<p>You already have an <code>.htaccess</code> file (<code>$file</code>) with these contents:</p><pre>$currentData</pre><p>Please edit it and add the <a href='https://codex.wordpress.org/htaccess' target='_blank' class='popup-long'>standard WordPress directives</a>  (pointing all missing files to <code>index.php</code>). Here is what you need to add:</p><pre>$data</pre>";
        }
      }
      // No htaccess or it is empty. Safe to create a default one.
      $url = wp_nonce_url('plugin-install.php', 'plugin-install');
      $creds = request_filesystem_credentials($url, '', false, false, ABSPATH);
      if ($creds !== false) {
        WP_Filesystem($creds);
        global $wp_filesystem;
        if (!empty($wp_filesystem)) {
          $abspath = trailingslashit($wp_filesystem->abspath());
          $file = "{$abspath}.htaccess";
          if ($wp_filesystem->put_contents($file, "$currentData\n$data")) {
            return "A default <code>.htaccess</code> has been created for you.";
          }
        }
      }
      else {
        // Cannot create a new one.
        $data = htmlspecialchars($data);
        return "<p>You do not have an <code>.htaccess</code> file and it does not look like I can create one for you. Please create <code>$file</code> and add the <a href='https://codex.wordpress.org/htaccess' target='_blank' class='popup-long'>standard WordPress directives</a> (pointing all missing files to <code>index.php</code>). Here is what you need to add:</p><pre>$data</pre>";
      }
    }

    static function install($dir, $mOptions) {
      $ezOptions = get_option($mOptions);
      if (empty($ezOptions)) {
        // create the necessary tables
        $GLOBALS['isInstallingWP'] = true;
        chdir($dir . '/admin');
        require_once('dbSetup.php');
        $ezOptions['isSetup'] = true;
      }
      update_option($mOptions, $ezOptions);
    }

    static function uninstall($mOptions) {
      delete_option($mOptions);
    }

    function printAdminPage() {
      ?>
      <div id="loading" class="updated"><h2><img src="<?php echo $this->plgURL; ?>/admin/img/loading.gif" alt="Loading">&emsp; Loading... Please wait!</h2></div>
      <?php
      $permaStructure = get_option('permalink_structure');
      if (empty($permaStructure)) {
        $htaccessMsg = $this->mkHtaccess();
        $permalink = admin_url('options-permalink.php');
        ?>
        <div class='error' style='padding:10px;margin:10px;color:#a00;font-weight:500;background-color:#fee;display:none' id="permalinks">
          <p><strong>Permalinks</strong> are not enabled on your blog, which this plugin needs. Please <a href='<?php echo $permalink; ?>'>enable a permalink structure</a> for your blog from <strong><a href='<?php echo $permalink; ?>'>Settings &rarr; Permalinks</a></strong>. Any structure (other than the ugly default structure using <code><?php echo site_url(); ?>/?p=123</code>) will do. Note that you may need to manually update your <code>.htaccess</code> file in certain installations.</p>
          <?php echo $htaccessMsg; ?>
        </div>
        <?php
      }
      else {
        ?>
        <div class='error' style='padding:10px;margin:10px;color:#a00;font-weight:500;background-color:#fee;display:none' id="adBlocked">
          <strong>AdBlock</strong>: This plugin loads its admin pages in an iFrame, which may look like an ad to some browser-side ad blockers. If you are running AdBlock or similar extensions on your browser, please disable it for your blog domain so that the admin page is not blocked. Looks like your browser is preventing the admin pages from being displayed.
        </div>
        <?php
      }
      if (!empty($_REQUEST['target'])) {
        $src = "{$this->endPoint}/admin/{$_REQUEST['target']}";
      }
      else if (!empty($lastSrc)) {
        $src = "{$this->endPoint}/admin/$lastSrc";
      }
      else {
        $src = "{$this->endPoint}/admin/index.php";
      }
      ?>
      <script>
        var errorTimeout;
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
          errorTimeout = setTimeout(function () {
            jQuery("#the_iframe").fadeOut();
            jQuery("#adBlocked, #permalinks").fadeIn();
          }, 8000);
          jQuery("#loading").delay(10000).fadeOut();
        });
      </script>
      <?php
      echo "<iframe src='$src' frameborder='0' style='width:100%;position:absolute;top:5px;left:-10px;right:0px;bottom:0px;'  width='100%' height='900px' id='the_iframe' onLoad='calcHeight();'></iframe>";
    }

    function parseRequest(&$wp) {
      if (strpos($_SERVER['REQUEST_URI'], $this->keyEp) === false) {
        return;
      }
      $request = $_SERVER['REQUEST_URI'];
      if (!empty($this->wpRoot)) {
        $request = str_replace($this->wpRoot, "", $_SERVER['REQUEST_URI']);
      }
      $request = trim($request, DIRECTORY_SEPARATOR);
      if (strpos($request, $this->keyEp) !== 0) {
        return;
      }
      $request = preg_replace('/\?.*/', '', $request);
      $request = preg_replace("/$this->keyEp/", basename($this->plgDir), $request, 1);
      $target = WP_PLUGIN_DIR . "/" . $request;
      if (file_exists($target)) {
        chdir(dirname($target));
        $ext = substr($target, -3);
        if ($ext == 'php') {
          include $target;
        }
        else {
          $url = str_replace(ABSPATH, $this->siteUrl, $target);
          header("location: $url");
        }
        exit();
      }
    }

  }

} //End Class EzPlugin
