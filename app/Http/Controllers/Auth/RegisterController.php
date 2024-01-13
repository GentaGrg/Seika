<?php

namespace Laravel\Ui\Auth;

use Illuminate\Foundation\Auth\RegistersUsers as BaseRegistersUsers;

trait RegistersUsers
{
    use BaseRegistersUsers {
        redirectPath as baseRedirectPath;
    }

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : $this->baseRedirectPath();
    }
}
