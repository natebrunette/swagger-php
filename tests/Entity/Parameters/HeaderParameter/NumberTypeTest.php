<?php
/**
 * File NumberTypeTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Nerdery\Swagger\Tests\Entity\Parameters\HeaderParameter;

use Nerdery\Swagger\Entity\Parameters\AbstractParameter;
use Nerdery\Swagger\Entity\Parameters\AbstractTypedParameter;
use Nerdery\Swagger\Entity\Parameters\HeaderParameter;
use Nerdery\Swagger\Tests\Mixin\SerializerContextTrait;

/**
 * Class NumberTypeTest
 *
 * @package Nerdery\Swagger
 * @subpackage Tests\Entity\Parameters\HeaderParameter
 */
class NumberTypeTest extends \PHPUnit_Framework_TestCase
{
    use SerializerContextTrait;

    /**
     * @var HeaderParameter\NumberType
     */
    protected $parameter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->parameter = new HeaderParameter\NumberType();
    }

    /**
     * @covers Nerdery\Swagger\Entity\Parameters\HeaderParameter\NumberType
     */
    public function testSerialization()
    {
        $data = json_encode([
            'in'   => AbstractParameter::IN_HEADER,
            'type' => AbstractTypedParameter::NUMBER_TYPE,
            'name'             => 'foo',
            'description'      => 'bar',
            'required'         => false,
            'format'           => 'baz',
            'allowEmptyValues' => true,
            'default'          => false,
        ]);

        $parameter = $this->getSerializer()->deserialize($data, AbstractParameter::class, 'json');

        $this->assertInstanceOf(HeaderParameter\NumberType::class, $parameter);
        $this->assertAttributeEquals(AbstractParameter::IN_HEADER, 'in', $parameter);
        $this->assertAttributeEquals(AbstractTypedParameter::NUMBER_TYPE, 'type', $parameter);
        $this->assertAttributeEquals('foo', 'name', $parameter);
        $this->assertAttributeEquals('bar', 'description', $parameter);
        $this->assertAttributeEquals(false, 'required', $parameter);
        $this->assertAttributeEquals('baz', 'format', $parameter);
        $this->assertAttributeEquals(true, 'allowEmptyValues', $parameter);
        $this->assertAttributeEquals(false, 'default', $parameter);

        $json = $this->getSerializer()->serialize($parameter, 'json');

        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonString($data, $json);
    }
}