Feature: Test DrupalContext
  In order to prove the Behat is working correctly in Drupal VM
  As a developer
  I need to run a simple interface test

  Scenario: Viewing content in a region
    Given I am on the homepage
    Then I should see "This is a demonstration production Drupal 8 website" in the "content"