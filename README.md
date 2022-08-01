lando init \
 --source remote \
 --remote-url https://wordpress.org/latest.tar.gz \
 --recipe wordpress \
 --webroot wordpress \
 --name wp-test

SSL
sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain .lando/certs/wp-test.lndo.site.pem
sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain .lando/certs/wp-test.lndo.site-key.pem

#information del proyecto
lando info

lando restart
lando start
lando stop
lando poweroff

lando db-export wp.sql
lando db-import wp.sql
