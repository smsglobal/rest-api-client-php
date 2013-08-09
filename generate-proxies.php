<?php
require __DIR__ . '/vendor/autoload.php';

// We don't need all the resources because only a few can have relations
$resources = array(
    'Campaign',
    'Contact',
    'Group',
    'Mms',
    'MmsAttachment',
    'MmsIncoming',
    'MmsIncomingAttachment',
    'SharedPool',
);

$ignoredMethods = array(
    'getId',
    'getResourceName',
    'getResourceUri',
);

foreach ($resources as $name) {
    $class = 'Smsglobal\\RestApiClient\\Resource\\' . $name;
    $methods = '';

    foreach (get_class_methods($class) as $method) {
        if ('get' !== substr($method, 0, 3) || in_array($method, $ignoredMethods)) {
            // We're only interested in getters
            continue;
        }

        $methods .= '    public function ' . $method . '()
    {
        $this->load();
        return parent::' . $method . '();
    }

';
    }

    $php = '<?php
namespace Smsglobal\\RestApiClient\\Resource\\Proxy;

use Smsglobal\\RestApiClient\\Resource\\' . $name . ';
use Smsglobal\\RestApiClient\\RestApiClient;

class ' . $name . 'Proxy extends ' . $name . '
{
    private $manager;

    public function __construct($resourceUri, RestApiClient $manager)
    {
        $this->resourceUri = $resourceUri;
        $this->manager = $manager;

        // Get the ID from the resource URI
        // /v1/resource/id/ -> id
        $this->id = substr($resourceUri, 0, -1);
        $this->id = (int) substr($this->id, strrpos(\'/\', $this->id) + 1, -1);
    }

    private function load()
    {
        if (isset($this->manager)) {
            $options = $this->manager->get($this->getResourceName(), $this->id);
            $this->setOptions($options);

            unset($this->manager);
        }
    }

' . $methods . '}
';

    file_put_contents(__DIR__ . '/Smsglobal/RestApiClient/Resource/Proxy/' . $name . 'Proxy.php', $php);
}
