### **Laravel Packages**

#### **What is Laravel Packages?**
Packages are the primary way of adding functionality to Laravel.
There are different types of packages. Some packages are stand-alone, meaning they work with any PHP framework. Carbon and Behat are examples of stand-alone packages.
Any of these packages may be used with Laravel by requesting them in your composer.json file.

On the other hand, other packages are specifically intended for use with Laravel. These packages may have routes, controllers, views, and configuration specifically intended to enhance a Laravel application.


#### **How to implement Package?**
First, we will create laravel project by below command.

`composer create-project laravel/laravel LaraPackage`

And we will create `packages` folder. In that, let’s call our package `larapack/custdetail` – then we need to create a folder inside our `/packages`.
Then inside of it we need to create another folder called `/src`.

Laravel package needs composer file which contains information about the package itself.
So we go to our `custdetail` folder and run this command:

`composer init`

By run this command, you will get a list of questions to fill-in your future composer.json file.
you need to answer it one by one. and don't worry if skipped something. it will be editable. you can change it later.
you will end up with something like this generated:

    {
        "name": "larapack/custdetail",
        "description": "Laravel Package Demo",
        "authors": [
            {
                "name": "Hiral Chudasama",
                "email": "info@mobiosolutions.com"
            }
        ],
        "minimum-stability": "dev",
        "require": {}
    }
    
Now, we will make our package visible to main laravel, and assign aliases to it and we will add below code to composer.json file of main laravel project.

    "repositories": [
            {
                "type": "path",
                "url": "packages/larapack/custdetail/src",
                "options": {
                    "symlink": true
                }
            }
        ],
        "require": {
            // ...
            "larapack/custdetail": "dev-master"
        },
    
    "autoload": {
            "psr-4": {
                "App\\": "app/",
                "Larapack\\Custdetail\\": "packages/larapack/custdetail/src"
            },

And then we run this command from main folder:

`composer update`

Now, we will create service provider. Service Provider is a Class which would contain main information about package – what Controllers does it use,
what Routes file or Views to load etc. You can look at it as a set of rules for the package. we will create service provider by below command.

`php artisan make:provider CustDetailServiceProvider`

It will generate a file called `CustDetailServiceProvider.php` in folder `app/Providers` – then we have to move that file to our folder `/packages/larapack/custdetail/src`.
After that don’t forget to change the namespace of the Provider class – it should be the same as we specified in main `composer.json` file – in our case, `Larapack\Custdetail`.

Here we need to add below code into our package’s composer.json:

    "extra": {
            "laravel": {
                "providers": [
                    "Larapack\\Custdetail\\CustDetailServiceProvider"
                ]
            }
        }
        
Now, we will create controller file by below command:

`php artisan make:controller CustDetailController`      

Now, we will add authentication in our code by below commands:

`composer require laravel/ui --dev`

`php artisan ui bootstrap --auth`

and make customers table by below command:

`php artisan make:migration create_customers_table`

`php artisan migrate`

Now, we will make blade file like below:

    @extends('layouts.app')
    
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>
    
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
    
                            You are logged in!
                            <br>
                            Add Customer Here!
    
                                <form action="/postCustomer" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" for="title">Name</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" for="address">Address</label>
                                        <div class="col-md-6">
                                            <textarea cols="30" class="form-control" rows="4" name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" for="mobiltno">Mobile no</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mobileno">
                                        </div>
                                    </div>
    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <input type="submit" name="submit">
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    
Now, we will update index function of Home controller in that, we will update view page. We will show `addCustomer.blade.php` file instead of `home.blade.php` file.

 
    public function index()
    {
        return view('customers.addCustomer');
    }
    
By this, we will redirect to `addCustomer` page.

Now, we will add customer by package.

We will make one function in `CustDetailController.php` file. Like below,

    public function postCustomer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobileno' => 'required|numeric|digits:10',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->messages()->first());
            Session::flash('alert-class', 'alert-danger');
            return redirect('/home');
        }
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobileno = $request->mobileno;
        $customer->address = $request->address;
        $customer->save();
        
        Session::flash('message', 'Customer added successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('home');
    }
    
Now, our package is ready to use. So, we will run below command in terminal:

`php artisan server`

And run URL to browser.
    

