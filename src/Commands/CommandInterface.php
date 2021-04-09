<?php

namespace Dashifen\WpCliSuite\Commands;

use Dashifen\WpCliSuite\Commands\Arguments\ArgumentInterface;

/**
 * Interface CommandInterface
 *
 * @property-read string $name
 * @property-read string $slug
 * @property-read string $shortDesc
 * @property-read string $longDesc
 * @property-read string $synopsis
 * @property-read string $when
 *
 * @package Dashifen\WpCliSuite\Command
 */
interface CommandInterface
{
  /**
   * addArgument
   *
   * Adds an argument to this command's collection of them.
   *
   * @param ArgumentInterface $argument
   *
   * @return mixed
   */
  public function addArgument(ArgumentInterface $argument);
  
  /**
   * getCallable
   *
   * Returns a callable function that is executed at the time the CLI command
   * is executed that performs the work of the command.
   *
   * @return callable
   */
  public function getCallable(): callable;
  
  /**
   * getCommandDescription
   *
   * Returns the full description of this command for use as the third
   * parameter to the WP_CLI add_command method.
   *
   * @return array
   */
  public function getDescription(): array;
}
