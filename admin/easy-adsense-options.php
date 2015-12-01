<?php

$ezOptions = array();

$ezOptions['text_leadin'] = array('name' => __('Lead-in AdSense Text', 'easy-adsenser') . "<br><small>" . __('(Appears near the beginning of the post)', 'easy-adsenser') . "</small>",
    'help' => __("This ad block will appear near the top of your posts and pages. Generate your AdSense code from your Google AdSense page and paste it here.", 'easy-adsenser'),
    'type' => 'textarea',
    'value' => EzGA::$options['defaultText']);
$ezOptions['margin_leadin'] = array('name' => __('Margin', 'easy-adsenser'),
    'help' => __('Use the margin setting to trim margins. Decreasing the margin moves the ad block left and up. Margin can be negative.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'validator' => 'number',
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'value' => "12");
$ezOptions['wc_leadin'] = array('name' => __('Min. Word Count', 'easy-adsenser'),
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:70px\">'",
    'validator' => 'number',
    'value' => 0,
    'help' => __('Suppress this ad block if the post is not at least this many words long. Enter 0 or a small number if you do not want to suppress ads based on the number of words in the page/post.', 'easy-adsenser'));
$ezOptions['header_leadin'] = array('name' => __('Postion', 'easy-adsenser'),
    'help' => __('Select where you would like to show the lead-in ad block. A placement above or below the blog header would be suitable for a wide AdSense block.', 'easy-adsenser') . "<br />" . __('Note that <b>Below Header</b> and <b>End of Page</b> options are hacks that may not be compatible with the WordPress default widget for <b>Recent Posts</b> or anything else that may use DB queries or loops. If you have problems with your sidebars and/or font sizes, please choose some other <b>Postion</b> option.', 'easy-adsenser'),
    'type' => 'select',
    'options' => array('send_headers' => __('Above Page Header', 'easy-adsenser'), 'loop_start' => __('Above Post Title', 'easy-adsenser'), 'the_content' => __('Below Post Title', 'easy-adsenser'), '' => __('Beginning of Post', 'easy-adsenser')),
    'value' => '');

$ezOptions['text_midtext'] = array('name' => __('Mid-Post AdSense Text', 'easy-adsenser') . "<br><small>" . __('(Appears near the middle of the post)', 'easy-adsenser') . "</small>",
    'help' => __("This ad block will appear near the middle of your posts and pages. Generate your AdSense code from your Google AdSense page and paste it here.", 'easy-adsenser'),
    'type' => 'textarea',
    'value' => EzGA::$options['defaultText']);
$ezOptions['margin_midtext'] = array('name' => __('Margin', 'easy-adsenser'),
    'help' => __('Use the margin setting to trim margins. Decreasing the margin moves the ad block left and up. Margin can be negative.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'validator' => 'number',
    'value' => "12");
$ezOptions['wc_midtext'] = array('name' => __('Min. Word Count', 'easy-adsenser'),
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:70px\">'",
    'validator' => 'number',
    'value' => 0,
    'help' => __('Suppress this ad block if the post is not at least this many words long. Enter 0 or a small number if you do not want to suppress ads based on the number of words in the page/post.', 'easy-adsenser'));
$ezOptions['force_midad'] = array('name' => __('Force Mid-post Ad?', 'easy-adsenser'),
    'help' => __('Force mid-text ad (if enabled) even in short posts?', 'easy-adsenser'),
    'type' => 'checkbox',
    'value' => 0);

$ezOptions['text_leadout'] = array('name' => __('Lead-in AdSense Text', 'easy-adsenser') . "<br><small>" . __('(Appears near the end of the post)', 'easy-adsenser') . "</small>",
    'help' => __("This ad block will appear near the top of your posts and pages. Generate your AdSense code from your Google AdSense page and paste it here.", 'easy-adsenser'),
    'type' => 'textarea',
    'value' => EzGA::$options['defaultText']);
$ezOptions['margin_leadout'] = array('name' => __('Margin', 'easy-adsenser'),
    'help' => __('Use the margin setting to trim margins. Decreasing the margin moves the ad block left and up. Margin can be negative.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'validator' => 'number',
    'value' => "12");
$ezOptions['wc_leadout'] = array('name' => __('Min. Word Count', 'easy-adsenser'),
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:70px\">'",
    'validator' => 'number',
    'value' => 0,
    'help' => __('Suppress this ad block if the post is not at least this many words long. Enter 0 or a small number if you do not want to suppress ads based on the number of words in the page/post.', 'easy-adsenser'));
$ezOptions['footer_leadout'] = array('name' => __('Postion', 'easy-adsenser'),
    'help' => __('Select where you would like to show the lead-out ad block. A placement above or below the blog footer would be suitable for a wide AdSense block.', 'easy-adsenser') . __('<br />Note that <b>Below Header</b> and <b>End of Page</b> options are hacks that may not be compatible with the WordPress default widget for <b>Recent Posts</b> or anything else that may use DB queries or loops. If you have problems with your sidebars and/or font sizes, please choose some other <b>Position</b> option.', 'easy-adsenser'),
    'type' => 'select',
    'options' => array('' => __('End of Post', 'easy-adsenser'), 'loop_end' => __('End of Page', 'easy-adsenser'), 'get_footer' => __('Above Footer', 'easy-adsenser'), 'wp_footer' => __('Below Footer', 'easy-adsenser')),
    'value' => '');

$ezOptions['max_count'] = array('name' => __('Number of Ad Blocks per Page', 'easy-adsenser'),
    'help' => __('Google policy allows no more than three ad blocks and three link units per web page. Select the number of ad blocks you would like to show on each page (including the side bar widget, if enabled). Although you have the option of showing any number of ad blocks, it is not recommended. Besides, Google may not serve you more than three blocks per page any way.  Use the No Limit option at your own risk!', 'easy-adsenser'),
    'type' => 'radio2',
    'value' => 3,
    'options' => array(3 => __('Three', 'easy-adsenser'),
        2 => __('Two', 'easy-adsenser'),
        1 => __('One', 'easy-adsenser'),
        0 => __('None', 'easy-adsenser'),
        99 => __('No Limit', 'easy-adsenser'))
);

$ezOptions['show_borders'] = array('help' => __('Google Policy says that you may not direct user attention to the ads via arrows or other graphical gimmicks. Please convince yourself that showing a mouseover decoration does not violate the Google policy before enabling this option.', 'easy-adsenser'),
    'name' => __('Border for Ads?', 'easy-adsenser'),
    'value' => true,
    'type' => 'checkbox');

$ezOptions['border_widget'] = array('help' => __('Show the same border on the sidebar widget as well?', 'easy-adsenser'),
    'name' => __('Widget?', 'easy-adsenser'),
    'value' => true,
    'type' => 'checkbox');

$ezOptions['border_lu'] = array('help' => __('Show the same border on the link units too?', 'easy-adsenser'),
    'name' => __('Link Units?', 'easy-adsenser'),
    'value' => true,
    'type' => 'checkbox');

$ezOptions['border_width'] = array('name' => __('Border Width', 'easy-adsenser'),
    'help' => __('Specify the border width.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'validator' => 'number',
    'value' => 1,
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'value' => "1");

$ezOptions['border_normal'] = array('name' => __("Color: Normal", 'easy-adsenser'),
    'help' => __("Specify the normal border color. The mouse-over color is specified in the next color picker.", 'easy-adsenser'),
    'value' => "FF0000",
    'type' => 'colorpicker2');

$ezOptions['border_color'] = array('name' => __("Color: Hover", 'easy-adsenser'),
    'help' => __("Specify the border color when the user hovers his mouse over the ad.", 'easy-adsenser'),
    'value' => "0000FF",
    'type' => 'colorpicker2');

$ezOptions['force_widget'] = array(
    'help' => __('Always show the widget, if enabled. If the sidebar widget is enabled, it will be displayed in preference to the ad blocks in the text. If this option is not checked, it may happen that the number of ad blocks you selected above may get used up by the ones in the post body.', 'easy-adsenser'),
    'name' => __('Prioritize sidebar widget?', 'easy-adsenser'),
    'value' => true,
    'type' => 'checkbox2');

$ezOptions['kill_inline'] = array('help' => __('Control ad-blocks using <code>style.css</code>. All <code>&lt;div&gt;</code>s that <em>Easy AdSense</em> creates have the class attribute <code>adsense</code>. Furthermore, they have class attributes like <code>adsense-leadin</code>, <code>adsense-midtext</code>, <code>adsense-leadout</code>, <code>adsense-widget</code> and <code>adsense-lu</code> depending on the type. You can set the style for these classes in your theme <code>style.css</code> to control their appearance.<br />If this is all Greek to you, please leave the option disabled.', 'easy-adsenser'),
    'value' => false,
    'name' => __('Suppress in-line styles?', 'easy-adsenser'),
    'type' => 'checkbox2');

$ezOptions['kill_linebreaks'] = array('help' => __('If you find that you have extra vertical spaces or if your ad code is messed up with <code><</code><code>p></code> or <code><</code><code>br /></code> tags, try checking this option.<br />Under normal cirumstances, this option should be left unchecked.', 'easy-adsenser'),
    'name' => __('Prevent spurious line breaks?', 'easy-adsenser'),
    'value' => false,
    'type' => 'checkbox2');

$ezOptions['suppressBoxes'] = array('help' => __('Easy Plugin for AdSense displays a box with red borders to indicate where an ad would have been placed, but has been suppressed by one of the filters above. If you would like to suppress the boxes, check this option. The box will be shown only if logged in as an admin user.', 'easy-adsenser'),
    'name' => __('Suppress Placement Boxes?', 'easy-adsenser'),
    'value' => false,
    'type' => 'checkbox2');

$ezOptions['max_link'] = array('name' => __('Link-backs to Unreal Blog', 'easy-adsenser') . "<br><small>" . __('(Consider showing at least one link.)', 'easy-adsenser') . "</small>",
    'help' => __('If you would like to show a discreet link to the developer site, customize it here.', 'easy-adsenser'),
    'type' => 'radio2',
    'value' => 0,
    'options' => array(99 => __('Under each ad block', 'easy-adsenser'),
        1 => __('Under the first ad block', 'easy-adsenser'),
        -1 => __('At the bottom of the page', 'easy-adsenser'),
        0 => __('Suppress links', 'easy-adsenser'))
);

$ezOptions['text_widget'] = array('name' => __('AdSense Widget Text', 'easy-adsenser') . "<br><small>" . __('(Appears in the Sidebar as a Widget)', 'easy-adsenser') . "</small>",
    'help' => __("This ad block will appear in your sidebar as a . Generate your AdSense code from your Google AdSense page and paste it here.", 'easy-adsenser'),
    'type' => 'textarea',
    'value' => EzGA::$options['defaultText']);
$ezOptions['margin_widget'] = array('name' => __('Margin', 'easy-adsenser'),
    'help' => __('Use the margin setting to trim margins. Decreasing the margin moves the ad block left and up. Margin can be negative.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'validator' => 'number',
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'value' => "12");
$ezOptions['title_widget'] = array('name' => __('Widget Title', 'easy-adsenser'),
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:230px\">'",
    'value' => 'Sponsored Links',
    'help' => __('Give a title to your widget -- something like Sponsored Links or Advertisements would be good. You can also suppress the title by checking the box to the right.', 'easy-adsenser'));
$ezOptions['kill_widget_title'] = array('name' => __('Hide Title?', 'easy-adsenser'),
    'help' => __('Check this box to suppress the title for this widget.', 'easy-adsenser'),
    'type' => 'checkbox',
    'value' => 0);
$ezOptions['show_widget'] = array('name' => __('Ad Alignment', 'easy-adsenser') . " <small>" . __('(Where to show?)', 'easy-adsenser') . "</small>",
    'help' => __("Decide where (or whether) to show this widget and how to align it.", 'easy-adsenser'),
    'value' => 'no',
    'type' => 'radio2',
    'options' => array('text-align:left' => __('Align Left', 'easy-adsenser'),
        'text-align:center' => __('Center', 'easy-adsenser'),
        'text-align:right' => __('Align Right', 'easy-adsenser'),
        'no' => __('Suppress', 'easy-adsenser')));

$ezOptions['text_lu'] = array('name' => __('AdSense Link-Units Text', 'easy-adsenser') . "<br><small>" . __('(Appears in the Sidebar as a Widget)', 'easy-adsenser') . "</small>",
    'help' => __("This ad block will appear in your sidebar as a widget. Generate your AdSense code from your Google AdSense page and paste it here.", 'easy-adsenser'),
    'type' => 'textarea',
    'value' => EzGA::$options['defaultText']);
$ezOptions['margin_lu'] = array('name' => __('Margin', 'easy-adsenser'),
    'help' => __('Use the margin setting to trim margins. Decreasing the margin moves the ad block left and up. Margin can be negative.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'validator' => 'number',
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'value' => "12");
$ezOptions['title_lu'] = array('name' => __('Widget Title', 'easy-adsenser'),
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:230px\">'",
    'value' => 'Link Units',
    'help' => __('Give a title to your widget -- something like Sponsored Links or Advertisements would be good. You can also suppress the title by checking the box to the right.', 'easy-adsenser'));
$ezOptions['kill_lu_title'] = array('name' => __('Hide Title?', 'easy-adsenser'),
    'help' => __('Check this box to suppress the title for this widget.', 'easy-adsenser'),
    'type' => 'checkbox',
    'value' => 0);
$ezOptions['show_lu'] = array('name' => __('Ad Alignment', 'easy-adsenser') . " <small>" . __('(Where to show?)', 'easy-adsenser') . "</small>",
    'help' => __("Decide where (or whether) to show this widget and how to align it.", 'easy-adsenser'),
    'value' => 'no',
    'type' => 'radio2',
    'options' => array('text-align:left' => __('Align Left', 'easy-adsenser'),
        'text-align:center' => __('Center', 'easy-adsenser'),
        'text-align:right' => __('Align Right', 'easy-adsenser'),
        'no' => __('Suppress', 'easy-adsenser')));

$ezOptions['text_gsearch'] = array('name' => __('Google Search Widget', 'easy-adsenser') . "<br><small>" . __('(Adds a Google Search Box to your sidebar)', 'easy-adsenser') . "</small>",
    'help' => __("This widget will appear as a Google search box in your sidebar. Generate your AdSense code from your Google AdSense page and paste it here.", 'easy-adsenser'),
    'type' => 'textarea',
    'value' => EzGA::$options['defaultText']);
$ezOptions['margin_gsearch'] = array('name' => __('Margin', 'easy-adsenser'),
    'help' => __('Use the margin setting to trim margins. Decreasing the margin moves the ad block left and up. Margin can be negative.', 'easy-adsenser'),
    'dataMode' => 'popup',
    'validator' => 'number',
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:60px\">'",
    'value' => "12");
$ezOptions['title_gsearch'] = array('name' => __('Search Title', 'easy-adsenser') . " <small>" . __('(Title of the Google Search Widget)', 'easy-adsenser') . "</small>",
    'help' => __("Choose a title for your Google Search Widget. Depending on your theme background, you can choose a dark or light image, or a custom text title. You can also suppress the widget altogether.", 'easy-adsenser'),
    'value' => 'no',
    'type' => 'radio2',
    'options' => array('dark' => "<img src='img/google-dark.gif' alt='Google (dark)' style='background:black;vertical-align:-50%;' />",
        'light' => "<img src='img/google-light.gif' alt='Google (light)' style='background:white;vertical-align:-50%;' />",
        'no' => __('Suppress Search Box', 'easy-adsenser'),
        'customized' => __('Custom Title', 'easy-adsenser')));
$ezOptions['title_gsearch_custom'] = array('name' => __('Custom Title', 'easy-adsenser'),
    'dataTpl' => "data-tpl='<input type=\"text\" style=\"width:200px\">'",
    'value' => "Google Search",
    'help' => __('Choose a title for your Google Search Widget. Depending on your theme background, you can choose a dark or light image, or a custom text title. You can also suppress the widget altogether.', 'easy-adsenser'));
$ezOptions['kill_gsearch_title'] = array('name' => __('Hide Title?', 'easy-adsenser'),
    'help' => __('Check this box to suppress the title for this widget.', 'easy-adsenser'),
    'type' => 'checkbox',
    'value' => 0);

require 'box-ad-alignment-options.php';
require 'box-suppressing-ads-options.php';
require 'pro-options.php';
