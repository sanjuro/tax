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

### 3. App Setup

1. get into the Docker setup for taxman_app_1
2. run 
```
composer install
yarn install
yarn add --dev vue vue-loader@^14 vue-template-compiler
yarn dev
```




### 2. Startup and Build server

The next step will build all images and start the containers associated 

1. If you have a base DB place the full SQL in docker/Mysql/conf and name the file init.sql
2. Go to your projects root and run the following commands
```
sudo chmod -R 777 docker/mysql-data
docker-compose up --build
```

Docker will start pulling all the images and setting them up

### 3. Configure

1. Install your DB
2. You need to add a hosts entry for your site that points to the virtual box created in Section 1.

First check the IP of your virtual machine

```bash
docker-machine env mefphp70

export DOCKER_TLS_VERIFY="1"
export DOCKER_HOST="tcp://192.168.99.101:2376"
export DOCKER_CERT_PATH="/Users/user/.docker/machine/machines/mefphp70"
export DOCKER_MACHINE_NAME="mefphp70"
```

```
192.168.99.100  taxman.local
```
Goto to docker/Nginx/conf/sites-enabled/default.conf and modify the line

server_name                  projectName.local

Set it to your project name

NOTE:
Your project needs to have this file

include /var/www/html/nginx.conf.local;

3. Goto your browser, you should see a screen that requests you run to composer install.
4. Correct your app/etc/env.php file 

        'host' => 'mef_mysql_1',
        'dbname' => 'magento2',
        'username' => 'root',
        'password' => '123',
        'active' => '1',

run the following comands
```
docker exec -it mef_php_1 bash

cd /var/www/html
composer install
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:clean
```

If you encounter an issue where composer requires a username and password to get into the magento repo use the following:
>	"username": "f5ddfabe6dfeb2cbbf248b2ea218c7af"
>	"password": "12059454ab9ee960644c3767735c3f58"

### Docker Issues running on MacOS
The Docker for Mac application, that is advised to be used when running docker instances on MacOS, is very slow.
see -> https://www.reddit.com/r/docker/comments/59u1b8/why_is_docker_so_slow_on_mac/

A way around this issue is to not use the Docker for Mac tools and instead use the docker-machine toolset and 
a virtualbox VM.


Below is a command set that should bring up a capable Virtual Box vm to run mefphp70:
```bash
# creates the vm with 4gigs of mem
docker-machine create -d virtualbox \
    --virtualbox-memory "4096" \
    --virtualbox-disk-size "30000" \
    mefphp70
```

Create the shared volumes
```bash
docker-machine-nfs projectNameLocal \
    --mount-opts="noacl,async,nolock,vers=3,udp,noatime,actimeo=2" \
    --shared-folder="path_to_code" \
    --nfs-config="-alldirs -maproot=0"
```

Adds the volume access
open /etc/exports and replace -mapall=$uid:$gid with -maproot=0

The entry should look something like this
```
# docker-machine-nfs-begin projectNameLocal #
/Users/shadley/Development/Sourcecode/projectNameLocal 192.168.99.101 -alldirs -maproot=0
# docker-machine-nfs-end projectNameLocal #
```
To get your docker-machine ip run -> docker-machine env stefLocal the output will be 

```bash
export DOCKER_TLS_VERIFY="1"
export DOCKER_HOST="tcp://192.168.99.100:2376"
export DOCKER_CERT_PATH="/Users/shadley/.docker/machine/machines/projectName"
export DOCKER_MACHINE_NAME="projectName"
# Run this command to configure your shell: 
# eval $(docker-machine env stefLocal)
```

```bash
sudo nfsd restart

# set environment for docker-machine
docker-machine restart projectName && docker-machine env && eval $(docker-machine env)
docker-machine env projectName
eval $(docker-machine env projectName)

# -- build is included as we assume its your first run and no images have been built
docker-compose up --build 
```

After this runs successfully, you will only need to make sure your VM is running and run the following from your terminal
```bash
docker-machine restart projectName && docker-machine env && eval $(docker-machine env)
docker-machine env projectName
eval $(docker-machine env projectName)
docker-compose up
```