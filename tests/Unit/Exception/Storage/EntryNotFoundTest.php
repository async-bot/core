<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Exception\Storage;

use AsyncBot\Core\Exception\Storage\EntryNotFound;
use PHPUnit\Framework\TestCase;

final class EntryNotFoundTest extends TestCase
{
    public function testConstructorFormatsMessageCorrectly(): void
    {
        $this->expectException(EntryNotFound::class);
        $this->expectExceptionMessage('No entry exists for key TEST_KEY in the storage');

        throw new EntryNotFound('TEST_KEY');
    }
}
