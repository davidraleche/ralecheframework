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

    /**
     * QuickLogs constructor.
     * Dependency injection
     */
    public function __construct(QuickAuthentication $quickAuthentication)
    {
        $this->conf_error_log = include_once("conf.php");

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
     * Sprout Text - By david Raleche
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
    public function ByDavidRalecheTrademark()
    {
        ?>
        <div style="display: inline-block">
            <font size="1"><i>by David Raleche</i></font>
        </div>
        <?php
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
//            $this->htmlHeader();
//            $this->htmlHeaderSignedIn();
 //           $this->refresh();
//            $this->getLogs($this->numberOfRows);
//            $this->refresh();
//            $this->ByDavidRalecheTrademark();


            $this->runHTML();
            return true;
        }
        /* User not allowed */
        $this->quickAuthentication->signin();

//

        return false;
    }

    /**
     * Refresh Page
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function refresh(): void
    {
        //  $this->quickAuthentication->signout();
        ?>
<!--        <div>-->
<!---->
<!---->
<!--        </div>-->
        <?php


//            <form action="index.php?" method="post" name="changerows" id="changerows">
        /*                <input type="hidden" name="user" value="<?= $this->quickAuthentication->getUsername() ?>"></input>*/
        /*                <input type="hidden" name="pass" value="<?= $this->quickAuthentication->getPassword() ?>"></input>*/
//
//                <input type="submit" name="submit" value="Refresh Logs"></input>
//                <input type="range" name="numberOfRows" min="10" max="500"
//                       oninput='document.getElementById("changerows").submit();'
//                       onchange='document.getElementById("changerows").submit();'
        /*                       value="<?php echo isset($this->numberOfRows) ? $this->numberOfRows : 10 ?>"*/
//                >10 to 500 rows </input>
//                <input type="submit" name="submit" value="Search"></input>
//            </form>

//            <form action="index.php?" method="post" name="changerows" id="changerows">
        /*                <input type="hidden" name="user" value="<?= $this->quickAuthentication->getUsername() ?>"></input>*/
        /*                <input type="hidden" name="pass" value="<?= $this->quickAuthentication->getPassword() ?>"></input>*/
