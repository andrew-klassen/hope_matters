#!/bin/bash

# notify user
echo "This update script assumes that you have version 1.07 of the program installed."
read -p "Do you wish to continue (y/n)?: " response

# if response is yes
if [ "$response" = "y" ]; then
	
	echo Enter the root password you used to configure mysql:
	read -s password
	
	# make hidden directory to work from
	mkdir .temp
	
	# backup database images and settings
	cp -r /var/www/html/uploaded_images .temp/uploaded_images
	cp /var/www/html/php/database_credentials.php .temp/database_credentials.php
	
	# delete all old files, copy the new files
	rm -rf /var/www/html/*
	cp -r source_code/* /var/www/html/
	
	# delete all new uploaded_images directories and the settings file
	rm -rf /var/www/html/uploaded_images
	rm /var/www/html/php/database_credentials.php
	
	# copy old backup database images and settings
	cp -r .temp/uploaded_images /var/www/html/uploaded_images
	cp .temp/database_credentials.php /var/www/html/php/database_credentials.php
	
	# clean up, by removing temporary backup
	rm -rf .temp/

	# import new database changes
	mysql --user=root --password=$password < /var/www/html/update_files/update_1.08/database_change_1.08.sql
	
	# set permissions
	chmod 2777 -R /var/www/html/

	# hash all existing user passwords
	mysql --user="root" --password="$password" -h 127.0.0.1 -N -e "SELECT account_id, password FROM hope_matters.accounts;" | while read account_id user_password; 
	do

		user_password=$(htpasswd -bnBC 10 "" $user_password | tr -d ':\n')
		mysql --user="root" --password="$password" -h 127.0.0.1 -N -e "UPDATE hope_matters.accounts SET password='${user_password}' WHERE account_id='${account_id}';"

	done

	# remove indexes
	sed -i "s/Options Indexes FollowSymLinks/Options FollowSymLinks/g" /etc/apache2/apache2.conf
	systemctl restart apache2

	# add password hashing paramater
	echo '' >> /var/www/html/php/database_credentials.php
	echo "***** update 1.08 *****" >> /var/www/html/php/database_credentials.php
	echo "\$password_hashing_algorithim = PASSWORD_BCRYPT;" >> /var/www/html/php/database_credentials.php
	sed -i 's/^M//g' /var/www/html/php/database_credentials.php

	echo "*** Update Successful ***"
	
# if user response is no, then exit
else
	exit
fi
