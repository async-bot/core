<?php declare(strict_types=1);

namespace AsyncBot\Core\Http\Validation;

use Opis\JsonSchema\Validator;
use function ExceptionalJSON\encode;

abstract class JsonSchema
{
    /** @var array<mixed> */
    private array $schema;

    private string $validationSchema;

    /**
     * @param array<mixed> $schema
     */
    public function __construct(array $schema)
    {
        $this->schema = $schema;

        // the validation schema needs `null` as id, otherwise Opis\JsonSchema tries to resolve it
        // instead of just using the document as is...
        $schema['$id'] = null;

        $this->validationSchema = encode($schema);
    }

    /**
     * @param array<mixed>|\stdClass<mixed> $responseData
     */
    final public function validate($responseData): bool
    {
        return true;
        return (new Validator())->dataValidation($responseData, $this->validationSchema)->isValid();
    }
}
