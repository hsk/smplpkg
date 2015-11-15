# smplpkg ver0.0.3

これは、とても簡単なパッケージシステムです。
PHPのみでパッケージを管理します。

    mkdir test
    cd test
    git clone git@github.com:hsk/smplpkg
    php smplpkg/smplpkg.php init
    make

で、パッケージを導入して実行出来ます。

以下だとより高速です。

    wget https://github.com/hsk/smplpkg/releases/download/smplpkg-0.0.3/smplpkg.zip; unzip smplpkg.zip; php smplpkg/smplpkg.php init
