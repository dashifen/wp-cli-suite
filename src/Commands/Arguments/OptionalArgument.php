<?php

namespace Dashifen\WpCliSuite\Commands\Arguments;

use Dashifen\Repository\RepositoryException;
use Dashifen\WpCliSuite\Commands\Arguments\AbstractArgument;
use Dashifen\WpCliSuite\Commands\Arguments\ArgumentException;

/**
 * Class PositionalArgument
 *
 * @property-read string $type
 * @property-read string $name
 * @property-read string $description
 * @property-read array  $options
 * @property-read string $default
 * @property-read bool   $repeating
 * @property-read bool   $optional
 *
 * @package Dashifen\WpCliSuite\Commands\Synopses\Arguments
 */
class OptionalArgument extends AbstractArgument
{
  /**
   * Flag constructor.
   *
   * @param string $name
   * @param string $description
   *
   * @throws RepositoryException
   * @throws ArgumentException
   */
  public function __construct(string $name, string $description = '')
  {
    parent::__construct([
      'name'        => $name,
      'type'        => 'flag',
      'description' => $description,
    ]);
  }
}
