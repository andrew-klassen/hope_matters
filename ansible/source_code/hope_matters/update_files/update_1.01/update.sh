#!/bin/bash

echo Enter the root password you used to configure mysql:
read -s password

mysql --user=root --password=$password < /var/www/html/update_files/update_1.01/database_change_1.01.sql
chmod 777 -R /var/www/html/uploaded_images
echo "*** Update Successful ***"