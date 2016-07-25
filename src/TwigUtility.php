<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 7/11/2016
 * Time: 10:38 AM
 */

namespace KungFu\Generate;


use Pagekit\Application as App;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Twig
 * @package KungFu\Generate
 */
class TwigUtility
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $moduleName;

    /**
     * @var string
     */
    protected $vendorName;

    /**
     * @var string
     */
    protected $packageDir;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var array
     */
    protected $twigVariables = [];

    /**
     * @var string
     */
    protected $modulePath;

    /**
     * @var int|string
     */
    protected $mode = 0751;

    /**
     * Twig constructor.
     * @param $moduleName
     * @param $vendorName
     * @param $mode
     * @param OutputInterface $output
     */
    public function __construct($vendorName, $moduleName, $mode, $output)
    {
        $this->moduleName = $moduleName;
        $this->vendorName = $vendorName;
        $this->output = $output;

        if ($mode && !$this->mode = $this->formatMode($mode)) {
            $output->writeln('Could not format mode: ' . $mode);
            $output->writeln('Mode must be in the form of \'0ddd\' or \'ddd\' where \'d\' is a digit.');
            die;
        }

        $this->packageDir = App::get('path.packages');

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/extension_template');
        $this->twig = new \Twig_Environment($loader);

        $undercase = strtolower($this->moduleName);
        $vendorName = strtolower($this->vendorName);

        $modSplit = explode('-', $undercase);
        $venSplit = explode('-', $vendorName);

        $this->twigVariables = [
            'module_name' => $undercase,
            'vendor_name' => $this->vendorName,
            'module_name_u' => join('', array_map('ucfirst', $modSplit)),
            'vendor_name_u' => join('', array_map('ucfirst', $venSplit)),
            'module_name_pretty' => join(' ', array_map('ucfirst', $modSplit)),
            'vendor_name_pretty' => join(' ', array_map('ucfirst', $venSplit))
        ];

        $this->modulePath = $this->packageDir . '/' . $this->twigVariables['vendor_name'] . '/' . $this->twigVariables['module_name'];

        if (!$this->buildFileStructure()) {
            die;
        }
    }


    /**
     * The main render function
     *
     * @param string $type
     * @param bool $renderController
     */
    public function render($type, $renderController = true)
    {
        $templates = App::module('template-generator')->config('templates')[$type];

        $progress = new ProgressBar($this->output, count($templates));
        $progress->start();

        foreach ($templates as $template) {

            $path = $this->modulePath . '/' . $template;

            $templateFile = $this->twig->render($template, $this->twigVariables);
            $file = fopen($path, 'w');
            fwrite($file, $templateFile);
            fclose($file);
            $progress->advance();
        }

        if ($renderController) {
            $this->renderController($this->twigVariables['module_name_u']);
        }

        $progress->finish();
    }

    /**
     * Render a controller
     *
     * @param $name
     */
    protected function renderController($name)
    {
        // Render the controller separately sense the file name has to be different.
        $controllerFile = $this->twig->render('src/Controller/controller.php.twig', $this->twigVariables);

        $path = $this->modulePath . '/src/Controller/' . $name . 'Controller.php';
        $file = fopen($path, 'w');
        fwrite($file, $controllerFile);
        fclose($file);
    }

    /**
     * Create the directories for the new extension
     *
     * @return bool
     */
    protected function buildFileStructure()
    {
        if (!file_exists($this->modulePath)) {
            if (!mkdir($this->modulePath, $this->mode, true)) {
                $this->output->writeln('Could not create file structure for: ' . $this->modulePath);
                return false;
            }
        }

        $structure = App::module('template-generator')->config('structure');

        foreach ($structure as $path) {

            $path = $this->modulePath . '/' . $path;

            if (!file_exists($path)) {
                if (!mkdir($path, $this->mode, true)) {
                    $this->output->writeln('Could not create file structure for: ' . $path);
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Appends a zero if a mode was passed like 777
     *
     * @param $mode
     * @return bool|string
     */
    protected function formatMode($mode)
    {
        $str = (string) $mode;
        if (strlen($str) === 3) {
            return intval(sprintf("%'.04d\n", $str));
        } else if (strlen($str) !== 4) {
            return false;
        }
        return $mode;
    }
}
