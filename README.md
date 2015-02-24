SiR
===

Projet de système d'information complet, centré autour des métiers du consulting.


# Install

```
git clone git@github.com:LinkValue/SiR.git
cd SiR/
wget http://getcomposer.org/composer.phar
php composer.phar install --dev

# database and fixtures build
php app/console propel:database:create --connection=default
php app/console propel:build --insert-sql
php app/console propel:fixtures:load
php app/console cache:warmup

# assets compilation
php app/console assetic:dump --force
```

Dossiers à vérifier :
```
# avec droits d'écriture pour le user applicatif
data/
web/images/avatars/
```
