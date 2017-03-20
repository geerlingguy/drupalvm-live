# Drupal VM Live Site Repository

This project was built using the [`drupal-project`](https://github.com/drupal-composer/drupal-project) Drupal Composer template, and is used to demonstrate [Drupal VM](https://www.drupalvm.com)'s local and production environment management capabilities.

## Prerequisites

You should have the following installed on your local environment prior to working on this project:

  1. Vagrant and VirtualBox
  2. PHP and Composer
  3. Vagrant plugins: `vagrant-vbguest`, `vagrant-hostsupdater`

## Local setup

If this is the first time you've cloned the project, run the following commands to get started developing:

  1. `composer install`
  2. `vagrant up`

Once that's completed, you can visit [http://local.drupalvm.com/](http://local.drupalvm.com/) in your browser to see the site locally.

## Prod setup

TODO.

## Author

This project is maintained by [Jeff Geerling](https://www.jeffgeerling.com/), author of [Ansible for DevOps](https://www.ansiblefordevops.com) and maintainer of [Drupal VM](https://www.drupalvm.com).
