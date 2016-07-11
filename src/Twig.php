<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 7/11/2016
 * Time: 10:38 AM
 */

namespace KungFu\Boil;


use Pagekit\Application as App;
use Symfony\Component\Console\Output\OutputInterface;

class Twig
{
    protected $twig;

    protected $moduleName;

    protected $vendorName;

    protected $packageDir;

    protected $output;

    protected $twigVariables = [];

    protected $modulePath;

    /**
     * Twig constructor.
     * @param $moduleName
     * @param $vendorName
     * @param OutputInterface $output
     */
    public function __construct($moduleName, $vendorName, $output)
    {
        $this->moduleName = $moduleName;
        $this->vendorName = $vendorName;
        $this->output = $output;

        $this->packageDir = App::get('path.packages');

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/module_template');
        $this->twig = new \Twig_Environment($loader);

        $undercase = strtolower($this->moduleName);
        $vendorName = ucfirst(strtolower($this->vendorName));

        $this->twigVariables = [
            'module_name' => $undercase,
            'vendor_name' => strtolower($this->vendorName),
            'vendor_name_u' => $vendorName,
            'module_name_u' => ucfirst($undercase)
        ];

        $this->modulePath = $this->packageDir . '/' . $this->twigVariables['vendor_name'] . '/' . $this->twigVariables['module_name'];

        if (!file_exists($this->modulePath)) {
            if (!mkdir($this->modulePath, 0777, true)) {
                $output->writeln('Could not create file structure for: ' . $this->modulePath);
                return false;
            }
        }

        $structure = App::module('template-generator')->config('structure');

        foreach ($structure as $path) {

            $path = $this->modulePath . '/' . $path;

            if (!file_exists($path)) {
                if (!mkdir($path, 0777, true)) {
                    $output->writeln('Could not create file structure for: ' . $path);
                    return false;
                }
            }
        }
        return true;
    }


    public function render()
    {
        $templates = App::module('template-generator')->config('templates');

        foreach ($templates as $template) {

            $path = $this->modulePath . '/' . $template;

            $templateFile = $this->twig->render($template, $this->twigVariables);
            $file = fopen($path, 'w');
            fwrite($file, $templateFile);
            fclose($file);
        }

        // Render the controller separately sense the file name has to be different.
        $controllerFile = $this->twig->render('src/Controller/controller.php', $this->twigVariables);

        $path = $this->modulePath . '/src/Controller/' . $this->twigVariables['module_name_u'] . 'Controller.php';
        $file = fopen($path, 'w');
        fwrite($file, $controllerFile);
        fclose($file);
    }
}
