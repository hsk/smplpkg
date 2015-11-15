<?php

class test1_smplpkg extends smplpkg {
    public $depends = array();
    function install($argv) {
      system("git clone git@github.com:hsk/smplpkg_test1.git test1");
      system("cd test1; git pull git@github.com:hsk/smplpkg_test1.git");
      echo "install test1\n";
    }
}
