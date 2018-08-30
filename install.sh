#!/bin/bash

# notify user
echo "This installer was designed for a minimal Debian 8 installation."
read -p "Do you wish to continue (y/n)?: " response

# if response is yes
if [ "$response" = "y" ]; then
	
	echo "**********************************************************"

	# install the mysql apt repository, the mysql in the debian repositorys
	# does not support all the features needed for the program
	wget https://repo.mysql.com//mysql-apt-config_0.8.6-1_all.deb
	dpkg -i mysql-apt-config_0.8.6-1_all.deb
	rm -f mysql-apt-config_0.8.6-1_all.deb

	# update the package lists and install the LAMP stack
	apt-get update
	apt-get install apache2 mysql-community-server php5 php5-mysql -y

	# root password is needed to modify the database
	echo Enter the root password you used to configure mysql:
	read -s password

	# import the database structure
	mysql --user=root --password=$password < source_code/database_schema.sql

	# create admin user and grant the user the correct permissions
	mysql --user=root --password=$password -e "CREATE USER 'admin'@'%' IDENTIFIED BY 'P@ssword123';"
	mysql --user=root --password=$password -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;"

	# create php user and grant the user the correct permissions
	mysql --user=root --password=$password -e "CREATE USER 'php'@'127.0.0.1' IDENTIFIED BY 'P@ssword123';"
	mysql --user=root --password=$password -e "GRANT SELECT ON hope_matters.* TO 'php'@'127.0.0.1';"
	mysql --user=root --password=$password -e "GRANT UPDATE ON hope_matters.* TO 'php'@'127.0.0.1';"
	mysql --user=root --password=$password -e "GRANT INSERT ON hope_matters.* TO 'php'@'127.0.0.1';"
	mysql --user=root --password=$password -e "GRANT DELETE ON hope_matters.diagnoses TO 'php'@'127.0.0.1';"
	mysql --user=root --password=$password -e "GRANT DELETE ON hope_matters.diagnoses_temp TO 'php'@'127.0.0.1';"
	mysql --user=root --password=$password -e "GRANT DELETE ON hope_matters.treatment_temp TO 'php'@'127.0.0.1';"
	mysql --user=root --password=$password -e "GRANT DELETE ON hope_matters.return_treatment_temp TO 'php'@'127.0.0.1';"

	# apply the new privileges
	mysql --user=root --password=$password -e "FLUSH PRIVILEGES;"

	# insert the program admin account into the accounts table
	mysql --user=root --password=$password -e "INSERT INTO hope_matters.accounts (username, master_log_access, server_admin, password, created_by) VALUES ('admin', 'yes', 'yes', '$2y$10$Wut8oIRaU32gsOJFDvu84OqPtXshyk2RAcaFkQzprllMf5zln4it6', 'system');"
	
	# move source files to the correct directory and set the permissions
	rm -f /var/www/html/index.html
	cp -r source_code/* /var/www/html/
	chmod 2777 -R /var/www/html
	
	# edit php.ini to allow larger file uploads
	sed -i '660s/.*/post_max_size = 20000M/' /etc/php5/apache2/php.ini
	sed -i '820s/.*/upload_max_filesize = 20000M/' /etc/php5/apache2/php.ini
	
	# restart apache
	systemctl restart apache2

	echo ''
	echo ''
	echo "Default user is \"admin\" and password is \"P@ssword123\". Its recommeded that you change it."

# if user response is no, then exit
else
	exit
fi
