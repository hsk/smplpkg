<?php

class smplpkg {
  public $depends = array();
  function gen() {
    system("cp Makefile ../Makefile");
    system("cp test.php ../test.php");
  }
  function install($argv) {
      echo "start install ".$argv."\n";
      include_once "$argv/smplpkg.php";
      $pkgname = $argv."_smplpkg";
      $pkg = new $pkgname();
      foreach($pkg->depends as $name) {
        $this->install($name);
      }
      $pkg->install($argv);
  }

  function clean() {
    system("rm -rf caches/*");
  }
}

$manager = new smplpkg();
array_shift($argv);
$cmd = array_shift($argv);

call_user_func_array(array($manager, $cmd), $argv);
