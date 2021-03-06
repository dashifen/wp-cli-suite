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
class AssociativeArgument extends AbstractArgument
{
  /**
   * AssociativeArgument constructor.
   *
   * @param string $name
   * @param array  $options
   * @param string $description
   * @param string $default
   * @param bool   $repeating
   *
   * @throws RepositoryException
   * @throws ArgumentException
   */
  public function __construct(string $name, array $options, string $description = '', string $default = '', bool $repeating = false)
  {
    parent::__construct([
      'name'        => $name,
      'type'        => 'assoc',
      'description' => $description,
      'options'     => $options,
      
      // default is allowed to be empty because we make the opinionated choice
      // to use the first option in the array as the default unless a dev
      // specifies something else.
      
      'default'     => $default,
      
      // honestly, i'm not sure if WP even allows repeating associative
      // arguments, but nothing in the docs say that they can't repeat, so
      // we'll allow it.
      
      'repeating'   => $repeating,
    ]);
  }
}
