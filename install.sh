#!/bin/bash

if [[ $EUID -ne 0 ]]; then
	echo "This script must be run as root." 
	exit 1
fi


platform=$(awk -F= '/^NAME/{print $2}' /etc/os-release | tr -d \")

if ! command -v ansible > /dev/null 2>&1; then

	if [[ ${platform} == "Ubuntu" ]]; then

		apt-get update
		apt-get install software-properties-common -y
		add-apt-repository ppa:ansible/ansible -y
		apt-get update
		apt-get install ansible -y

	elif [[ ${platform} == "Debian GNU/Linux" ]]; then

		echo "deb http://ppa.launchpad.net/ansible/ansible/ubuntu trusty main" >> /etc/apt/sources.list
		apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 93C4A3FD7BB9C367
		apt-get update
		apt-get install ansible -y

	elif [[ ${platform} == "CentOS Linux" ]]; then

		yum install ansible -y

	else

		echo "You are runing an unsuported OS."
		exit 2

	fi
else
	echo "Ansible is installed. Skipping ansible Installation."

fi

ansible-playbook -k app.yml -e ansible_user=andrew
