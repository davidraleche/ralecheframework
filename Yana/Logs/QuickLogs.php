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
    /** @var string $quickAuthentication */
    public $quickAuthentication;
    /** @var integer $quickAuthentication */
    public $numberOfRows;
    /** @global integer $quickAuthentication */
    const NUMBERROWSTOBEDISPLAYED = 50;

    /**
     * QuickLogs constructor.
     */
    public function __construct(QuickAuthentication $quickAuthentication)
    {
        $this->conf_error_log = include_once("conf.php");
        $parameters = $this->retrievePostParameters();
        $this->numberOfRows =  $parameters['numberOfRows'];
        $this->executePhpunitValue =  $parameters['executePhpunitValue'];
        if($this->executePhpunitValue === "true")
        {
            $executePhpUnit = new Execute();
            $executePhpUnit->executePhpunit();
        }
        $this->quickAuthentication = $quickAuthentication;
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
        $this->htmlHeader();
        /* If Correct Credentials */
        if ($this->quickAuthentication->ifUserAllowed()) {
            $this->htmlHeaderSignedIn();
            $this->refresh();
            $this->getLogs($this->numberOfRows);
            $this->refresh();
            $this->ByDavidRalecheTrademark();
            return true;
        }
        /* User not allowed */
        $this->quickAuthentication->signin();

        return false;
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
    public function ByDavidRalecheTrademark(){
        ?>
        <div style="display: inline-block">
            <font size="1"><i>by David Raleche</i></font>
        </div>
        <?php
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
        ?>
        <div style="display: inline-block">
            <div style="display: inline-block">
            <form action="index.php?" method="post" name="changerows" id="changerows">
                <input type="hidden" name="user" value="<?= $this->quickAuthentication->getUsername()?>"></input>
                <input type="hidden" name="pass" value="<?= $this->quickAuthentication->getPassword()?>"></input>
                <input type="text" name="text" value="keyword"></input>
                <input type="submit" name="submit" value="Refresh Logs"></input>
                <input type="range" name="numberOfRows" min="10" max="500"
                       oninput='document.getElementById("changerows").submit();'
                       onchange='document.getElementById("changerows").submit();'
                       value="<?php echo isset($this->numberOfRows)? $this->numberOfRows : 10 ?>"
                >10 to 500 rows </input>
            </form>
            </div>
        </div>
        <?php
        $this->quickAuthentication->signout();

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
    public function getLogs(int $numberRowsToBeDisplayed = NUMBERROWSTOBEDISPLAYED) : void
    {
        /* Check if error_log file exists otherwise failover into back demo */
        if(file_exists($this->conf_error_log['error_log_path']))
            $error_log_path = $this->conf_error_log['error_log_path'];
        else
            $error_log_path = $this->conf_error_log['error_log_path_backup'];
        $this->filename = $error_log_path;

        /* See error log file */
        $this->error_log_path = ' Error Log File: '.$error_log_path;
        /* make a html break line */
        echo "<br>";
        /* initialize error log variable to be final display */
        $error_logs = "";
        /* Php mimic unix Tail command */
        $error_logs = $this->tail($numberRowsToBeDisplayed);
        /* convert breakline \n\r to Html <br> tag */
        $error_logs = str_replace("\n","<br>",$error_logs);

        print_r($error_logs);
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
    public function tail(int $lines = 20) : string
    {
        $data = '';
        $fp = fopen($this->filename, "r");
        $block = 4096;
        $max = filesize($this->filename);

        for($len = 0; $len < $max; $len += $block)
        {
            $seekSize = ($max - $len > $block) ? $block : $max - $len;
            fseek($fp, ($len + $seekSize) * -1, SEEK_END);
            $data = fread($fp, $seekSize) . $data;

            if(substr_count($data, "\n") >= $lines + 1)
            {
                /* Make sure that the last line ends with a '\n' */
                if(substr($data, strlen($data)-1, 1) !== "\n") {
                    $data .= "\n";
                }

                preg_match("!(.*?\n){". $lines ."}$!", $data, $match);
                fclose($fp);
                return $match[0];
            }
        }
        fclose($fp);
        return $data;
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
    private function retrievePostParameters() : array
    {
        //Ternary Function
        $numberOfRows = isset($_POST['numberOfRows']) ? $_POST['numberOfRows'] : 50;
        $executePhpunit = isset($_POST['executePhpunitValue']) ? $_POST['executePhpunitValue'] : "false";

        return array( 'numberOfRows' => $numberOfRows, 'executePhpunitValue' => $executePhpunit);
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
                </head>";
        echo "<div style=\"display: inline-block\"><h1><i>QuickLogs - Error Parser </i><font size='2'><i> - version 1.5 </i></font> </h1></div>";

    }
}