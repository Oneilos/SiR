Sir: init-dev
	echo "Project Sir ready to use !"

init:
	test -d bin/ || mkdir bin/
	test -f bin/composer || curl -sS https://getcomposer.org/installer | php -- --install-dir=bin --filename=composer
	./bin/composer self-update
	test -f bin/php-cs-fixer || wget http://get.sensiolabs.org/php-cs-fixer.phar -O bin/php-cs-fixer
	php bin/php-cs-fixer self-update
	test -f bin/insight || wget http://get.insight.sensiolabs.com/insight.phar -O bin/insight
	php bin/insight self-update
	php bin/insight projects -n --user-uuid=88ce8329-0632-4b1d-a1de-f9793f84cd28 --api-token=3dd4d1f4c84bf5933bb331f13780b60cbd12bac6b1422d1caacfe0fd8326c2a7

all: install clean build
	echo "Project Sir is built !"

install: install-sir install-dextr install-huntr install-linkr clean

clean: clean-sir clean-dextr clean-huntr clean-linkr

build: clean build-sir build-dextr build-huntr build-linkr

fixer:
	php bin/php-cs-fixer fix src --level=symfony || echo "" > /dev/null
	php bin/php-cs-fixer fix skeletons --level=symfony || echo "" > /dev/null

#
# Tests, travis
#
install-test:
	./bin/composer install --prefer-dist --no-scripts
	cp app/config/parameters.yml.dist app/config/parameters.yml
	./bin/composer dump-autoload
	./bin/composer run-script setup-bootstrap -vv

test: install-test install-dextr install-huntr install-linkr build

run-test:
	phpunit -c app

#
# Sir install
#
sir: install-sir clean-sir build-sir

install-sir:
	./bin/composer install
	php app/console assets:install --symlink

clean-sir:
	rm -rf app/cache/*
	rm -rf app/logs/*
	test -d /dev/shm/sir && rm -rf /dev/shm/sir || echo "" > /dev/null
	rm -rf vendor/composer/autoload*
	rm app/bootstrap.php.cache
	./bin/composer dump-autoload
	./bin/composer run-script setup-bootstrap -vv
	php app/console cache:warmup
	php app/console cache:warmup --env=prod

build-sir:
	php app/console doctrine:migrations:diff
	php app/console doctrine:database:drop --force || echo "" > /dev/null
	php app/console doctrine:database:create
	php app/console doctrine:migrations:migrate -n
	php app/console doctrine:fixtures:load -n -q || echo "" > /dev/null

#
# DextR
#
dextr: install-dextr build-dextr

install-dextr:
	gulp install-dextr

clean-dextr:
	gulp clean-dextr

build-dextr:
	gulp build-dextr

#
# HuntR
#
huntr: install-huntr build-huntr

install-huntr:
	gulp install-huntr

clean-huntr:
	gulp clean-huntr

build-huntr:
	gulp build-huntr

#
# LinkR
#
linkr: install-linkr build-huntr

install-linkr:
	gulp install-linkr

clean-linkr:
	gulp clean-linkr

build-linkr:
	gulp build-linkr
