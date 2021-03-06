<?php
/**
 * File ArrayHeaderTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Nerdery\Swagger\Tests\Entity\Headers;

use Nerdery\Swagger\Entity\Headers\AbstractHeader;
use Nerdery\Swagger\Entity\Headers\ArrayHeader;
use Nerdery\Swagger\Tests\Mixin\SerializerContextTrait;

/**
 * Class ArrayHeaderTest
 *
 * @package Nerdery\Swagger
 * @subpackage Tests\Entity\Headers
 */
class ArrayHeaderTest extends \PHPUnit_Framework_TestCase
{
    use SerializerContextTrait;

    /**
     * @var ArrayHeader
     */
    protected $arrayHeader;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->arrayHeader = new ArrayHeader();
    }

    /**
     * @covers Nerdery\Swagger\Entity\Headers\ArrayHeader::getType
     */
    public function testType()
    {
        $this->assertNotEmpty($this->arrayHeader->getType());
        $this->assertEquals(AbstractHeader::ARRAY_TYPE, $this->arrayHeader->getType());
    }

    /**
     * @covers Nerdery\Swagger\Entity\Headers\ArrayHeader::getCollectionFormat
     * @covers Nerdery\Swagger\Entity\Headers\ArrayHeader::setCollectionFormat
     */
    public function testCollectionFormat()
    {
        $this->assertClassHasAttribute('collectionFormat', ArrayHeader::class);
        $this->assertInstanceOf(ArrayHeader::class, $this->arrayHeader->setCollectionFormat('csv'));
        $this->assertAttributeEquals('csv', 'collectionFormat', $this->arrayHeader);
        $this->assertEquals('csv', $this->arrayHeader->getCollectionFormat());
    }

    /**
     * @covers Nerdery\Swagger\Entity\Headers\ArrayHeader
     */
    public function testSerialization()
    {
        $data = json_encode([
            'type' => AbstractHeader::ARRAY_TYPE,
            'format'           => 'foo',
            'description'      => 'bar',
            'default'          => 'baz',
            'collectionFormat' => 'csv',
        ]);

        $schema = $this->getSerializer()->deserialize($data, AbstractHeader::class, 'json');

        $this->assertInstanceOf(ArrayHeader::class, $schema);
        $this->assertAttributeEquals('foo', 'format', $schema);
        $this->assertAttributeEquals('bar', 'description', $schema);
        $this->assertAttributeEquals('baz', 'default', $schema);
        $this->assertAttributeEquals('csv', 'collectionFormat', $schema);

        $json = $this->getSerializer()->serialize($schema, 'json');

        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonString($data, $json);
    }
}
