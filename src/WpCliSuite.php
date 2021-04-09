<?php

namespace Dashifen\WpCliSuite;

use WP_CLI;
use Exception;
use Dashifen\WpCliSuite\Commands\CommandInterface;
use Dashifen\WpCliSuite\Commands\Collection\CommandCollection;
use Dashifen\WpCliSuite\Commands\Collection\CommandCollectionInterface;

class WpCliSuite implements WpCliSuiteInterface
{
  protected CommandCollectionInterface $commands;
  
  /**
   * WpCliSuite constructor.
   *
   * @param CommandCollectionInterface|null $collection
   */
  public function __construct(?CommandCollectionInterface $collection = null)
  {
    $this->commands = $collection ?? new CommandCollection();
  }
  
  /**
   * registerCommand
   *
   * Given a command, adds it to our collection.
   *
   * @param CommandInterface $command
   *
   * @return void
   */
  public function registerCommand(CommandInterface $command): void
  {
    $this->commands[$command->slug] = $command;
  }
  
  /**
   * initializeCommands
   *
   * Loops over the internal collection of commands and adds them to the WP
   * CLI one at at time.
   *
   * @throws Exception
   */
  public function initializeCommands(): void
  {
    foreach ($this->commands as $command) {
      WP_CLI::add_command(
        $command->name,
        $command->getCallable(),
        $command->getDescription()
      );
    }
  }
}
