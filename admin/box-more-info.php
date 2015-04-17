<?php
$plgName = EzGA::getPlgName();
$plgSlug = EzGA::getSlug();
$plgPrice = EzGA::$plgPrice;
openBox("Upgrades");
if (EzGA::$isPro) {
  ?>
  <div class="col-sm-6 col-xs-12 goPro" data-product="<?php echo $plgSlug; ?>">
    <a data-toggle="tooltip" title="Thank you for using <?php echo $plgName; ?>. It is licensed on a per-installation basis. If you need more licenses, please get them for only $<?php echo $plgPrice[$plgSlug]; ?> each." class="well top-block goPro" href="http://buy.thulasidas.com/<?php echo $plgSlug; ?>">
      <i class="glyphicon glyphicon-shopping-cart red"></i>
      <div><?php echo $plgName; ?></div>
      <div>Get additional licenses at $<?php echo $plgPrice[$plgSlug]; ?>.</div>
      <span class="notification red">Pro</span>
    </a>
  </div>
  <?php
}
else {
  $proName = EzGA::getProName();
  ?>
  <div class="col-sm-6 col-xs-12 goPro" data-product="<?php echo $plgSlug; ?>">
    <a data-toggle="tooltip" title="Get <?php echo $proName; ?> for only $<?php echo $plgPrice[$plgSlug]; ?>. Tons of extra features. Instant download." class="well top-block goPro" href="http://buy.thulasidas.com/<?php echo $plgSlug; ?>">
      <i class="glyphicon glyphicon-shopping-cart red"></i>
      <div>Get <?php echo $proName; ?></div>
      <div>$<?php echo $plgPrice[$plgSlug]; ?>. Instant Download</div>
      <span class="notification red">Pro</span>
    </a>
  </div>
  <?php
}
?>
<div class="col-sm-6 col-xs-12">
  <a data-toggle="tooltip" title="See other premium WordPress plugins and PHP programs by the same author." class="well top-block" href="http://www.thulasidas.com/render" target="_blank">
    <i class="glyphicon glyphicon-star green"></i>
    <div>Other Plugins and Programs</div>
    <div>From the author</div>
  </a>
</div>
<div class="clearfix"></div>
<?php
closeBox();
