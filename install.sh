#!/bin/bash

if [[ $EUID -ne 0 ]]; then
	echo "This script must be run as root." 
	exit 1
fi

read -p "Ssh username (needs sudo powers): " ssh_username
read -s -p "Ssh password: " ssh_password
echo ''
read -p "Initial username: " username
read -s -p "Initial password: " password

echo ''

platform=$(awk -F= '/^NAME/{print $2}' /etc/os-release | tr -d \")

if ! command -v ansible > /dev/null 2>&1; then

	if [[ ${platform} == "Ubuntu" ]]; then

		apt-get update
		apt-get install software-properties-common -y
		add-apt-repository ppa:ansible/ansible -y
		apt-get update
		apt-get install ansible openssh-server -y

	elif [[ ${platform} == "Debian GNU/Linux" ]]; then

		echo "deb http://ppa.launchpad.net/ansible/ansible/ubuntu trusty main" >> /etc/apt/sources.list
		apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 93C4A3FD7BB9C367
		apt-get update
		apt-get install ansible sudo openssh-server -y
		echo "Defaults lecture=\"never\"" >> /etc/sudoers

	elif [[ ${platform} == "CentOS Linux" ]]; then

		yum install ansible openssh-server -y

	else

		echo "You are runing an unsuported OS."
		exit 2

	fi


usermod -G sudo ${ssh_username}

else
	echo "Ansible is installed. Skipping ansible Installation."

fi

php_password=$(openssl rand -base64 30)


cd ansible


ansible-playbook app.yml -e "ansible_user=${ssh_username} ansible_ssh_pass=${ssh_password} ansible_sudo_pass=${ssh_password} php_password=${php_password} initial_user=${username} initial_password=${password}"
