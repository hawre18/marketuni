<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\City;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Province;
use App\User;
use http\Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo ='/profile';

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
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8'],
            'last_name' => ['string'],
            'national_code' => ['required'],
            'phone' => ['required'],
            'gender' => ['required']

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
       return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'last_name'=>$data['lastname'],
            'national_code'=>$data['national_code'],
            'phone'=>$data['phone'],
            'gender'=>$data['gender'],
            'province_id'=>$data['province'],
            'password'=>Hash::make($data['password']),
        ]);
       $address=new Address();
       $address->address=$data->input('address');
       $address->compny=$data->input('company');
       $address->city_id=$data->input('city');
       $address->province_id=$data->input('province');
       $address->post_code=$data->input('post_code');
       $address->user_id=1;
       $address->save();
    }

    public function profile()
    {
        $user=Auth::user();
        return view('frontend.profile.index',compact(['user']));
    }

    public function getAllProvince()
    {
        $provinces=Province::all();
        $response=[
            'provinces'=>$provinces
        ];
        return response()->json($response,200);
    }
    public function getAllCities($provinceId)
    {
        $cities=City::where('province_id',$provinceId)->get();
        $response=[
            'cities'=>$cities
        ];
        return response()->json($response,200);
    }

}
