<?php

namespace Dashifen\WpCliSuite\Commands;

use Dashifen\Exception\Exception;

class CommandException extends Exception
{
  public const INVALID_VALUE = 1;
}
