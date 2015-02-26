SiR
===

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f7128553-4d34-4a21-a5b2-6c7de0ec004d/mini.png)](https://insight.sensiolabs.com/projects/f7128553-4d34-4a21-a5b2-6c7de0ec004d) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LinkValue/SiR/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/LinkValue/SiR/?branch=develop) [![Build Status](https://travis-ci.org/LinkValue/SiR.svg?branch=develop)](https://travis-ci.org/LinkValue/SiR) [![Code Coverage](https://scrutinizer-ci.com/g/LinkValue/SiR/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/LinkValue/SiR/?branch=develop)

Distribution centralisée des composants du système SiR, adaptés à la gestion des partners, comptes, missions, factures... de la société [LinkValue][1].

# Install (Vagrant)
```bash
# On local
git clone git@github.com:LinkValue/SiR.git
cd SiR/
make install
vagrant up --provision
vagrant ssh

# On Vagrant Box
cd /var/www/SiR/
make all
```

# Run tests
```bash
# On Vagrant Box
cd /var/www/SiR/
make test
```

[1]: http://link-value.fr/
