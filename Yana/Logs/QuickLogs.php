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
 * @package   EDDMBundle\controllers
 * @author    David Raleche <davidr@4over.com>
 * @license   Raleche
 * @link      david.raleche.com
 * @since     2019-05-10
 * @reference ECOM
 *
 **/
class QuickLogs
{
    public $quickAuthentication;
    public $numberOfRows;
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
        //If Correct Credentials
        if ($this->quickAuthentication->ifUserAllowed()) {
            $this->htmlHeaderSignedIn();
            $this->refresh();
            $this->getLogs($this->numberOfRows);
            $this->refresh();
            return true;
        }
        // User not allowed
        $this->quickAuthentication->signin();

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
        ?>
        <div style="display: inline-block">
            <div style="display: inline-block">
                <button onclick="autoResfreshFunction();">ReStart auto refresh page</button>
                <button onclick="stopResfreshFunction();">Stop refresh page</button>
            </div>
            <div style="display: inline-block">
            <form action="index.php" method="post" name="changerows" id="changerows">
                <input type="hidden" name="user" value="<?= $this->quickAuthentication->getUsername()?>"></input>
                <input type="hidden" name="pass" value="<?= $this->quickAuthentication->getPassword()?>"></input>
                <input type="submit" name="submit" value="Change rows"></input>
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
    public function getLogs(int $numberRowsToBeDisplayed = NUMBERROWSTOBEDISPLAYED)
    {
        $error_logs = "";
        if(file_exists($this->conf_error_log['error_log_path']))
            $error_log_path = $this->conf_error_log['error_log_path'];
        else
            $error_log_path = $this->conf_error_log['error_log_path_backup'];

        $this->filename = $error_log_path;
        echo $error_log_path."<br>";

        $error_logs = $this->tail($numberRowsToBeDisplayed);
        $error_logs = str_replace("\n","<br>",$error_logs);
        print_r($error_logs);
    }

    /**
     *
     * Tail Function
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
    **/
    public function tail($lines = 20)
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
        echo "<div style=\"display: inline-block\"><h1>QuickLogs</h1></div>";

    }
}