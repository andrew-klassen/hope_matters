#!/bin/bash

# notify user
echo "This update script assumes that you have version 1.02 of the program installed."
read -p "Do you wish to continue (y/n)?: " response

# if response is yes
if [ "$response" = "y" ]; then
	
	echo Enter the root password you used to configure mysql:
	read -s password
	
	# import new database changes
	mysql --user=root --password=$password -e "GRANT DELETE ON hope_matters.return_treatment_temp TO 'php'@'127.0.0.1';"
	
# if user response is no, then exit
else
	exit
fi