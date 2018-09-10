#!/bin/bash


# make sure user is root
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

# determine the OS platform
platform=$(awk -F= '/^NAME/{print $2}' /etc/os-release | tr -d \")

# skip installing ansible if already installed
if ! command -v ansible > /dev/null 2>&1; then

	if [[ ${platform} == "Ubuntu" ]]; then

		apt-get update
		apt-get install software-properties-common -y
		add-apt-repository ppa:ansible/ansible -y
		apt-get update
		apt-get install ansible openssh-server -y
		usermod -G sudo ${ssh_username}
		php_host="127.0.0.1"

	elif [[ ${platform} == "Debian GNU/Linux" ]]; then

		apt-get update
		apt-get install ansible sudo openssh-server sshpass -y
		echo "Defaults lecture=\"never\"" >> /etc/sudoers
		dpkg -i ansible_2.6.4-1ppa~bionic_all.deb
		usermod -G sudo ${ssh_username}
		php_host="127.0.0.1"

	elif [[ ${platform} == "CentOS Linux" ]]; then

		yum install ansible openssh-server -y
		usermod -G wheel ${ssh_username}

	else

		echo "You are runing an unsuported OS."
		exit 2

	fi

else
	echo "Ansible is installed. Skipping ansible Installation."

fi

php_password=$(openssl rand -base64 30)

cd ansible

ansible-playbook app.yml -e "ansible_user=${ssh_username} ansible_ssh_pass=${ssh_password} ansible_sudo_pass=${ssh_password} php_password=${php_password} initial_user=${username} initial_password=${password} ansible_base=$(pwd) php_host=${php_host}"