//                <input type="text" name="searchKeyword" value=""></input>
//                <input type="submit" name="submit" value="searchKeyword"></input>
//            </form>
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
            <link href="bootstrap.min.css" rel="stylesheet">
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
                                   value="<?= $this->quickAuthentication->getUsername() ?>"></input>
                            <input type="hidden" name="pass"
                                   value="<?= $this->quickAuthentication->getPassword() ?>"></input>
                            <input name="searchKeyword" class="form-control mr-sm-2" type="search"
                                   placeholder="Search"
                                   aria-label="Search">
                            <input   type="submit" class="btn btn-primary my-2" name="submit" value="searchKeyword"></input>
                            <!--                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                        </form>

                        <form action="index.php?" method="post" name="changerows" id="changerows" class="form-horizontal mx-auto  ">
                            <input type="hidden" name="user"
                                   value="<?= $this->quickAuthentication->getUsername() ?>"></input>
                            <input type="hidden" name="pass"
                                   value="<?= $this->quickAuthentication->getPassword() ?>"></input>

                            <input class="form-range" type="range" name="numberOfRows" min="10" max="500"
                                   oninput='document.getElementById("changerows").submit();'
                                   onchange='document.getElementById("changerows").submit();'
                                   value="<?php echo isset($this->numberOfRows) ? $this->numberOfRows : 10 ?>"
                            > </input>
                            <button type="submit" class="btn btn-primary my-2" name="submit" value="Search">Refine</button>
                        </form>



                            <form action="index.php" method="post" class="mx-auto">
                                <input type="hidden" name="user" value=""></input>
                                <input type="hidden" name="pass" value=""></input>
                                <button class="btn btn-outline-success " type="submit" name="submit" value="Sign Out">Sign Out</button>
                            </form>

                    </div>
                </div>


            </nav>
        </main>
            <div style="padding-left:15px">
                <br><br><br><br><br>
                <table class="table table-striped">
                <?php
                $this->getLogs($this->numberOfRows);
                ?>
                </table>
            </div>

        
        <script type="application/javascript">
            window.scrollTo(0,document.body.scrollHeight);
        </script>


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
    public function getLogs(int $numberRowsToBeDisplayed = NUMBERROWSTOBEDISPLAYED): void
    {
        /* Check if error_log file exists otherwise failover into back demo */
        if (file_exists($this->conf_error_log['error_log_path']))
            $error_log_path = $this->conf_error_log['error_log_path'];
        else
            $error_log_path = $this->conf_error_log['error_log_path_backup'];
        $this->filename = $error_log_path;

        /* See error log file */
        $this->error_log_path = ' Error Log File: ' . $error_log_path;
        /* make a html break line */

        /* initialize error log variable to be final display */
        $error_logs = "";


        if ($this->searchKeyword == 'searchKeyword') {
            /* Php mimic unix Tail command */
            $error_logs = $this->tail($numberRowsToBeDisplayed);
        } else {
            $error_logs = $this->searchkeyword($numberRowsToBeDisplayed, $this->searchKeyword);
        }


        echo "<tr><td>";
        /* convert breakline \n\r to Html <br> tag */
        $error_logs = str_replace("\n", "</td></tr><tr><td>", $error_logs);

        print_r($error_logs);
        echo "</td></tr>";
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
    public function tail(int $lines = 20): string
    {
        $data = '';
        $fp = fopen($this->filename, "r");
        $block = 4096;
        $max = filesize($this->filename);

        for ($len = 0; $len < $max; $len += $block) {
            $seekSize = ($max - $len > $block) ? $block : $max - $len;
            fseek($fp, ($len + $seekSize) * -1, SEEK_END);
            $data = fread($fp, $seekSize) . $data;

            if (substr_count($data, "\n") >= $lines + 1) {
                /* Make sure that the last line ends with a '\n' */
                if (substr($data, strlen($data) - 1, 1) !== "\n") {
                    $data .= "\n";
                }

                preg_match("!(.*?\n){" . $lines . "}$!", $data, $match);
                fclose($fp);
                return $match[0];
            }
        }
        fclose($fp);
        return $data;
    }

    /**
     *
     * searchkeyword
     *
     * @param string $searchKeyword
     *
     * @return string $data
     *
     * @throws  \Exception $exception
     *
     * @author David Raleche
     * @version Feb 26 2021
     *
     */
    public function searchkeyword(int $lines = 120, string $searchKeyword)
    {
        $lines = 1000;
        echo "<b>String Searched</b> <font color='red'>" . $searchKeyword . "</font><br>";


        $data = '';
        $fp = fopen($this->filename, "r");
        $block = 4096;
        $max = filesize($this->filename);

        for ($len = 0; $len < $max; $len += $block) {
            $seekSize = ($max - $len > $block) ? $block : $max - $len;
            fseek($fp, ($len + $seekSize) * -1, SEEK_END);
            $data = fread($fp, $seekSize) . $data;

            if (substr_count($data, "\n") >= $lines + 1) {
                /* Make sure that the last line ends with a '\n' */
                if (substr($data, strlen($data) - 1, 1) !== "\n") {
                    $data .= "\n";
                }

                // var_dump($data);
                preg_match_all("/$searchKeyword(.*)/", $data, $match);
                //   var_dump($match);
                fclose($fp);
                return $match[0];
            }
        }
        fclose($fp);
        //  return $data;
    }

    /**
     * Html Header
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    private function htmlHeader()
    {
        echo "<head>
                <title>QuickLogs - David Raleche</title>
                 <meta name=\"author\" content=\"David Raleche\">
                </head>
    
                ";
        echo "<div style=\"display: inline-block\"><h1><i>QuickLogs - Error Parser </i><font size='2'><i> - version 1.5 </i></font> </h1></div>";

    }

    /**
     * Html Header SignedIn
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    private function htmlHeaderSignedIn()
    {
        echo "<script>";
        ?>
        var myVar;

        console.log('Auto Refresh Active maVar'+JSON.stringify(myVar));
        myVar = setTimeout(function () {
        window.location.reload();
        }, 49999861776383 );

        function autoResfreshFunction(){
        myVar = setTimeout(function () {
        window.location.reload();
        }, 3000);
        alert('Auto Refresh Restarted');
        }

        function stopResfreshFunction() {
        myVar = clearTimeout(myVar);
        console.log('refresh stopped '+JSON.stringify(myVar));
        alert('Auto Refresh stopped');
        }
        <?php
        echo "</script>";
    }

}
