# Drupal VM Live Site Repository

This project was built using the [`drupal-project`](https://github.com/drupal-composer/drupal-project) Drupal Composer template, and is used to demonstrate [Drupal VM](https://www.drupalvm.com)'s local and production environment management capabilities.

## Prerequisites

You should have the following installed on your local environment prior to working on this project:

  1. Vagrant, VirtualBox and Ansible
  2. PHP and Composer
  3. Vagrant plugins: `vagrant-vbguest`, `vagrant-hostsupdater`

## Local setup

If this is the first time you've cloned the project, run the following commands to get started developing:

  1. `composer install`
  2. `DRUPALVM_ANSIBLE_ARGS='--ask-vault-pass' vagrant up`

Once that's completed, you can visit [http://local.drupalvm.com/](http://local.drupalvm.com/) in your browser to see the site locally.

> Note: You can remove the `secrets.yml` file from the `vm` directory if you want to avoid using the vault password for testing purposes. For the local environment, the variables in that file are overridden in `vagrant.config.yml` anyways.

## Prod setup

  1. Create a DigitalOcean Droplet (or basically any other VPS that gives you full control/root). The root user account on this VM should have your SSH key already added.
  2. Copy the `example.vars.yml` file to `vars.yml` inside `vendor/geerlingguy/drupal-vm/examples/prod/bootstrap/` (for one-time use), and customize to your liking.
  3. Run the initialization playbook from the project root directory: `ansible-playbook -i vm/inventory vendor/geerlingguy/drupal-vm/examples/prod/bootstrap/init.yml -e "ansible_ssh_user=root"`
  4. Run the main Drupal VM playbook to build the server: `DRUPALVM_ENV=prod ansible-playbook -i vm/inventory vendor/geerlingguy/drupal-vm/provisioning/playbook.yml -e "config_dir=$(pwd)/vm" --sudo --ask-sudo-pass --ask-vault-pass`

Notes:

  - Only the repository's owner has the SSH keys for accessing the actual live `prod.drupalvm.com` site, and the Vault password for the protected variables inside `secrets.yml`.

## Keeping things Secret

If you decide to store some private variables in an Ansible Vault-encrypted vars file, then you should run all Vagrant commands like:

    DRUPALVM_ANSIBLE_ARGS='--ask-vault-pass' vagrant [command]

And when running Ansible commands, use:

    ansible-playbook [args] --ask-vault-pass

You can also pass a file path containing the vault password, if you need to do automated deployments. See Ansible's [Vault Documentation](http://docs.ansible.com/ansible/playbooks_vault.html#creating-encrypted-files) for more info.

## Author

This project is maintained by [Jeff Geerling](https://www.jeffgeerling.com/), author of [Ansible for DevOps](https://www.ansiblefordevops.com) and maintainer of [Drupal VM](https://www.drupalvm.com).
