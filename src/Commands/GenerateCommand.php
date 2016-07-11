<?php

namespace KungFu\Boil\Commands;


use KungFu\Boil\Twig;
use Pagekit\Application\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 7/11/2016
 * Time: 10:31 AM
 */
class GenerateCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'generate';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Used to generate Pagekit templates';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->addArgument('type', InputArgument::REQUIRED, 'Only \'module\' supported right now');
        $this->addArgument('vendor_name', InputArgument::REQUIRED, 'Your vendor name');
        $this->addArgument('module_name', InputArgument::REQUIRED, 'The module name');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($this->argument('type')) {
            case 'module':
                $this->generateModule($output);
                break;
            default:
                $output->writeln('Must set type as first argument. Only \'module\' is supported now.');
        }
    }

    protected function generateModule(OutputInterface $output)
    {
        $twig = new Twig($this->argument('module_name'), $this->argument('vendor_name'), $output);

        if ($twig) {
            $twig->render();
            $output->writeln('Rendered');
        }
    }
}