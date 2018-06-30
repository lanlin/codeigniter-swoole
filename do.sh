#!/bin/bash

echo ===================================================
echo Start Testing...
echo ===================================================

phpdbg -qrr ./vendor/bin/phpunit $1 $2 $3 $4 $5