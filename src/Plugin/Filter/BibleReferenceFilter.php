<?php

namespace Drupal\biblereference\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

use Drupal\Core\Form\FormStateInterface;

include_once 'scripturefilter.inc';

/**
 * @Filter(
 *   id = "biblereference",
 *   title = @Translation("Bible Reference Filter"),
 *   description = @Translation("Converts Scripture References into links"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class BibleReferenceFilter extends FilterBase {
    public function settingsForm(array $form, FormStateInterface $form_state) {
        $form['biblereference'] = array(
            '#type' => 'select',
            '#title' => $this->t('Bible Translation'),
            '#default_value' => "ESV",
            '#description' => $this->t('Select which Bible version to use'),
            '#options' => array(
                "KJ21" => t("21st Century King James Version"),
                "ASV" => t("American Standard Version"),
                "AMP" => t("Amplified Bible"),
                "CEV" => t("Contemporary English Version"),
                "DARBY" => t("Darby Translation"),
                "ESV" => t("English Standard Version"),
                "KJV" => t("King James Version"),
                "MSG" => t("The Message"),
                "NASB" => t("New American Standard Bible"),
                "NET" => t("New English Translation"),
                "NIRV" => t("New International Reader's Version"),
                "NIV" => t("New International Version"),
                "NIV1984" => t("New International Version 1984"),
                "NIV-UK" => t("New International Version - UK"),
                "NKJV" => t("New King James Version"),
                "NLT" => t("New Living Translation"),
                "TNIV" => t("Today's New International Version"),
                "WE" => t("Worldwide English New Testament"),
                "WYC" => t("Wycliffe New Testament"),
                "YLT" => t("Young's Literal Translation"),
            )
        );
        return $form;
    }

    public function process($text, $langcode) {
        $translation = $this->settings['biblereference'];
        $processed_text = scripturefilter_scripturize($text, $translation);

        return new FilterProcessResult($processed_text);
    }
}