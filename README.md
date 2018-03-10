# Drupal VM Live Site Repository

[![Build Status](https://travis-ci.org/geerlingguy/drupalvm-live.svg?branch=master)](https://travis-ci.org/geerlingguy/drupalvm-live)

This project was built using the [`drupal-project`](https://github.com/drupal-composer/drupal-project) Drupal Composer template, and is used to demonstrate [Drupal VM](https://www.drupalvm.com)'s local and production environment management capabilities.

The motivation behind this project and the process to build the initial version are documented in Jeff Geerling's blog post [Soup to Nuts: Using Drupal VM to build local and prod](https://www.jeffgeerling.com/blog/2017/soup-nuts-using-drupal-vm-build-local-and-prod).

## Prerequisites

You should have the following installed on your local environment prior to working on this project:

  1. Vagrant, VirtualBox and Ansible
  2. PHP and Composer
  3. Vagrant plugins: `vagrant-vbguest`, `vagrant-hostsupdater`

## Local setup - Vagrant-based

If this is the first time you've cloned the project, run the following commands to get started developing:

  1. `composer install`
  2. `vagrant up` (you'll need to enter the Vault password at this point)

Once that's completed, you can visit [http://local.drupalvm.com/](http://local.drupalvm.com/) in your browser to see the site locally.

> Note: You can remove the `secrets.yml` file from the `vm` directory if you want to avoid using the vault password for testing purposes. For the local environment, the variables in that file are overridden in `vagrant.config.yml` anyways.

## Local setup - Docker-based

  1. Edit your hosts file, and add the line: `192.168.88.10  local.drupalvm.com`
  2. (If on Mac) Add an alias for the container's IP address: `sudo ifconfig lo0 alias 192.168.88.10/24`
  3. Run `docker-compose up -d`.
  4. Export the database from prod.drupalvm.com using MySQL.
  5. Import the database into the local environment using MySQL.

Once that's completed, you can visit [http://local.drupalvm.com/](http://local.drupalvm.com/) in your browser to see the site locally.

To run Drush commands on the site, wrap the commands in `docker exec`, like so:

    docker exec local-drupalvm bash -c "drush --uri=local.drupalvm.com --root=/var/www/drupalvm/drupal/web status"

## Prod setup

  1. Create a DigitalOcean Droplet (or basically any other VPS that gives you full control/root). The root user account on this VM should have your SSH key already added.
  2. Copy the `example.vars.yml` file to `vars.yml` inside `vendor/geerlingguy/drupal-vm/examples/prod/bootstrap/` (for one-time use), and customize to your liking.
  3. Run the initialization playbook from the project root directory: `ansible-playbook -i vm/inventory vendor/geerlingguy/drupal-vm/examples/prod/bootstrap/init.yml -e "ansible_ssh_user=root"`
  4. Run the main Drupal VM playbook to build the server: `DRUPALVM_ENV=prod ansible-playbook -i vm/inventory vendor/geerlingguy/drupal-vm/provisioning/playbook.yml -e "config_dir=$(pwd)/vm" --become --ask-become-pass`

Notes:

  - Only the repository's owner has the SSH keys for accessing the actual live `prod.drupalvm.com` site, and the Vault password for the protected variables inside `secrets.yml`.
  - When running the production playbook, you should ensure a `~/.ansible/prod-drupalvm-vault-password.txt` file exists, containing one line with the Vault password used to encrypt the `vm/secrets.yml` file. If the password file is not present, pass `--ask-vault-pass` to the `ansible-playbook` command and enter the password at runtime.

## Keeping things Secret

If you decide to store some private variables in an Ansible Vault-encrypted vars file, then you should run all Vagrant commands like:

    DRUPALVM_ANSIBLE_ARGS='--ask-vault-pass' vagrant [command]

And when running Ansible commands, use:

    ansible-playbook [args] --ask-vault-pass

You can also pass a file path containing the vault password, if you need to do automated deployments. See Ansible's [Vault Documentation](http://docs.ansible.com/ansible/playbooks_vault.html#creating-encrypted-files) for more info.

## Running Behat tests

This codebase includes Behat behavioral tests in the `tests` directory. To run the tests, make sure you have the local environment running, then inside the tests directory, run:

    # If using Drupal VM with Vagrant locally accessed at `local.drupalvm.com`.
    ../vendor/bin/behat --config behat.yml
    
    # If using Drupal VM with Docker locally accessed at `localhost`.
    ../vendor/bin/behat --config behat-docker.yml

## Author

This project is maintained by [Jeff Geerling](https://www.jeffgeerling.com/), author of [Ansible for DevOps](https://www.ansiblefordevops.com) and maintainer of [Drupal VM](https://www.drupalvm.com).
