<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;

class UsersController extends Controller
{
    use Helpers;

    public function store( Request $request )
    {
        $data = $request->get('data')['attributes'];
        $validator = \Validator::make($data, [
            'email'    => 'required|email|unique:users',
            'name'     => 'required',
            'password' => 'required',
        ]);
        if ( $validator->fails() ) {
            throw new StoreResourceFailedException('Invalid user data', $validator->errors());
        }
        User::create(['email' => $data['email'], 'name' => $data['name'], 'password' => bcrypt($data['password'])]);

        return $this->response->noContent();
    }
}
