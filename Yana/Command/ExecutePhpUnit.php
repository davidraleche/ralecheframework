<?php

namespace Yana\Command;

/**
 * Class ExecutePhpUnit
 *
 * @package App\Command
 *
 * @author David Raleche
 */
class ExecutePhpUnit
{
    /**
     * ExecutePhpUnit constructor.
     */
    public function __construct()
    {
        error_log('Start PhpUnit Test');
    }

    /**
     *
     */
    public function executePhpunit()
    {
         $cmd = ""
             .__DIR__."/../../vendor/bin/phpunit "
             ." --testdox-html ".__DIR__."/../../web/phpunit/agile-phpunit.html "
             ." --coverage-html ".__DIR__."/../../web/phpunit/ "
             ." -c ".__DIR__."/../../phpunit.xml";

        // $cmd = __DIR__."/./executePhpUnit.sh";

         error_log($cmd);
        $output = shell_exec($cmd);
        error_log($output . 'END PhpUnit ');
    }
}
