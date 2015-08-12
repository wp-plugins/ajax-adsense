<?php
require 'header.php';
?>
<div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li>
      <a href="#">Languages</a>
    </li>
  </ul>
</div>

<?php
openBox("Languages and Internationlization", "globe");
?>
<p>Internationalization is temporarily disabled in this release. It will be available again soon.</p>
<?php
closeBox();
include 'promo.php';
require 'footer.php';
