<?php

namespace Suminagashi\OrchestraBundle\Metadata\Resource;

/**
 * A collection of resource class names.
 */
final class ResourceNameCollection implements \IteratorAggregate, \Countable
{
    private $classes;

    /**
     * @param string[] $classes
     */
    public function __construct(array $classes = [])
    {
        $this->classes = $classes;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Traversable<string>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->classes);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->classes);
    }
}
