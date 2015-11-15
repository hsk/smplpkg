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

  function init() {
    system("cp smplpkg/template/Makefile .");
    system("cp smplpkg/template/test.php .");
    return true;
  }

  function install($name) {
      echo "start install ".$name."\n";
      include_once "$name.php";
      $pkg = new $name();
      foreach($pkg->depends as $name) {
        $this->install($name);
      }
      $pkg->install($name);
    return true;
  }

  function clean() {
    system("rm -rf caches/*");
    return true;
  }

  function list_() {
    foreach(glob("smplpkg/*.php") as $path) {
      if(preg_match("/^(smplpkg.php)\$/",$path)>0) continue;
      $name = preg_replace("/^smplpkg/(.*).php\$/","\$1", $path);
      include_once "$name.php";
      echo "# $name\n\n";
      $pkg = new $name();
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