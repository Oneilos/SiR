SiR
===

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f7128553-4d34-4a21-a5b2-6c7de0ec004d/mini.png)](https://insight.sensiolabs.com/projects/f7128553-4d34-4a21-a5b2-6c7de0ec004d) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LinkValue/SiR/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/LinkValue/SiR/?branch=develop) [![Build Status](https://travis-ci.org/LinkValue/SiR.svg?branch=develop)](https://travis-ci.org/LinkValue/SiR) [![Code Coverage](https://scrutinizer-ci.com/g/LinkValue/SiR/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/LinkValue/SiR/?branch=develop)

Distribution centralisée des composants du système SiR, adaptés à la gestion des partners, comptes, missions, factures... de la société [LinkValue][1].

# Install (Vagrant)
```bash
cd your_workspace
mkdir lv
cd lv
git clone git@github.com:LinkValue/SiR.git
git clone git@github.com:Nyxis/vagrant-nginx-php5.6-mysql.git vagrant
cd vagrant
vagrant up
vagrant ssh
cd /var/www/SiR
make init
make install
```

Attention : Ne pas oublier d'ajouter les hosts ci dessous à la machine locale :
```
192.168.100.50 linkr.sir.dev
192.168.100.50 huntr.sir.dev
192.168.100.50 dextr.sir.dev
192.168.100.50 api.sir.dev
```

# Run tests
```bash
# On Vagrant Box
cd /var/www/SiR/
make test
make run-phpunit
```

[1]: http://link-value.fr/
