#!/bin/bash
echo "<VirtualHost *:80>"
echo "   DocumentRoot /home/wwwhtml/$1"
echo "   ServerName www.$2"
echo "   ServerAlias $2"
echo "</VirtualHost>"

