<?php

namespace Yana\Authentication;

/**
 * Class QuickAuthentication
 *
 * @link      https://packagist.org/packages/yana/dr
 * @reference composer require yana/dr
 *
 * @package   Yana\Logs
 * @author    David Raleche <david@raleche.com>
 * @license   Raleche
 **/
class QuickAuthentication
{
    /**
     * User variable to be set from POST
     *
     * @var
     */
    private $username;

    /**
     * Password variable
     *
     * @var
     */
    private $password;
    public $usersAllowedArray;

    /**
     * QuickAuthentication constructor.
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function __construct(array $usersAllowed = null)
    {
        if(!isset($usersAllowed))
            $usersAllowed = include_once("conf.php");

        $this->usersAllowedArray = $usersAllowed;
        $parameters = $this->retrievePostParameters();
        $this->username = $parameters['username'];
        $this->password = $parameters['password'];
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
        /* Ternary Function */
        $user = isset($_POST['user']) ? $_POST['user'] : null;
        $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

        return array('username' => $user, 'password' => $pass);
    }



    /**
     * Verify if user allowed
     *
     * @return bool
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function ifUserAllowed(): bool
    {
        if (array_key_exists($this->username, $this->usersAllowedArray)
            && $this->usersAllowedArray[$this->username] === $this->getPassword()) {
            return true;
        }
        return false;
    }

    /**
     * Signout alows you to signout of logging page
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function signout(): void
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

        </head>
        <body>

        <main>




            <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top justify-content-between" aria-label="Second navbar example">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Swagger</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample02">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/log">QuickLogs</a>
                            </li>
                        </ul>



                        <form action="index.php" method="post" class="mx-auto">
                            <input type="hidden" name="user" value=""></input>
                            <input type="hidden" name="pass" value=""></input>
                            <button class="btn btn-outline-success " type="submit" name="submit" value="Sign Out">Sign Out</button>
                        </form>

                    </div>
                </div>


            </nav>
        </main>
        <?php
    }

    /**
     * Get User
     *
     * @return mixed
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * setUser Entity
     *
     * @param mixed $username
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * get Password of user
     *
     * @return mixed
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * SetPassword
     *
     * @param mixed $password
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * Signin including html elements
     *
     * @return bool
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     */
    public function signin(): void
    {
        ?>
               <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">

        <title>David Raleche - QuickLogs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style>

        input[type=password] {

        background-color: #f6f6f6;

        border: none;

        color: #0d0d0d;

        padding: 15px 32px;

        text-align: center;

        text-decoration: none;

        display: inline-block;

        font-size: 16px;

        margin: 5px;

        width: 85%;

        border: 2px solid #f6f6f6;

        -webkit-transition: all 0.5s ease-in-out;

        -moz-transition: all 0.5s ease-in-out;

        -ms-transition: all 0.5s ease-in-out;

        -o-transition: all 0.5s ease-in-out;

        transition: all 0.5s ease-in-out;

        -webkit-border-radius: 5px 5px 5px 5px;

        border-radius: 5px 5px 5px 5px;

        }

        input[type=password]:focus {

        background-color: #fff;

        border-bottom: 2px solid #5fbae9;

        }

        input[type=password]:placeholder {

        color: #cccccc;

        }

        </style>
        <style type="text/css">

            /* BASIC */

            html {
                background-color: #56baed;
            }

            body {
                font-family: "Poppins", sans-serif;
                height: 100vh;
            }

            a {
                color: #92badd;
                display:inline-block;
                text-decoration: none;
                font-weight: 400;
            }

            h2 {
                text-align: center;
                font-size: 16px;
                font-weight: 600;
                text-transform: uppercase;
                display:inline-block;
                margin: 40px 8px 10px 8px;
                color: #cccccc;
            }



            /* STRUCTURE */

            .wrapper {
                display: flex;
                align-items: center;
                flex-direction: column;
                justify-content: center;
                width: 100%;
                min-height: 100%;
                padding: 20px;
            }

            #formContent {
                -webkit-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
                background: #fff;
                padding: 30px;
                width: 90%;
                max-width: 450px;
                position: relative;
                padding: 0px;
                -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
                box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
                text-align: center;
            }

            #formFooter {
                background-color: #f6f6f6;
                border-top: 1px solid #dce8f1;
                padding: 25px;
                text-align: center;
                -webkit-border-radius: 0 0 10px 10px;
                border-radius: 0 0 10px 10px;
            }



            /* TABS */

            h2.inactive {
                color: #cccccc;
            }

            h2.active {
                color: #0d0d0d;
                border-bottom: 2px solid #5fbae9;
            }



            /* FORM TYPOGRAPHY*/

            input[type=button], input[type=submit], input[type=reset]  {
                background-color: #56baed;
                border: none;
                color: white;
                padding: 15px 80px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                text-transform: uppercase;
                font-size: 13px;
                -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
                box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
                -webkit-border-radius: 5px 5px 5px 5px;
                border-radius: 5px 5px 5px 5px;
                margin: 5px 20px 40px 20px;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }

            input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
                background-color: #39ace7;
            }

            input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
                -moz-transform: scale(0.95);
                -webkit-transform: scale(0.95);
                -o-transform: scale(0.95);
                -ms-transform: scale(0.95);
                transform: scale(0.95);
            }

            input[type=text] {
                background-color: #f6f6f6;
                border: none;
                color: #0d0d0d;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 5px;
                width: 85%;
                border: 2px solid #f6f6f6;
                -webkit-transition: all 0.5s ease-in-out;
                -moz-transition: all 0.5s ease-in-out;
                -ms-transition: all 0.5s ease-in-out;
                -o-transition: all 0.5s ease-in-out;
                transition: all 0.5s ease-in-out;
                -webkit-border-radius: 5px 5px 5px 5px;
                border-radius: 5px 5px 5px 5px;
            }

            input[type=text]:focus {
                background-color: #fff;
                border-bottom: 2px solid #5fbae9;
            }

            input[type=text]:placeholder {
                color: #cccccc;
            }



            /* ANIMATIONS */

            /* Simple CSS3 Fade-in-down Animation */
            .fadeInDown {
                -webkit-animation-name: fadeInDown;
                animation-name: fadeInDown;
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
            }

            @-webkit-keyframes fadeInDown {
                0% {
                    opacity: 0;
                    -webkit-transform: translate3d(0, -100%, 0);
                    transform: translate3d(0, -100%, 0);
                }
                100% {
                    opacity: 1;
                    -webkit-transform: none;
                    transform: none;
                }
            }

            @keyframes fadeInDown {
                0% {
                    opacity: 0;
                    -webkit-transform: translate3d(0, -100%, 0);
                    transform: translate3d(0, -100%, 0);
                }
                100% {
                    opacity: 1;
                    -webkit-transform: none;
                    transform: none;
                }
            }

            /* Simple CSS3 Fade-in Animation */
            @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
            @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

            .fadeIn {
                opacity:0;
                -webkit-animation:fadeIn ease-in 1;
                -moz-animation:fadeIn ease-in 1;
                animation:fadeIn ease-in 1;

                -webkit-animation-fill-mode:forwards;
                -moz-animation-fill-mode:forwards;
                animation-fill-mode:forwards;

                -webkit-animation-duration:1s;
                -moz-animation-duration:1s;
                animation-duration:1s;
            }

            .fadeIn.first {
                -webkit-animation-delay: 0.4s;
                -moz-animation-delay: 0.4s;
                animation-delay: 0.4s;
            }

            .fadeIn.second {
                -webkit-animation-delay: 0.6s;
                -moz-animation-delay: 0.6s;
                animation-delay: 0.6s;
            }

            .fadeIn.third {
                -webkit-animation-delay: 0.8s;
                -moz-animation-delay: 0.8s;
                animation-delay: 0.8s;
            }

            .fadeIn.fourth {
                -webkit-animation-delay: 1s;
                -moz-animation-delay: 1s;
                animation-delay: 1s;
            }

            /* Simple CSS3 Fade-in Animation */
            .underlineHover:after {
                display: block;
                left: 0;
                bottom: -10px;
                width: 0;
                height: 2px;
                background-color: #56baed;
                content: "";
                transition: width 0.2s;
            }

            .underlineHover:hover {
                color: #0d0d0d;
            }

            .underlineHover:hover:after{
                width: 100%;
            }



            /* OTHERS */

            *:focus {
                outline: none;
            }

            #icon {
                width:60%;
            }
        </style>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            window.alert = function(){};
            var defaultCSS = document.getElementById('bootstrap-css');
            function changeCSS(css){
                if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
                else $('head > link').filter(':first').replaceWith(defaultCSS);
            }
            $( document ).ready(function() {
                var iframe_height = parseInt($('html').height());
                window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
            });
        </script>
    </head>
    <body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <h1 class="display-6 text-muted">QuickAuth </h1>
            </div>

            <!-- Login Form -->
              <form method="POST" action="index.php">
                <input type="text" id="login" class="fadeIn second" name="user" placeholder="login">
                <input type="password" id="password" class="fadeIn third" name="pass" placeholder="password">
                <input type="submit" class="fadeIn fourth"  name="submit"value="Log In">
            </form>

        </div>
    </div>	<script type="text/javascript">
    </script>
    </body>
    </html>



<!--        <form method="POST" action="index.php">-->
<!--            User <input type="text" name="user"></input><br/>-->
<!--            Pass <input type="password" name="pass"></input><br/>-->
<!--            <input type="submit" name="submit" value="Go"></input>-->
<!--        </form>-->
        <?php
    }
}
