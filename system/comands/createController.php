<?php

namespace System\comands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class createController extends Command
{
    protected $commandName = 'make:controller';
    protected $commandDescription = "Greets Someone";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Who do you want to greet?";

    protected $commandOptionName = "m"; // should be specified like "app:greet John --cap"
    protected $commandOptionDescription = 'If set, it will greet in uppercase letters';

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            )
            ->addOption(
                $this->commandOptionName,
                null,
                InputOption::VALUE_NONE,
                $this->commandOptionDescription
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $controller = $input->getArgument($this->commandArgumentName);

        $create_controller = false;
        $answer             = '';

        if ($controller) {
            $create_controller = true;
        } else {
            $answer = 'ERROR: Missing controller name';
        }

//        if ($input->getOption($this->commandOptionName)) {
//            $create_model = true;
//        }

        if($create_controller) {

            $file    = $this->getControllerPath($controller);
            $content = $this->getControllerContent($controller);

            if( !file_exists($file)) {
                $this->createController($file,$content);
                $answer = "Created $controller controller";
            } else {
                $answer = "ERROR: $controller Controller exist";
            }

        }

        $output->writeln($answer);
        return 0;
    }

    public function createController($file,$content )
    {
        $fp = fopen($file, "w");
        fwrite($fp, $content );
        fclose ($fp);
    }

    public function getControllerPath($controller)
    {
       return "./app/controllers/".$controller.".php";
    }

    public function getControllerContent($controller)
    {
        return '<?php
        
use System\controller\controller;

class '.$controller.' extends controller { 
    
}';
    }
}