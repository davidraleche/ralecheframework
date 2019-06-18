<?php

namespace Yana\Authentication;

/**
 * Class QuickAuthentication
 *
 * @author    David Raleche
 * @link      david.raleche.com
 *
 * @since     2019-05-10
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
        //Ternary Function
        $user = isset($_POST['user']) ? $_POST['user'] : null;
        $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

        return array('username' => $user, 'password' => $pass);
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
        <form method="POST" action="index.php">
            User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
        </form>
        <?php
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
        <div style="display: inline-block">
            <form action="index.php" method="post">
                <input type="hidden" name="user" value=""></input>
                <input type="hidden" name="pass" value=""></input>
                <input type="submit" name="submit" value="Sign Out"></input>
            </form>
        </div>
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

}