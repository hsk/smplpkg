install: smplpkg
	php smplpkg/smplpkg.php install test2
smplpkg:
	git clone http://github.com/hsk/smplpkg
clean:
	rm -rf test1 test2 smplpkg
run:
	php test.php
