run: test2
	php test.php
install: smplpkg
	php smplpkg/smplpkg.php install test2
smplpkg:
	git clone git@github.com:hsk/smplpkg.git
list:
	php smplpkg/smplpkg.php list
usage:
	php smplpkg/smplpkg.php usage
test2:
	make install
cleanall:
	rm -rf test1 test2 smplpkg
clean:
	rm -rf test1 test2
