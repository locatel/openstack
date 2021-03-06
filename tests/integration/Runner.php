<?php

namespace OpenStack\Integration;

class Runner
{
    private $logger;
    private $services = [];

    public function __construct()
    {
        $this->logger = new DefaultLogger();
        $this->assembleServicesFromSamples();
    }

    private function traverse($path)
    {
        return new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS);
    }

    private function assembleServicesFromSamples()
    {
        $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'samples';

        foreach ($this->traverse($path) as $servicePath) {
            if ($servicePath->isDir()) {
                foreach ($this->traverse($servicePath) as $versionPath) {
                    $this->services[$servicePath->getBasename()][] = $versionPath->getBasename();
                }
            }
        }
    }

    private function getOpts()
    {
        $opts = getopt('s:v:t:', [
            'service:',
            'version:',
            'test::',
            'debug::',
            'help::',
        ]);

        return [
            $this->getOpt($opts, ['s', 'service'], 'all'),
            $this->getOpt($opts, ['v', 'version'], 'all'),
            $this->getOpt($opts, ['t', 'test'], ''),
        ];
    }

    private function getOpt(array $opts, array $keys, $default)
    {
        foreach ($keys as $key) {
            if (isset($opts[$key])) {
                return $opts[$key];
            }
        }

        return $default;
    }

    private function getRunnableServices($service, $version)
    {
        $services = $this->services;

        if ($service != 'all') {
            if (!isset($this->services[strtolower($service)])) {
                $this->logger->emergency('{service} does not exist', ['service' => $service]);
            }

            if ($version == 'all') {
                $versions = $this->services[strtolower($service)];
            } else {
                $versions = [$version];
            }

            $services = [$service => $versions];
        }

        return $services;
    }

    public function runServices()
    {
        list ($serviceOpt, $versionOpt, $testMethodOpt) = $this->getOpts();

        $services = $this->getRunnableServices($serviceOpt, $versionOpt, $testMethodOpt);

        foreach ($services as $serviceName => $versions) {
            foreach ($versions as $version) {

                $class = sprintf("%s\\%s\\%sTest", __NAMESPACE__, ucfirst($serviceName), ucfirst($version));
                $testRunner = new $class($this->logger);

                if ($testMethodOpt && method_exists($testRunner, $testMethodOpt)) {
                    $testRunner->$testMethodOpt();
                } else {
                    $testRunner->runTests();
                }

                $testRunner->deletePaths();
            }
        }
    }
}

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$runner = new Runner();
$runner->runServices();