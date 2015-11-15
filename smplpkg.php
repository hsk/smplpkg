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
    return true;
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
    return true;
  }

  function clean() {
    system("rm -rf caches/*");
    return true;
  }

  function list_() {
    foreach(glob("smplpkg/*", GLOB_ONLYDIR) as $dir) {
      $dir = preg_replace("/^smplpkg\\//","", $dir);
      if(preg_match("/^(template)\$/",$dir)>0) continue;

      include_once "$dir/smplpkg.php";
      echo "# $dir\n\n";
      $pkgname = $dir."_smplpkg";
      $pkg = new $pkgname();
      echo $pkg->comment."\n\n";
    }
    return true;
  }

  function usage() {
    echo "usage\n";
    echo "  install name : install package\n";
    echo "  list         : show package list\n";
    echo "  clean        : remove caches\n";
    return true;
  }
}

$manager = new smplpkg_manager();
array_shift($argv);
$cmd = array_shift($argv);
$cmd = preg_replace("/^list\$/", "list_", $cmd);
$cmd = preg_replace("/^_.*\$/", "usage", $cmd);
if(!@call_user_func_array(array($manager, $cmd), $argv)){
  call_user_func_array(array($manager, "usage"), $argv);
}