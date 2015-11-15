<?php

class test2_smplpkg extends smplpkg {
    public $depends = array("test1");
    function install($argv) {
      system("git clone http://github.com/hsk/smplpkg_test2 test2");
      system("cd test2; git pull http://github.com/hsk/smplpkg_test2");
      echo "install test\n";
    }
}
