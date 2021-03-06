<?php
namespace App\DependencyInjection;

use App\Library\ErrorHandler;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Finder\Finder;

class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @param string $baseNamespaceName Highest level namespace for the application
     */
    public function __construct($baseNamespaceName)
    {
        // our error handler
        ErrorHandler::register();

        // create and populate the container
        $this->container = new ContainerBuilder();

        // some useful paths
        $paths = array();
        $paths['root'] = __DIR__ . '/../../../';
        $paths['config'] = $paths['root'] . 'app/config/';
        $this->container->setParameter('paths', $paths);

        // the main config
        $loader = new YamlFileLoader($this->container, new FileLocator($paths['config']));
        $loader->load('config.yml');

        // construct the application
        $app = $this->container->getParameter('application');
        parent::__construct($app['name'], $app['version']);

        // and add commands to it
        $this->addConsoleCommands($baseNamespaceName);


        // may be we have some commands also
        $this->addConsoleCommands(__NAMESPACE__);

        //$this->container->compile();
    }

    /**
     * Adds all existing console commands
     *
     * @param string $baseNamespaceName Base namespace for the commands
     */
    protected function addConsoleCommands($baseNamespaceName)
    {
        // get all namespaces from the composer autoload list
        $paths = $this->container->getParameter('paths');
        $namespaces = include $paths['root'] . '/vendor/composer/autoload_namespaces.php';

        // find the path for the namespace
        foreach ($namespaces as $namespace => $lookupPaths) {
            if ($namespace == $baseNamespaceName) {
                // add all existing commands
                foreach ($lookupPaths as $path) {
                    $commandPath = $path . '/' . $namespace . '/Command/';
                    if (is_dir($commandPath)) {
                        $files = Finder::create()
                            ->files()
                            ->name('*Command.php')
                            ->in($path . '/' . $namespace . '/Command/');

                        foreach ($files as $file) {
                            $className = $file->getBasename('.php'); // strip .php extension
                            $r = new \ReflectionClass($baseNamespaceName . '\Command' . '\\' . $className);
                            if (!$r->isAbstract()) {
                                $instance = $r->newInstance();

                                if (method_exists($instance, 'setContainer')) {
                                    $instance->setContainer($this->container);
                                }
                                $this->add($instance);
                            }
                        }
                    }
                }
                break;
            }
        }
    }

    public function getContainer()
    {
        return $this->container;
    }
}
