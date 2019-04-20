<?php

namespace particleflux\PMConnection;

interface PMConnectionInterface
{
    /**
     * Get the password of an account
     *
     * @param string $account The account to get the password, e.g. 'facebook'
     * @return string The password
     */
    public function getPassword(string $account) : string;

    /**
     * Get the username of an account
     *
     * @param string $account The account to get the username, e.g. 'facebook'
     * @return string The username
     */
    public function getUser(string $account) : string;

    /**
     * Get an extra attribute of an account
     *
     * Most password managers allow to store additional attributes (not only
     * username and password), for example an email.
     *
     * @param string $account The account to get the attribute, e.g. 'facebook'
     * @param string $attribute The attribute to get
     * @return string The attribute value
     */
    public function getAttribute(string $account, string $attribute) : string;
}
