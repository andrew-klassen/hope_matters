#!/bin/bash

# notify user
echo "This update script assumes that you have version 1.03 of the program installed."
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
	
	# set permissions
	chmod 2777 -R /var/www/html/
	echo "*** Update Successful ***"
	
# if user response is no, then exit
else
	exit
fi
