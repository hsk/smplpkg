<?php

class smplpkg {
  function install($name) {
    $repo = $this->repo;
    if(!file_exists($name))
      system("git clone $repo $name");
    else
      system("cd $name; git pull $repo");
    echo "installed $name\n";
  }
}

class smplpkg_manager {
  public $depends = array();
  function gen() {
    system("cp smplpkg/template/Makefile .");
    system("cp smplpkg/template/test.php .");
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

$manager = new smplpkg_manager();
array_shift($argv);
$cmd = array_shift($argv);

call_user_func_array(array($manager, $cmd), $argv);
