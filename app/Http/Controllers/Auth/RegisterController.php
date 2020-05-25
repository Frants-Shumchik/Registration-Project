<?php

namespace App\Http\Controllers\Auth;

use App\Organization;
use App\OrganizationMembers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/results';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'personalCode' => ['required', 'string', 'min:10', 'max:60'],
            'firstName' => ['required', 'string', 'max:60'],
            'lastName' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        echo "start";
        // secret personal code for creating an organization
        if ($data['personalCode'] === "ADMINISTRATOR_SECRET_CODE") {
            // $organization = new Organization();
            // $organization->name = 'Unnamed organization';
            // $organization->address = 'Undefined address';
            // $organization->save();

            $user = User::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'organization_id' => 1,
                //'organization_id' => $organization->id,
                'role_id' => 1, // Admin role
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            // $organization->admin_id = $user->id;
            // $organization->save();

            return $user;
        }

        $member = OrganizationMembers::where('personal_code', $data['personalCode'])->first();
        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'organization_id' => $member->organization_id,
            'role_id' => 2, // User role
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $member->user_id = $user->id;
        $member->save();

        return $user;
    }
}
