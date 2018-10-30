# Taxman (PHP72 + Appdata + Nginx + MySQL) ready docker-compose infrastructure 

## Infrastructure overview
* Container 1: Traefik
* Container 2: App, Apache, Node, PHP
* Container 3: MySQL DB

## Tech Stack
* PHP Version 7.2
* MySQL 5.7
* Apache
* Docker
* Symfony4
* Vue.js

### 1. Setup ( create virtual box )

Before doing anything you will need to install **docker** & **docker-compose** on your host system.


docker-compose https://docs.docker.com/compose/install/
Once docker has been installed and ready to use, you will need to setup a machine for the project you will be working

```bash
docker-machine create -d virtualbox -virtualbox-memory "4096" -virtualbox-disk-size "30000" tax
```

```bash
docker-machine-nfs tax \
    --mount-opts="noacl,async,nolock,vers=3,udp,noatime,actimeo=2" \
    --shared-folder="/Users/user/Development/Sourcecode/tax" \
    --nfs-config="-alldirs -maproot=0"
```

```bash
open /etc/exports and replace -mapall=$uid:$gid with -maproot=0
sudo nfsd restart
```

```bash
docker-machine restart tax && docker-machine env && eval $(docker-machine env)
docker-machine env tax
eval $(docker-machine env tax)
```

### 2. Get the Code and Docker Build

1. git clone this repo -> git@github.com:meticulosity/taxman.git code
2. go into the source folder and run
```
docker-compose up --build
```

This would build all the docker images and create the docker containers needed for the project.
You should see something like this 
```
Creating tax_traefik_1 ... 
Creating tax_traefik_1
Creating tax_db_1 ... 
Creating tax_db_1 ... done
Creating tax_app_1 ... 
Creating tax_app_1 ... done
Attaching to tax_traefik_1, tax_db_1, tax_app_1
db_1       | mysqld: [Warning] World-writable config file '/etc/mysql/conf.d/utf8mb4.cnf' is ignored.
db_1       | 2018-10-30T15:54:34.092181Z 0 [Warning] TIMESTAMP with implicit DEFAULT value is deprecated. Please use --explicit_defaults_for_timestamp server option (see documentation for more details).
db_1       | 2018-10-30T15:54:34.104230Z 0 [Note] mysqld (mysqld 5.7.24) starting as process 1 ...
db_1       | 2018-10-30T15:54:34.113934Z 0 [Note] InnoDB: PUNCH HOLE support available
db_1       | 2018-10-30T15:54:34.118105Z 0 [Note] InnoDB: Mutexes and rw_locks use GCC atomic builtins
db_1       | 2018-10-30T15:54:34.118794Z 0 [Note] InnoDB: Uses event mut
```

### 3. App Setup

1. get into the Docker setup for taxman_app_1
2. run 
```
composer install
yarn install
yarn add --dev vue vue-loader@^14 vue-template-compiler
yarn dev
```