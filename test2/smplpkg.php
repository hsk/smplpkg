<?php

class test2_smplpkg extends smplpkg {
  public $depends = array("test1");
  public $repo = "git@github.com:hsk/smplpkg_test2.git";
}
