<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace ApacheSolrForTypo3\Tika\Service\Extractor;

use ApacheSolrForTypo3\Tika\Service\File\SizeValidator;
use ApacheSolrForTypo3\Tika\Util;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LogLevel;
use TYPO3\CMS\Core\Resource\Index\ExtractorInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AbstractExtractor
 *
 * @copyright (c) 2015 Ingo Renner <ingo@typo3.org>
 */
abstract class AbstractExtractor implements ExtractorInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var array
     */
    protected array $configuration;

    /**
     * Priority in handling extraction
     *
     * @var int
     */
    protected int $priority = 0;

    /**
     * @var SizeValidator
     */
    protected SizeValidator $fileSizeValidator;

    /**
     * Constructor
     * @param array|null $extensionConfiguration
     * @param SizeValidator|null $fileSizeValidator
     */
    public function __construct(array $extensionConfiguration = null, SizeValidator $fileSizeValidator = null)
    {
        $this->configuration = $extensionConfiguration ?? Util::getTikaExtensionConfiguration();
        $this->fileSizeValidator = $fileSizeValidator ?? GeneralUtility::makeInstance(
            SizeValidator::class,
            $this->configuration
        );
    }

    /**
     * Returns an array of supported file types
     *
     * @return array
     */
    public function getFileTypeRestrictions(): array
    {
        return [];
    }

    /**
     * Get all supported DriverClasses
     *
     * @return string[] names of supported drivers/driver classes
     */
    public function getDriverRestrictions(): array
    {
        return $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tika']['extractor']['driverRestrictions'];
    }

    /**
     * Returns the data priority of the extraction Service.
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Returns the execution priority of the extraction Service
     *
     * @return int
     */
    public function getExecutionPriority(): int
    {
        return $this->priority;
    }

    /**
     * Logs a message and optionally data to log file
     *
     * @param string $message Log message
     * @param array $data Optional data
     */
    protected function log(string $message, array $data = []): void
    {
        if (!$this->configuration['logging']) {
            return;
        }
        $this->logger->/** @scrutinizer ignore-call */ log(
            LogLevel::DEBUG, // Previous value 0
            $message,
            $data
        );
    }
}
