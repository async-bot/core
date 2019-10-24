<?php declare(strict_types=1);

namespace AsyncBot\CoreTest\Unit\Storage\KeyValue;

use AsyncBot\Core\Exception\Storage\EntryNotFound;
use AsyncBot\Core\Storage\KeyValue\FileSystem;
use PHPUnit\Framework\TestCase;
use function Amp\Promise\wait;

final class FileSystemTest extends TestCase
{
    private string $originalData;

    private FileSystem $storage;

    public function setUp(): void
    {
        $this->originalData = file_get_contents(TEST_DATA_DIR . '/Storage/keyvalue-filesystem.json');

        $this->storage = new FileSystem(TEST_DATA_DIR . '/Storage/keyvalue-filesystem.json');
    }

    public function tearDown(): void
    {
        file_put_contents(TEST_DATA_DIR . '/Storage/keyvalue-filesystem.json', $this->originalData);
    }

    public function testGetReturnsValueForExistingKey(): void
    {
        $this->assertSame(true, wait($this->storage->get('existing')));
    }

    public function testGetThrowsForNonExistingKey(): void
    {
        $this->expectException(EntryNotFound::class);

        wait($this->storage->get('nonExisting'));
    }

    public function testSet(): void
    {
        wait($this->storage->set('new', 42));

        $this->assertSame(42, wait($this->storage->get('new')));
    }

    public function testUnset(): void
    {
        wait($this->storage->unset('existing'));

        $this->expectException(EntryNotFound::class);

        wait($this->storage->get('nonExisting'));
    }

    public function testClear(): void
    {
        wait($this->storage->clear());

        $this->expectException(EntryNotFound::class);

        wait($this->storage->get('nonExisting'));
    }
}
