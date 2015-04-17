<?php

$kintSearchDepth = 3;
$kintLocation = '../kint';
for ($i = 0; $i < $kintSearchDepth; ++$i) {
  if (file_exists("$kintLocation/Kint.class.php")) {
    $kintFile = "$kintLocation/Kint.class.php";
    break;
  }
  else {
    $kintLocation = "../$kintLocation";
  }
}
if (!empty($kintFile)) {
  include $kintFile;
}
else if (!empty($killKint)) {

  function d() {
    echo "<pre>Kint Function <b>d()</b> called:\n";
    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    echo "</pre>";
  }

  function dd() {
    echo "<pre>Kint Function <b>dd()</b> called:\n";
    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    die("Quitting because of <b>dd()</b></pre>");
  }

}
else {

  function d() {

  }

  function dd() {

  }

}