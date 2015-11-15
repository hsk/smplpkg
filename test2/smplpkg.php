<?php

class test2_smplpkg extends smplpkg {
    public $depends = array("test1");
    function install($argv) {
      system("git clone git@github.com:hsk/smplpkg_test2.git test2");
      system("cd test2; git pull git@github.com:hsk/smplpkg_test2.git");
      echo "installed test\n";
    }
}
