<?php

namespace Dashifen\WpCliSuite\Commands;

use Dashifen\Repository\Repository;
use Dashifen\WPDebugging\WPDebuggingTrait;
use Dashifen\WpCliSuite\Commands\Arguments\ArgumentInterface;
use Dashifen\WpCliSuite\Commands\Arguments\Collection\ArgumentCollection;
use Dashifen\WpCliSuite\Commands\Arguments\Collection\ArgumentCollectionInterface;

abstract class AbstractCommand extends Repository implements CommandInterface
{
  use WPDebuggingTrait;
  
  protected string $name;
  protected string $slug;
  protected string $shortDesc;
  protected string $longDesc;
  protected string $when;
  
  // the WP CLI docs refer to the arguments for a command as its synopsis.  in
  // order to keep our property names matching those docs, we'll use that name,
  // too, even though it's not entirely clear why this one was chosen.
  
  protected ArgumentCollectionInterface $synopsis;
  
  public function __construct(
    string $name,
    string $shortDesc,
    string $longDesc = '',
    string $when = 'after_wp_load',
    ?ArgumentCollectionInterface $synopsis = null
  ) {
    parent::__construct([
      'name'      => $name,
      'shortDesc' => $shortDesc,
      'longDesc'  => $longDesc,
      'when'      => $when,
    ]);
    
    $this->synopsis = $synopsis ?? new ArgumentCollection();
  }
  
  /**
   * setName
   *
   * Sets the name and slug properties.
   *
   * @param string $name
   */
  protected function setName(string $name): void
  {
    $this->slug = sanitize_title($name);
    $this->name = $name;
  }
  
  /**
   * setShortDesc
   *
   * Sets the property for this command's short description.
   *
   * @param string $shortDesc
   *
   * @return void
   */
  protected function setShortDesc(string $shortDesc): void
  {
    $this->shortDesc = $shortDesc;
  }
  
  /**
   * setLongDesc
   *
   * Sets the property for this command's long description.
   *
   * @param string $longDesc
   *
   * @return void
   */
  protected function setLongDesc(string $longDesc): void
  {
    $this->longDesc = $longDesc;
  }
  
  /**
   * setWhen
   *
   * Sets the when property.
   *
   * @param string $when
   *
   * @return void
   */
  protected function setWhen(string $when): void
  {
    $this->when = $when;
  }
  
  /**
   * addArgument
   *
   * Adds an argument to this command's collection of them.
   *
   * @param ArgumentInterface $argument
   *
   * @return void
   */
  public function addArgument(ArgumentInterface $argument): void
  {
    $this->synopsis[$argument->name] = $argument;
  }
  
  /**
   * getCallable
   *
   * Returns a callable function that is executed at the time the CLI command
   * is executed that performs the work of the command.
   *
   * @return callable
   */
  public function getCallable(): callable
  {
    // WordPress will execute this callable when the command line tells it to
    // passing the command line arguments and flags to the callable.  we, in
    // turn, pass those parameters into the method below.  this allows WP Core
    // to reference our protected execute method
    
    return fn(array $args, array $flags) => $this->execute($args, $flags);
  }
  
  /**
   * execute
   *
   * Performs the behaviors of this command.
   *
   * @param array $args
   * @param array $flags
   *
   * @return void
   */
  abstract protected function execute(array $args, array $flags): void;
  
  /**
   * getCommandDescription
   *
   * Returns the full description of this command for use as the third
   * parameter to the WP_CLI add_command method.
   *
   * @return array
   */
  public function getDescription(): array
  {
    // this is almost the same as our toArray method.  the only difference is
    // that this time, we don't want any empty values in the array, so after
    // we create it, we immediately filter it to remove them.
    
    return array_filter($this->toArray());
  }
}
