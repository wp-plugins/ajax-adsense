<?php require('header.php'); ?>
<div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">Dashboard</a>
    </li>
  </ul>
</div>

<?php
require 'easy-adsense-options.php';
EzGA::putDefaults($ezOptions);
insertAlerts();
?>
<div class="col-md-12">
  <?php
  openRow();
  openCell("Settings for your Easy AdSense Plugin", 'cog', 7);
  ?>
  <p>This plugin, working in Easy AdSense mode, will let you place up to three ad blocks in your pages and posts, with independent ad code that you <a href="https://support.google.com/adsense/answer/181960" target='_blank' class='popup'>generate</a> from your AdSense homepage. In addtion, you can have as many widgets, <a href='https://support.google.com/adsense/answer/15817' target='_blank' class='popup'>link units</a> or <a href='https://support.google.com/adsense/answer/160530' target='_blank' class='popup'>search boxes</a>, all generating revenue for you.</p>
  <p>This plugin remembers your settings for each WordPress theme that you use. Currently, you are editing the settings for the theme <strong><code><?php echo $options['theme']; ?></code></strong>.</p>
  <p>More help is available. Click the button below to show or hide it.</p>
  <a href='#' id="showAdvanced" class="btn-sm btn-primary">Show More Help</a>
  <a href='#' id="hideHelp" class="btn-sm btn-warning">Hide Top Panels</a>
  <?php
  closeCell();
  require 'box-optionset.php';
  closeRow();
  ?>
  <div id='advancedHelp'>
    <?php
    openBox("More Help");
    ?>
    <div class="col-md-6 col-sm-12">
      <h4><?php _e('How to Set it up', 'easy-adsenser'); ?></h4>
      <ol>
        <li>
          <?php _e('<a href="https://support.google.com/adsense/answer/181960" target="_blank" class="popup">Generate</a> AdSense code (from your <a href="http://www.google.com/adsense" target="_blank" class="popup">AdSense homepage</a>, click on <strong>My ads</strong> tab, click on <strong>+ New ad unit</strong>).', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('Cut and paste the AdSense code into the boxes below, deleting the existing text.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('Decide how to align and show the code in your blog posts.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('Take a look at the Google policy option, and other options. The defaults should work.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php printf(__('If you want to use the widgets, drag and drop them at %s Appearance (or Design) &rarr; Widgets %s', 'easy-adsenser'), '<a href="widgets.php">', '</a>.'); ?>
        </li>
      </ol>
      <h4><?php _e('How to Control AdSense on Each Post', 'easy-adsenser'); ?></h4>
      <ul>
        <li>
          <?php _e('If you want to suppress AdSense in a particular post or page, give the <b><em>comment </em></b> <code>&lt;!--noadsense--&gt;</code> somewhere in its text.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('Or, insert a <b><em>Custom Field</em></b> with a <b>key</b> <code>adsense</code> and give it a <b>value</b> <code>no</code>.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('Other <b><em>Custom Fields</em></b> you can use to fine-tune how a post or page displays AdSense blocks are:', 'easy-adsenser'); ?>
          <ul>
            <li>
              <b>Keys</b>: <code>adsense-top</code>, <code>adsense-middle</code>, <code>adsense-bottom</code>, <code>adsense-widget</code>, <code>adsense-search</code>
            </li>
            <li>
              <b>Values</b>: <code>left</code>, <code>right</code>, <code>center</code>, <code>no</code>.
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="col-md-6 col-sm-12">
      <h4><?php _e('Sidebar Widgets, Link Units or Google Search', 'easy-adsenser'); ?></h4>
      <?php _e('<em>Easy AdSense</em> gives you widgets to embelish your sidebars. You can configure them here (on the right hand side of the Options table below) and place them on your page using <a href="widgets.php"> Appearance (or Design) &rarr; Widgets</a>.', 'easy-adsenser'); ?>
      <ul>
        <li>
          <?php _e('<b>AdSense Widget</b> is an ad block widget that you can place any where on the sidebar. Typically, you would put a skyscraper block (160x600px, for instance) on your sidebar, but you can put anything -- not necessarily AdSense code.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('<b>AdSense Link Units</b>, if enabled, give you multiple widgets to put <a href="https://support.google.com/adsense/answer/15817"  target="_blank" class="popup">link units</a> on your sidebars. You can display three of them according to Google AdSense policy, and you can configure the number of widgets you need.', 'easy-adsenser'); ?>
        </li>
        <li>
          <?php _e('<b>Google Search Widget</b> gives you another widget to place a <a href="https://support.google.com/adsense/answer/160530"  target="_blank" class="popup">custom AdSense search box</a> on your sidebar. You can customize the look of the search box and its title by configuring them on this page.', 'easy-adsenser'); ?>
        </li>
      </ul>
    </div>
    <div class="clearfix"></div>
    <?php
    closeBox();
    ?>
  </div>
</div>
<div class="clearfix"></div>
<div id="left" class="col-md-6 col-sm-12 pull-left">
  <?php
  openBox(__('Lead-in Ad Block', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('text_leadin', $ezOptions['text_leadin']);
    ?>
  </div>
  <div class="col-md-5 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('header_leadin', $ezOptions['header_leadin']);
    ?>
  </div>
  <div class="col-md-3 col-sm-6">
    <?php
    echo EzGA::renderOptionCell('margin_leadin', $ezOptions['margin_leadin']);
    ?>
  </div>
  <div class="col-md-4 col-sm-6">
    <?php
    echo EzGA::renderOptionCell('wc_leadin', $ezOptions['wc_leadin']);
    ?>
  </div>
  <div class="clearfix"></div>
  <?php
  closeBox();

  openBox(__('Mid-Post Ad Block', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('text_midtext', $ezOptions['text_midtext']);
    ?>
  </div>
  <div class="col-md-5 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('force_midad', $ezOptions['force_midad']);
    ?>
  </div>
  <div class="col-md-3 col-sm-6">
    <?php
    echo EzGA::renderOptionCell('margin_midtext', $ezOptions['margin_midtext']);
    ?>
  </div>
  <div class="col-md-4 col-sm-6">
    <?php
    echo EzGA::renderOptionCell('wc_midtext', $ezOptions['wc_midtext']);
    ?>
  </div>
  <div class="clearfix"></div>
  <?php
  closeBox();

  openBox(__('Lead-out Ad Block', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('text_leadout', $ezOptions['text_leadout']);
    ?>
  </div>
  <div class="col-md-5 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('footer_leadout', $ezOptions['footer_leadout']);
    ?>
  </div>
  <div class="col-md-3 col-sm-6">
    <?php
    echo EzGA::renderOptionCell('margin_leadout', $ezOptions['margin_leadout']);
    ?>
  </div>
  <div class="col-md-4 col-sm-6">
    <?php
    echo EzGA::renderOptionCell('wc_leadout', $ezOptions['wc_leadout']);
    ?>
  </div>
  <div class="clearfix"></div>
  <?php
  closeBox();

  require 'box-ad-alignment.php';

  openBox(__('Other Options', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('max_count', $ezOptions['max_count']);
    ?>
  </div>
  <div>&nbsp;</div>

  <div class="col-md-3">
    <?php
    echo EzGA::renderOptionCell('show_borders', $ezOptions['show_borders']);
    ?>
  </div>
  <div class="col-md-3">
    <?php
    echo EzGA::renderOptionCell('border_width', $ezOptions['border_width']);
    ?>
  </div>
  <div class="col-md-3">
    <?php
    echo EzGA::renderOptionCell('border_widget', $ezOptions['border_widget']);
    ?>
  </div>

  <div class="col-md-3">
    <?php
    echo EzGA::renderOptionCell('border_lu', $ezOptions['border_lu']);
    ?>
  </div>
  <div class="col-md-6">
    <?php
    echo EzGA::renderOptionCell('border_normal', $ezOptions['border_normal']);
    ?>
  </div>

  <div class="col-md-6">
    <?php
    echo EzGA::renderOptionCell('border_color', $ezOptions['border_color']);
    ?>
  </div>
  <div class="clearfix"></div>
  <div>&nbsp;</div>

  <div class="col-md-12">
    <table class="table">
      <tbody>
        <tr>
          <?php
          echo EzGA::renderOptionCell('force_widget', $ezOptions['force_widget']);
          echo EzGA::renderOptionCell('kill_inline', $ezOptions['kill_inline']);
          ?>
        </tr>
        <tr>
          <?php
          echo EzGA::renderOptionCell('kill_linebreaks', $ezOptions['kill_linebreaks']);
          echo EzGA::renderOptionCell('suppressBoxes', $ezOptions['suppressBoxes']);
          ?>
        </tr>
      </tbody>
      <tfoot><tr><td colspan="4"></td></tr></tfoot>
    </table>
  </div>

  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('max_link', $ezOptions['max_link']);
    ?>
  </div>

  <div class="clearfix"></div>
  <?php
  closeBox();
  ?>
</div>
<div id="right" class="col-md-6 col-sm-12">
  <?php
  openBox(__('AdSense Widget', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('text_widget', $ezOptions['text_widget']);
    ?>
  </div>
  <div class="col-md-9 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('title_widget', $ezOptions['title_widget']);
    ?>
  </div>
  <div class="col-md-3 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('kill_widget_title', $ezOptions['kill_widget_title']);
    ?>
  </div>
  <div class="col-md-3 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('margin_widget', $ezOptions['margin_widget']);
    ?>
  </div>
  <div class="col-md-9 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('show_widget', $ezOptions['show_widget']);
    ?>
  </div>
  <div class="clearfix"></div>
  <?php
  closeBox();

  openBox(__('AdSense Link Units', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('text_lu', $ezOptions['text_lu']);
    ?>
  </div>
  <div class="col-md-9 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('title_lu', $ezOptions['title_lu']);
    ?>
  </div>
  <div class="col-md-3 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('kill_lu_title', $ezOptions['kill_lu_title']);
    ?>
  </div>
  <div class="col-md-3 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('margin_lu', $ezOptions['margin_lu']);
    ?>
  </div>
  <div class="col-md-9 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('show_lu', $ezOptions['show_lu']);
    ?>
  </div>
  <div class="clearfix"></div>
  <?php
  closeBox();

  openBox(__('Google Search Widget', 'easy-adsenser'));
  ?>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('text_gsearch', $ezOptions['text_gsearch']);
    ?>
  </div>
  <div class="col-md-12">
    <?php
    echo EzGA::renderOptionCell('title_gsearch', $ezOptions['title_gsearch']);
    ?>
  </div>
  <div class="col-md-7 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('title_gsearch_custom', $ezOptions['title_gsearch_custom']);
    ?>
  </div>
  <div class="col-md-3 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('kill_gsearch_title', $ezOptions['kill_gsearch_title']);
    ?>
  </div>
  <div class="col-md-2 col-sm-12">
    <?php
    echo EzGA::renderOptionCell('margin_gsearch', $ezOptions['margin_gsearch']);
    ?>
  </div>
  <div class="clearfix"></div>
  <?php
  closeBox();

  require 'box-suppressing-ads.php';
  require 'box-more-info.php';
  ?>
</div>
<script>
  var xeditHandler = 'ajax/options.php';
  var xparams = {};
  xparams.plugin_slug = '<?php echo $options['plugin_slug']; ?>';
  xparams.theme = '<?php echo $options['theme']; ?>';
  xparams.provider = '<?php echo $options['provider']; ?>';
  xparams.optionset = '<?php echo $options['optionset']; ?>';
  $("#showAdvanced").click(function (e) {
    e.preventDefault();
    $("#advancedHelp").find(".btn-minimize").click();
    if ($(this).text() === 'Show More Help')
      $(this).text('Hide Help');
    else
      $(this).text('Show More Help');
  });
  $("#hideHelp").click(function (e) {
    e.preventDefault();
    $(this).closest(".row").find(".glyphicon-chevron-up").click();
  });
  $(document).ready(function () {
    setTimeout(function () {
      $("#advancedHelp").find(".btn-minimize").click();
    }, 10);
  });
</script>
<?php
require_once 'footer.php';
