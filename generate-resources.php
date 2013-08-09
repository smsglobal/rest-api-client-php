<?php
require __DIR__ . '/../../vendor/autoload.php';

use Smsglobal\ClassLibrary\Http\Request;

$request = new Request('http://api2.local/v1/');
$request->headers->set('Accept', 'application/json');
$resources = (array) json_decode($request->get()->getContent());

foreach ($resources as $name => $resource) {
    $request->setUrl('http://api2.local/v1/' . $name . '/schema/');

    $name = explode('-', $name);
    $name = array_map('ucfirst', $name);
    $name = implode('', $name);

    $fields = (array) json_decode($request->get()->getContent())->fields;

    $fieldCode = '';
    $methodCode = '';
    unset($fields['id']);
    foreach ($fields as $fieldName => $field) {
        $fieldCode .= '    protected $' . $fieldName . ';

';
        $type = $field->type;

        $map = array(
            'related' => $name,
            'integer' => 'int',
            'boolean' => 'bool',
            'datetime' => '\\DateTime',
            'string' => 'string',
            'float' => 'float',
        );

        if ('datetime' === $type) {
            $typeHint = '\DateTime ';
        } else {
            $typeHint = '';
        }

        $type = $map[$type];

        $castTypes = array(
            'int',
            'bool',
            'string',
            'float',
        );
        if (in_array($type, $castTypes)) {
            $cast = '(' . $type . ') ';
        } else {
            $cast = '';
        }

        if (!$field->isReadOnly) {
            // Setter
            $methodCode .= '    /**
     * Sets the ' . $fieldName . '
     *
     * @param ' . $type . ' $' . $fieldName . ' ' . $field->helpText . '
     *
     * @return $this Provides a fluent interface
     */
    public function set' . ucfirst($fieldName) . '(' . $typeHint . '$' . $fieldName . ')
    {
        $this->' . $fieldName . ' = ' . $cast . '$' . $fieldName . ';

        return $this;
    }

';
        }

        $methodCode .= '    /**
     * Gets the ' . $fieldName . '
     *
     * @return ' . $type . '
     */
    public function get' . ucfirst($fieldName) . '()
    {
        return $this->' . $fieldName . ';
    }

';
    }

    $php = '<?php
namespace Smsglobal\\ClassLibrary\\Resource;

class ' . $name . ' extends Base
{
' . $fieldCode . $methodCode . '}
';

    file_put_contents(__DIR__ . '/Resource/' . $name . '.php', $php);
}
