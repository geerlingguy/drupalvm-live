<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{

    /**
     * Deploy to prod.
     */
    public function deploy() {

        $inventory = __DIR__ . '/vm/inventory';
        $playbook = __DIR__ . '/vendor/geerlingguy/drupal-vm/provisioning/playbook.yml';
        $config = 'config_dir=' . __DIR__ . '/vm';

        // Run ansible on prod.
        $this->taskExec('ansible-playbook ' . $playbook)
            ->env(['DRUPALVM_ENV' => 'prod'])
            ->option('inventory-file', $inventory)
            ->option('extra-vars', $config)
            ->option('become')
            ->option('ask-become-pass')
            ->option('ask-vault-pass')
            ->run();
    }

}
