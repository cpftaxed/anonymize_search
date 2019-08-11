<?php

/**
 * @file
 * Contains \Drupal\anonymize_search\Plugin\Block\AnonymizeSearchBlock.
 */

namespace Drupal\anonymize_search\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form block using the Anonymize.com search engine.
 *
 * @Block(
 *   id = "anonymize_search_block",
 *   admin_label = "Anonymize Search Form"
 * )
 */

class AnonymizeSearchBlock extends BlockBase implements BlockPluginInterface {
        public function build() {
                $ra = [
                        '#theme' => 'anonymize_search_form',
                        '#domain_name' => $this->getDomainName()
                ];

                return $ra;
        }

        public function blockForm($form, FormStateInterface $form_state) {
                $form = parent::blockForm($form, $form_state);

                $form['domain_name'] = [
                        '#type' => 'textfield',
                        '#title' => 'Domain name to search',
                        '#description' => 'Enter the domain name to limit the search.',
                        '#default_value' => $this->getDomainName()
                ];

                return $form;
        }

        public function blockValidate($form, FormStateInterface $form_state) {
                if (empty($form_state->getValue('domain_name'))) {
                        $form_state->setErrorByName('domain_name', 'Domain name is required.');
                }
        }
        
        public function blockSubmit($form, FormStateInterface $form_state) {
                parent::blockSubmit($form, $form_state);

                $this->configuration['anonymize_search_domain'] = $form_state->getValue('domain_name');
        }

        public function getDomainName() {
                $config = $this->getConfiguration();

                return !empty($config['anonymize_search_domain']) ? $config['anonymize_search_domain'] : '';
        }
}


