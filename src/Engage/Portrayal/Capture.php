<?php namespace Engage\Portrayal;

use Symfony\Component\Process\ProcessBuilder;

class Capture {

    /**
     * Captures a screenshot of the given url and stores it
     * in the defined storage path.
     *
     * @param  string  $url Full url including protocol
     * @param  string  $storagePath Path to store the image in
     * @param  string  $timeout Timeout in seconds
     * @return string  Full path and filename for the screenshot
     */
    public function snap($url, $storagePath, $timeout = 30)
    {
        $outputFilename = $storagePath . '/' . sha1($url) . '.png';

        $process = $this->getPhantomProcess($url, $outputFilename);
        
        $process->setTimeout(10)
            ->setWorkingDirectory(__DIR__)
            ->run();

        if (!$process->isSuccessful()) {
            throw new Exceptions\CaptureException($process->getErrorOutput());
        }

        return $outputFilename;
    }

    /**
     * Get the PhantomJS process instance.
     *
     * @param  string  $url
     * @param  string  $outputFilename
     * @return \Symfony\Component\Process\Process
     */
    public function getPhantomProcess($url, $outputFilename)
    {
        $system = $this->getSystem();

        $phantom = __DIR__ . '/bin/' . $system . '/phantomjs' . $this->getExtension($system);

        return (new ProcessBuilder([$phantom, '--ignore-ssl-errors=true', '--ssl-protocol=tlsv1', 'rasterize.js', $url, $outputFilename]))
                ->getProcess();
    }

    /**
     * Get the operating system for the current platform.
     *
     * @return string
     */
    protected function getSystem()
    {
        $uname = strtolower(php_uname());

        if (str_contains($uname, 'darwin'))
        {
            return 'macosx';
        }
        elseif (str_contains($uname, 'win'))
        {
            return 'windows';
        }
        elseif (str_contains($uname, 'linux'))
        {
            return PHP_INT_SIZE === 4 ? 'linux-i686' : 'linux-x86_64';
        }
        else
        {
            throw new \RuntimeException("Unknown operating system.");
        }
    }

    /**
     * Get the binary extension for the system.
     *
     * @param  string  $system
     * @return string
     */
    protected function getExtension($system)
    {
        return $system == 'windows' ? '.exe' : '';
    }

}
