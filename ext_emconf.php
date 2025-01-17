<?php

/** @noinspection PhpUndefinedVariableInspection */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Apache Tika for TYPO3',
    'description' => 'Provides Tika services for TYPO3 to detect a document\'s language, extract meta data, and extract content from files. Can either use a stand alone Tika executable or Tika integrated in a Solr server with an activated extracting request handler.',
    'version' => '12.0.0',
    'state' => 'stable',
    'category' => 'services',
    'author' => 'Ingo Renner, Timo Hund, Markus Friedrich, Rafael Kähm',
    'author_email' => 'solr-eb-support@dkd.de',
    'author_company' => 'dkd Internet Service GmbH',
    'clearCacheOnLoad' => true,
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.2-12.4.99',
            'filemetadata' => '',
        ],
        'conflicts' => [],
        'suggests' => [
            'solr' => '12.0.0-12.99.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'ApacheSolrForTypo3\\Tika\\' => 'Classes/',
        ],
    ],
    '_md5_values_when_last_written' => '',
];
