<?php

namespace Dashifen\WpCliSuite\Commands\Collection;

use Dashifen\Collection\AbstractCollection;
use Dashifen\WpCliSuite\Commands\CommandInterface;

class CommandCollection extends AbstractCollection
{
  /**
   * @var CommandInterface[]
   */
  protected array $collection;
  
  /**
   * getCollection
   *
   * Returns the entire collection.  Overridden only to alter the phpDocBlock
   * to type hint the contents of the collection that's returned for IDEs.
   *
   * @return CommandInterface[]
   */
  public function getCollection(): array
  {
    return parent::getCollection();
  }
  
  /**
   * current
   *
   * Returns the value at the current index in our collection.  Overridden to
   * provide type hinting for IDEs and PHP's interpreter.
   *
   * @return CommandInterface
   */
  public function current(): CommandInterface
  {
    return parent::current();
  }
  
  /**
   * offsetGet
   *
   * Returns the value at the specified index within the collection.
   * Overridden to provide type hinting for both IDEs and PHP's interpreter.
   *
   * @param mixed $offset
   *
   * @return CommandInterface|null
   */
  public function offsetGet($offset): ?CommandInterface
  {
    return parent::offsetGet($offset);
  }
  
  /**
   * offsetSet
   *
   * Adds the value to the collection at the specified index.  Overridden to
   * confirm $value's type.  Unfortunately, we cannot change the method
   * signature by type hinting $value directly, so we add some tests within
   * the method's body.
   *
   * @param mixed $offset
   * @param mixed $value
   *
   * @return void
   * @throws CommandCollectionException
   */
  public function offsetSet($offset, $value): void
  {
    if (!($value instanceof CommandInterface)) {
      throw new CommandCollectionException(
        'Cannot add non-Command value to CommandCollection',
        CommandCollectionException::INVALID_VALUE
      );
    }
    
    parent::offsetSet($offset, $value);
  }
}
