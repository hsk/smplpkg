<?php

class smplpkg {
  function install($name) {
    if(isset($this->zip)) {
      if(file_exists($name)) return true;
      $zip = explode("/", $this->zip);
      $zip = "smplpkg/".array_pop($zip);
      if(!file_exists($zip)) {
        system("wget -O $zip ".$this->zip);
      }
      system("unzip $zip");
      exec("zipinfo -1 $zip", $e);
      $e = $e[0];
      system("mv $e $name");
      return true;
    }
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
      foreach($pkg->depends as $depend) {
        $this->install($depend);
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
      $name = preg_replace("/^smplpkg\/(.*).php\$/","\$1", $path);
      if(preg_match("/^smplpkg\$/",$name)>0) continue;
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