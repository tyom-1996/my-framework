<?php

namespace System\comands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class deleteController extends Command
{
    protected $commandName = 'delete:controller';
    protected $commandDescription = "Greets Someone";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Who do you want to greet?";

    protected $commandOptionName = "m";
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

        $delete_controller = false;
        $answer            = '';

        if ($controller) {
            $delete_controller = true;
        } else {
            $answer = 'ERROR: Missing controller name';
        }

        if($delete_controller) {

            $file = $this->getControllerPath($controller);

            if(file_exists($file)) {

                $del_status = $this->deleteController($file);
                $answer     = $del_status == false ? "$controller controller cannot be deleted due to an error" : "Deleted $controller controller"; ;

            } else {
                $answer = "ERROR: $controller Controller not exist";
            }

        }

        $output->writeln($answer);
        return 0;
    }



    public function getControllerPath($controller)
    {
        return "./".APP_CONF['app_path']."controllers/".$controller.".php";
    }

    public function deleteController($file)
    {
       return unlink($file);
    }

}