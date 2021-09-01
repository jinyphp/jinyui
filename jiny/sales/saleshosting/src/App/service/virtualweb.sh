#vi /usr/local/apache/conf/httpd.conf
echo "<VirtualHost $hostip_address>" >> /tmp/httpd.conf_tempfile
echo "    ServerAdmin $1@$2"    >> /tmp/httpd.conf_tempfile
echo "    DocumentRoot /home/$1/www"    >> /tmp/httpd.conf_tempfile
echo "    ServerName www.$2"    >> /tmp/httpd.conf_tempfile
echo "    ErrorLog /home/$1/www_log/error_log"  >> /tmp/httpd.conf_tempfile
echo "    CustomLog /home/$1/www_log/access_log common" >> /tmp/httpd.conf_tempfile
echo "</VirtualHost>"   >> /tmp/httpd.conf_tempfile

#cat /tmp/httpd.conf_tempfile >> /usr/local/apache/conf/httpd.conf