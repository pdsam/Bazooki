<?php
namespace App\Services\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Administrator;

class AdminProvider implements UserProvider {

   // private UserProvider $modProvider;
   // private UserProvider $adminProvider;

    public function __construct($app) {
        $this->modProvider = Auth::createUserProvider('moderator');
        $this->adminProvider = new EloquentUserProvider($app['hash'], Administrator::class);
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier) {
        $mod = $this->modProvider->retrieveById($identifier);

        if (is_null($mod)) {
            return null;
        }

        return $this->adminProvider->retrieveById($mod->id);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token) {
        $mod = $this->modProvider->retrieveByToken($identifier, $token);

        if (is_null($mod)) {
            return null;
        }

        return $this->adminProvider->retrieveById($mod->id);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token) {
        $mod = $this->modProvider->updateRememberToken($user, $token);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) {
        $mod = $this->modProvider->retrieveByCredentials($credentials);

        if (is_null($mod)) {
            return null;
        }

        return $this->adminProvider->retrieveById($mod->id);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials) {
        $mod = $this->modProvider->retrieveById($user->getAuthIdentifier());

        return 
            Hash::check($credentials['password'], $mod->password) 
            && strcmp($credentials['email'], $mod->email) == 0;
    }
}

?>
