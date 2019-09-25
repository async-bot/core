<?php declare(strict_types=1);

namespace AsyncBot\Core\Http\Validation;

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use function ExceptionalJSON\encode;

abstract class JsonSchema
{
    /** @var array<mixed> */
    private array $schema;

    /**
     * @param array<mixed> $schema
     */
    public function __construct(array $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @param array<mixed> $responseData
     */
    final public function validate(array $responseData): bool
    {
        $schema = Schema::fromJsonString(encode($this->schema));

        return (new Validator())->dataValidation($responseData, $schema)->isValid();
    }
}
