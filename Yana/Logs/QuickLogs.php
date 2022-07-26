<?php
/**
 * Created by PhpStorm.
 * User: david Raleche
 * Date: 3/20/2019
 * Time: 9:01 AM
 */

namespace Yana\Logs;

use Yana\Authentication\QuickAuthentication;
use Yana\Command\ExecutePhpUnit;

// ALWAYS displays any errors and remove mem limit for the error log
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', -1);

/**
 * Class QuickLogs
 *
 * @since     2019-05-10
 * @version   2019-07-01
 *
 * @link      https://packagist.org/packages/yana/dr
 * @reference composer require yana/dr
 *
 * @package   Yana\Logs
 * @author    David Raleche <david@raleche.com>
 * @license   Raleche
 **/
class QuickLogs
{
    /** @global integer $quickAuthentication */
    const NUMBERROWSTOBEDISPLAYED = 50;
    /** @var string $quickAuthentication */
    public $quickAuthentication;
    /** @var integer $quickAuthentication */
    public $numberOfRows;
    /** @var string */
    private string $filename;

    /**
     * QuickLogs constructor.
     * Dependency injection
     * @throws \Exception
     */
    public function __construct(QuickAuthentication $quickAuthentication, ?string $errorLogFile = null)
    {
        if($errorLogFile && file_exists($errorLogFile)) {
            $this->filename = $errorLogFile;
        } else {
            $conf_error_log = include_once("conf.php");

            if (!empty($conf_error_log['error_log_path']) && file_exists($conf_error_log['error_log_path'])) {
                $this->filename = $conf_error_log['error_log_path'];
            }

            elseif(!empty($conf_error_log['error_log_path_backup']) && file_exists($conf_error_log['error_log_path_backup'])) {
                $this->filename = $conf_error_log['error_log_path_backup'];
            }
        }

        if(empty($this->filename)) {
            throw new \Exception("QuickLogs: Config file was not found at {$this->filename}");
        }

        /**
         * Retrieve Post Parameter
         */
        $parameters = $this->retrievePostParameters();
        $this->numberOfRows = $parameters['numberOfRows'];
        $this->searchKeyword = $parameters['searchKeyword'];
        $this->executePhpunitValue = $parameters['executePhpunitValue'];

        /**
         * Execute Shell command Line
         */
        if ($this->executePhpunitValue === "true") {
            $executePhpUnit = new Execute();
            $executePhpUnit->executePhpunit();
        }

        $this->quickAuthentication = $quickAuthentication;
    }

    /**
     * Retrieve Post Parameters
     *
     * @return array
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    private function retrievePostParameters(): array
    {
        //Ternary Function
        $numberOfRows = isset($_POST['numberOfRows']) ? $_POST['numberOfRows'] : 50;
        $searchKeyword = isset($_POST['searchKeyword']) ? $_POST['searchKeyword'] : 'searchKeyword';
        $executePhpunit = isset($_POST['executePhpunitValue']) ? $_POST['executePhpunitValue'] : "false";

        return array(
            'numberOfRows' => $numberOfRows,
            'searchKeyword' => $searchKeyword,
            'executePhpunitValue' => $executePhpunit);
    }

    /**
     * Execute the log retrieval
     *
     * @param String $routeUuid
     *
     * @return bool
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     *
     **/
    public function process(): bool
    {
        /* If Correct Credentials */
        if ($this->quickAuthentication->ifUserAllowed()) {
            $this->runHTML();
            return true;
        }

        /* User not allowed */
        $this->quickAuthentication->signin();

//

        return false;
    }

    /** ===========================
     *
     */
    public function runHTML()
    {
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="David Raleche">
            <meta name="generator" content="Hugo 0.80.0">
            <title>QuickLogs David Raleche</title>
            <!-- Bootstrap core CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .form-range {
                    width: 50%;
                }
                .form-control {
                    width: 50%;
                    display: inline-block;
                }
            </style>
        </head>
        <body>

        <main>
            <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top justify-content-between" aria-label="Second navbar example">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">QuickLogs</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample02">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/swagger">Swagger</a>
                            </li>
                        </ul>

                        <form class="mx-auto" action="index.php?" method="post" name="changerows"
                              id="changerows my-2 my-lg-0 mr-sm-2">
                            <input type="hidden" name="user"
                                   value="<?= $this->quickAuthentication->getUsername() ?>"/>
                            <input type="hidden" name="pass"
                                   value="<?= $this->quickAuthentication->getPassword() ?>"/>
                            <input name="searchKeyword" class="form-control mr-sm-2" type="search"
                                   placeholder="Search"
                                   aria-label="Search">
                            <input   type="submit" class="btn btn-primary my-2" name="submit" value="searchKeyword"></input>
                            <!--                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                        </form>

                        <form action="index.php?" method="post" name="changerows" id="changerows" class="form-horizontal mx-auto  ">
                            <input type="hidden" name="user"
                                   value="<?= $this->quickAuthentication->getUsername() ?>"/>
                            <input type="hidden" name="pass"
                                   value="<?= $this->quickAuthentication->getPassword() ?>"/>

                            <input class="form-range" type="range" name="numberOfRows" min="10" max="500"
                                   oninput='document.getElementById("changerows").submit();'
                                   onchange='document.getElementById("changerows").submit();'
                                   value="<?= $this->numberOfRows ?? 10 ?>"/>

                            <button type="submit" class="btn btn-primary my-2" name="submit" value="Search">Refine</button>
                        </form>

                        <form action="index.php" method="post" class="mx-auto">
                            <input type="hidden" name="user" value=""/>
                            <input type="hidden" name="pass" value=""/>
                            <button class="btn btn-outline-success " type="submit" name="submit" value="Sign Out">Sign Out</button>
                        </form>
                    </div>
                </div>
            </nav>
        </main>
            <div style="padding-top:80px">
                <table class="table table-striped">
                <?php $this->getLogs($this->numberOfRows) ?>
                </table>
            </div>
        </body>
        <?php
    }

    /**
     * Execute Unix command line to retrieve logs
     *
     * @param $error_logs
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function getLogs(int $numberRowsToBeDisplayed = self::NUMBERROWSTOBEDISPLAYED): void
    {
        // get the array of log results
        $error_logs = $this->tail($numberRowsToBeDisplayed);

        // convert logs array into table
        $table = "";
        $count = 0;
        foreach ($error_logs as $line) {
            // remove results without the keyword, if searching
            if ($this->searchKeyword != 'searchKeyword' && !str_contains($line, $this->searchKeyword)) {
                continue;
            }

            $count++;

            // convert into table
            $table .= "
                <tr>
                    <td style='width:0px'><b>$count</b></td>
                    <td>$line</td>
                </tr>";
        }

        // display count & logs
        echo '<p class="mb-2">Displaying <b>' . $count . '</b> results from <i>' . $this->filename . '</i></p>';
        echo $table;
    }

    /**
     *
     * Tail Function mimic in php
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     **/
    public function tail(int $lines = 20): array
    {
        $data = [];

        $file = @file($this->filename);
        for ($i = max(0, count($file) - $lines); $i < count($file); $i++) {
            $data[] = $file[$i];
        }

        return array_reverse($data);
    }
}
