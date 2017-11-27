#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Updating dependencies with Composer"
cd /app/yii
composer update

info "Apply migrations"
php yii migrate --interactive=0