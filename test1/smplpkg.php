<?php

class test1_smplpkg extends smplpkg {
    public $depends = array();
    function install($argv) {
      system("git clone http://github.com/hsk/smplpkg_test1 test1");
      system("cd test1; git pull http://github.com/hsk/smplpkg_test1");
      echo "install test1\n";
    }
}
