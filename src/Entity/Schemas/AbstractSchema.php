<?php
/**
 * File AbstractSchema.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Nerdery\Swagger\Entity\Schemas;

use Nerdery\Swagger\Annotations as EP;
use Nerdery\Swagger\Entity\ExternalDocumentation;
use JMS\Serializer\Annotation as JMS;

/**
 * Class AbstractSchema
 *
 * @EP\Discriminator(field = "type", default="object", map = {
 *   "null"   : "Nerdery\Swagger\Entity\Schemas\NullSchema",
 *   "boolean": "Nerdery\Swagger\Entity\Schemas\BooleanSchema",
 *   "integer": "Nerdery\Swagger\Entity\Schemas\IntegerSchema",
 *   "number" : "Nerdery\Swagger\Entity\Schemas\NumberSchema",
 *   "string" : "Nerdery\Swagger\Entity\Schemas\StringSchema",
 *   "array"  : "Nerdery\Swagger\Entity\Schemas\ArraySchema",
 *   "object" : "Nerdery\Swagger\Entity\Schemas\ObjectSchema"
 * })
 *
 * @package Nerdery\Swagger
 * @subpackage Entity\Schemas
 */
abstract class AbstractSchema implements SchemaInterface
{
    // schema types
    const NULL_TYPE    = 'null';
    const BOOLEAN_TYPE = 'boolean';
    const INTEGER_TYPE = 'integer';
    const NUMBER_TYPE  = 'number';
    const STRING_TYPE  = 'string';
    const ARRAY_TYPE   = 'array';
    const OBJECT_TYPE  = 'object';
    const MULTI_TYPE   = 'multi';

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("string")
     * @JMS\SerializedName("type")
     * @var string
     */
    protected $type;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("string")
     * @JMS\SerializedName("format")
     * @var string
     */
    protected $format;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("string")
     * @JMS\SerializedName("title")
     * @var string
     */
    protected $title;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("string")
     * @JMS\SerializedName("description")
     * @var string
     */
    protected $description;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("string")
     * @JMS\SerializedName("default")
     * @var string
     */
    protected $default;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("string")
     * @JMS\SerializedName("example")
     * @var string
     */
    protected $example;

    /**
     * @JMS\Since("2.0")
     * @JMS\Type("Nerdery\Swagger\Entity\ExternalDocumentation")
     * @JMS\SerializedName("externalDocs")
     * @var ExternalDocumentation
     */
    protected $externalDocs;

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return AbstractSchema
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param array $default
     * @return AbstractSchema
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return string
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param string $example
     * @return AbstractSchema
     */
    public function setExample($example)
    {
        $this->example = $example;
        return $this;
    }

    /**
     * @return ExternalDocumentation
     */
    public function getExternalDocs()
    {
        return $this->externalDocs;
    }

    /**
     * @param ExternalDocumentation $externalDocs
     * @return AbstractSchema
     */
    public function setExternalDocs(ExternalDocumentation $externalDocs)
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }
}
