<?php

namespace KungFu\Generate\Commands;


use KungFu\Generate\TwigUtility;
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
class GenerateExtensionCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'generate:extension';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Used to generate Pagekit templates \'php pagekit generate:extension hello/world\'';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->addArgument('namespace', InputArgument::REQUIRED, 'Namespace e.g. \'myvendor/myextension\'');
        $this->addArgument('mode', InputArgument::OPTIONAL, 'The mode to set the new directories to. Default is 0751. ( does not apply to Windows )');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $namespace = $this->argument('namespace');

        $pieces = explode('/', $namespace);

        if (count($pieces) !== 2) {
            $output->writeln('Could not parse namespace of ' . implode('/', $pieces));
            $output->writeln('Namespace must be in the form of \'myvendor/myextension\'');
        } else {

            $twig = new TwigUtility($pieces[0], $pieces[1], $this->argument('mode'), $output);

            $twig->render('extension');
            $output->writeln('');
            $output->writeln('Extension created in packages/' . $namespace);
        }
    }
}
