lando init \
 --source remote \
 --remote-url https://wordpress.org/latest.tar.gz \
 --recipe wordpress \
 --webroot wordpress \
 --name wp-test

lando restart
lando start
lando stop

lando db-export wp.sql
lando db-import wp.sql
