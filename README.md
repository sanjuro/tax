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

## Task

Develop a software that can be used to calculate statistics about the tax income of a country. The country is organized in 5 states and theses states are devided into counties.

Each county has a different tax rate and collects a different amount of taxes.

The software should have the following features:

- Output the overall amount of taxes collected per state
- Output the average amount of taxes collected per state
- Output the average county tax rate per state
- Output the average tax rate of the country 
- Output the collected overall taxes of the country


## Assumptions

I have assumptions while creating this application:

1. There is a parent - child hierachry for Country - State - County
2. I have not assumed a currency on monetar values
3. As there is no input mechanism for Tax Data all data is run in via Doctrine Fixtures


## Notes

All tax related calculations are run via a function, updateTax in the class App\Service\TaxDataService, it flows as follows:

For every country, we get all states.
For all states, it gets all counties.
Next for each county the system calculates the Total Tax collected, Average Tax rate and Average Tax Collected.
This data is then persisted on a county level
All tax data for counties is then propogated for their parent state.
This data is then persisted on a state level
All tax data for counties is then propogated for their country state.
This data is then persisted on a country level

This function should be run via a cron but for the scope of this project I have set it to run on calls of the listAction on App\Controller\ApiCountryController and App\Controller\ApiStateController.

The task did not request a feature where a user could capture and edit tax data on a county leavel, all tax daat is loaded in via fixtures

I have not added Unit Tests to the project due to time constraints

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