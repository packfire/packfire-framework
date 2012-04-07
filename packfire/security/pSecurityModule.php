<?php
pload('packfire.ioc.pBucketUser');
pload('ISecurityModule');

/**
 * The default security module
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package packfire.security
 * @since 1.0-sofia
 */
class pSecurityModule extends pBucketUser implements ISecurityModule {
    
    /**
     * Authenticate the user
     * @param mixed $token The authentication token
     * @return boolean Returns true if the user is authenticated, false otherwise.
     * @since 1.0-sofia
     */
    public function authenticate($token) {
        return true;
    }

    /**
     * Authorize the user to access a route
     * @param pRoute $route The route to check authorization
     * @return boolean Returns true if the user is authorized to access the route,
     *                 false otherwise.
     * @since 1.0-sofia
     */
    public function authorize($route) {
        return true;
    }

    /**
     * Retrieve the identity of the user
     * @param mixed $newIdentity (optional) The new identity in the session.
     * @return mixed Returns the identity of the user
     * @since 1.0-sofia
     */
    public function identity($newIdentity = null) {
        return $newIdentity;
    }
    
    /**
     * Deauthenticate the user
     * @since 1.0-sofia 
     */
    public function deauthenticate(){
        $this->identity(null);
    }
    
}