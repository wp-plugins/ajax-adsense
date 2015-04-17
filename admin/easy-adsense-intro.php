<div style="float:right;display:inline-block">
  <?php
  EzGA::showService();
  ?>
</div>
<h2>Easy Plugin for AdSense<br>
  <small>Complete Control over Your AdSense Ads</small>
</h2>
<p><em>Easy AdSense</em> provides a very easy way to generate revenue from your blog using Google AdSense. With its full set of features, this Ads EZ plugin is perhaps the first plugin to give you a complete solution for everything AdSense-related.</p>

<p><strong>Easy AdSense (AKA Easy Plugin for AdSense)</strong>: The most popular AdSense plugin for WordPress, Easy AdSense lets you place up to three ads on your posts and pages, with independent ad codes. In addtion, you can add widgets to your side bar with ads, <a href='https://support.google.com/adsense/answer/15817' target='_blank' class='popup'>link units</a> or <a href='https://support.google.com/adsense/answer/160530' target='_blank'class='popup'>search boxes</a>, all generating revenue for you.</p>

<p>
  <a class="btn btn-primary btn-help" data-toggle='tooltip' title="<p>View plugin features.<br>What can this plugin do?</p>" data-content="<p>Easy Plugin for AdSense provides a very easy way to generate revenue from your blog using Google AdSense. With its full set of features, Easy Plugin for AdSense is perhaps the first plugin to give you a complete solution for everything AdSense-related.</p><ol>
     <li>Easy Plugin for AdSense enforces the Google AdSense policy of not more than three adsense blocks per page.</li>
     <li>Easy Adsense provides Sidebar Widgets:
     <ul>
     <li>For AdSense for content with custom title.</li>
     <li>For search with customizable text or image title.</li>
     <li>For Link Units.</li>
     </ul></li>
     <li>Easy Plugin for AdSense has a rich set of Options:
     <ul>
     <li>Put Link Units or AdSense Blocks in header or footer.</li>
     <li>Suppress ads on all pages (as opposed to posts), or on the front/home page.</li>
     <li>Add a customizable mouse-over border decoration on ad blocks.</li>
     <li>Display adsense blocks based on the post length.</li>
     </ul></li>
     <li>Easy Plugin for AdSense lets you control over the positioning and display of AdSense blocks in each post or page.</li>
     <li>Easy Plugin for AdSense sports the simplest possible configuration interface -- nothing more than cutting and pasting AdSense code, and with sensible defaults for the few options present, all with clear instructions.</li>
     <li>Easy Plugin for AdSense is internationalized with multiple languages supported.</li>
     <li>Popover help for every option in the plugin.</li>
     <li>An interface tour to familiarize yourself with the plugin features and layout.</li>
     <li>Ability to spawn the plugin interface as a separate tab/window independent of the WordPress admin interface.</li>
     </ol>"><i class='glyphicon glyphicon-send'></i> Features</a>

  <a class="btn btn-primary btn-help" data-toggle='tooltip' title="<p>View Pro Features of this Plugin.<br>Why go Pro? You get all the basic features plus these!</p>" data-content="<p>In addition to the fully functional Lite version, there is a <a href='http://buy.thulasidas.com/easy-adsense' title='Get Easy AdSense Pro for $7.95' class='goPro' data-product='easy-adsense'>Pro Version</a> with many more features.</p>
     <p>If the following features are important to you, consider buying the <em>Pro</em> version.</p><ol>
     <li>Safe Content filter: To ensure that your Google AdSense ads show only on those pages that seem to comply with Google AdSense policies, which can be important since some comments may render your pages inconsistent with those policies.</li>
     <li>IP filter: Ability to specify a list of computers where your ads will not be shown, in order to prevent accidental clicks on your own ads -- one of the main reasons AdSense bans you. These features will minimize your chance of getting banned.</li>
     <li>Compatibility mode: To solve the issue of the ad insertion messing up your page appearances when using some themes.</li>
     <li>Category/Post Control: Ability to suppress ads on specific categories, posts and pages.</li>
     <li>Shortcode Support: Show the ads only on the pages or posts you want, and exactly where you want them.</li>
     <li>Mobile Support: Ability to show different sets of ads on mobile devices, or to suppress ads.</li>
     <li>Excerpts: Ability to show a configurable number of ads on Excerpts (which make up the home page in some themes).</li>
     <li>Option Sets: Multiple option sets can be defined and easily switched between.</li>
     <li>Suspend Ads: Ability to temporarily suppress ad serving.</li>
     <li>Admin Interface Themes: Multiple color schemes for the admin interface.</li>
     <li>Ad Serving Statistics: Keep an eye on your ad serving statistics to make sure that Google is not shortchanging you. (Optional paid module)</li>
     </ol><div class='center-block'><a class='btn btn-sm btn-danger center-block goPro' href='http://buy.thulasidas.com/easy-adsense' title='Get Easy AdSense Pro for $7.95' data-product='easy-adsense'>Go Pro!</a></div>"><i class='glyphicon glyphicon-plane'></i> Pro Features</a>

  <a href='easy-adsense-admin.php' class="btn btn-warning" data-toggle='tooltip' title="<p>Set up the plugin options and enter your AdSense code and details. You can also click on the <strong>Easy AdSense</strong> tab above.</p>"><i class='glyphicon glyphicon-cog'></i> Setup Plugin</a>

  <a href='#' id='suspendAds' class="btn btn-danger" data-toggle='tooltip' title="<p>Pause ad serving.</p>"><i class='glyphicon glyphicon-pause'></i> Suspend Ads</a>

  <a href='#' id='resumeAds' style='display:none' class="btn btn-success" data-toggle='tooltip' title="<p>Resume ad serving.</p>"><i class='glyphicon glyphicon-play'></i> Resume Ads</a>

  <a href='#' id='migrateOptions' class="btn btn-success" data-toggle='tooltip' title="<p>This version of the plugin uses a new option model. If you used an older version before, your options are automatically imported when you activate the plugin. If you find them missing, please click this button to import them again. Note that your modified options are never overwritten by the migration process; so it is safe to run it again.</p>"><i class='glyphicon glyphicon-import'></i> Import Options</a>

</p>
<div class="clearfix"></div>
<script>
  $(document).ready(function () {
    $("#suspendAds").click(function () {
      suspendAds('suspend');
    });
    $("#resumeAds").click(function () {
      suspendAds('resume');
    });
    $("#migrateOptions").click(function (e) {
      e.preventDefault();
      var data = {};
      data.action = 'migrate';
      $.ajax({url: 'ajax/optionset.php',
        type: 'POST',
        data: data,
        success: function (a) {
          flashSuccess(a);
        },
        error: function (a) {
          showError(a.responseText);
        }});
    });
  });
</script>