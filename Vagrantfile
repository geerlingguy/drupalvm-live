# The absolute path to the root directory of the project.
ENV['DRUPALVM_PROJECT_ROOT'] = "#{__dir__}"

# The relative path from the project root to the VM config directory.
ENV['DRUPALVM_CONFIG_DIR'] = "vm"

# Always ask for the Vault password.
ENV['DRUPALVM_ANSIBLE_ARGS'] = '--ask-vault-pass'

# The relative path from the project root to the Drupal VM directory.
ENV['DRUPALVM_DIR'] = "vendor/geerlingguy/drupal-vm"

# Load the real Vagrantfile
load "#{__dir__}/#{ENV['DRUPALVM_DIR']}/Vagrantfile"
