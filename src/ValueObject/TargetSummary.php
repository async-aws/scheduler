<?php

namespace AsyncAws\Scheduler\ValueObject;

/**
 * The schedule's target details.
 */
final class TargetSummary
{
    /**
     * The Amazon Resource Name (ARN) of the target.
     */
    private $arn;

    /**
     * @param array{
     *   Arn: string,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->arn = $input['Arn'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getArn(): string
    {
        return $this->arn;
    }
}
