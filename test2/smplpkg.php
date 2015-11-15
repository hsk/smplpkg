<?php

class test2_smplpkg extends smplpkg {
  public $comment = "this is test2 class library";
  public $depends = array("test1");
  public $repo = "git@github.com:hsk/smplpkg_test2.git";
}
