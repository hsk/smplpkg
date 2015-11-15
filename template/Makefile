run: test2
	php test.php
install: smplpkg
	cd smplpkg; git pull
	php smplpkg/smplpkg.php install test2
smplpkg:
	wget https://github.com/hsk/smplpkg/releases/download/smplpkg-0.0.3/smplpkg.zip
	unzip smplpkg.zip

list:
	php smplpkg/smplpkg.php list
usage:
	php smplpkg/smplpkg.php usage
test2:
	make install
cleanall:
	rm -rf test1 test2 smplpkg smplpkg*.zip*
clean:
	rm -rf test1 test2

zip:
	make cleanall
	git clone git@github.com:hsk/smplpkg.git
	find smplpkg | xargs zip smplpkg.zip
