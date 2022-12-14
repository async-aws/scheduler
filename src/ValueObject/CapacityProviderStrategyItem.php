<?php

namespace AsyncAws\Scheduler\ValueObject;

use AsyncAws\Core\Exception\InvalidArgument;

/**
 * The details of a capacity provider strategy.
 */
final class CapacityProviderStrategyItem
{
    /**
     * The base value designates how many tasks, at a minimum, to run on the specified capacity provider. Only one capacity
     * provider in a capacity provider strategy can have a base defined. If no value is specified, the default value of `0`
     * is used.
     */
    private $base;

    /**
     * The short name of the capacity provider.
     */
    private $capacityProvider;

    /**
     * The weight value designates the relative percentage of the total number of tasks launched that should use the
     * specified capacity provider. The weight value is taken into consideration after the base value, if defined, is
     * satisfied.
     */
    private $weight;

    /**
     * @param array{
     *   base?: null|int,
     *   capacityProvider: string,
     *   weight?: null|int,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->base = $input['base'] ?? null;
        $this->capacityProvider = $input['capacityProvider'] ?? null;
        $this->weight = $input['weight'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function getCapacityProvider(): string
    {
        return $this->capacityProvider;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @internal
     */
    public function requestBody(): array
    {
        $payload = [];
        if (null !== $v = $this->base) {
            $payload['base'] = $v;
        }
        if (null === $v = $this->capacityProvider) {
            throw new InvalidArgument(sprintf('Missing parameter "capacityProvider" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['capacityProvider'] = $v;
        if (null !== $v = $this->weight) {
            $payload['weight'] = $v;
        }

        return $payload;
    }
}
