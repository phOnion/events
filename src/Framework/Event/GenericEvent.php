<?php declare(strict_types=1);

namespace Onion\Framework\Event;

use Onion\Framework\Event\Interfaces\EventInterface;

class GenericEvent implements EventInterface
{
    use EventTrait;

    private $name;
    private $source;

    public function __construct(string $name, array $parameters = [], string $source = null)
    {
        $this->name = $name;
        $this->setParams($parameters);
        $this->source = $source;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSource(): string
    {
        return $this->source;
    }
}