<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

use App\Models\Headquarter;
use App\Models\Product;
use App\Rules\Uppercase;
use App\Http\Requests\CreateValidationRequest;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Select * from cars;

        // $cars = Car::all()->toArray();
        // $cars = Car::all();
        $cars = Car::paginate(3);




        //When the user clicked a specific car, it will show the specific car
        // $cars = Car::where('name', '=', 'AUDI')
        //     ->get();

        // $cars = Car::where('name', '=', 'AUDI') 
        //     ->firstOrFail();

        //Get data one by one
        // $cars = Car::chunk(2, function ($cars) {
        //     foreach ($cars as $car) {
        //         print_r($car);
        //     }
        // });

        // dd($cars); 
        //Die Dump

        // var_dump($cars);

        // $cars = json_decode($cars);

        //Query Builder
        // $cars = DB::table('cars')->paginate(4);



        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Usual Way
        // $car = new Car();
        // $car->name = $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');
        // $car->save();

        // $test = $request->all();
        // $test = $request->except('_token');
        // $test = $request->except(['_token', 'name']);
        // $test = $request->only('_token');

        //Has method
        // $test = $request->has('founded');

        // if ($request->has('founded')) {
        //     dd('Founded has been found');
        // }

        //Curent Path

        // dd($request->path());

        // if ($request->is('cars')) {
        //     dd('End point is cars');
        // }

        //Current method
        // if ($request->method('post')) {
        //     dd('Method is post');
        // }


        // dd($test);
        //Create a new Car

        // $request->validated();
        // dd($request->all());


        //Methods we can use on $request
        //guessExtension 
        //getMimeType()
        //store
        //asStore
        //storePublicly()
        //move()
        //getClientOriginalName()
        //getClientMimeType()
        //guessClientExtension()
        //getSize()
        //getError()
        //isValid()

        // $test = $request->file('image')->guessExtension();
        // $test = $request->file('image')->getMimeType();
        // $test = $request->file('image')->guessClientExtension();

        // dd($test);

        $request->validate([
            'name' => 'required|unique:cars',
            'founded' => 'required|integer|min:0,max:2021',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        //Validate Method
        // $request->validate([
        //     'name' => new Uppercase,
        //     'founded' => 'required|date|integer|min:0|max:2021',
        //     'description' => 'required|max:255',
        // ]);

        //Or like 2D array
        // $request->validate([
        //     'name' => ['required'], ['unique:cars'],
        //     'founded' => 'required|date|integer|min:0|max:2021',
        //     'description' => 'required|max:255',
        // ]);

        //If it's valid, it will procees
        //If it's not valid, throw a ValidationException

        $car = Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
        ]);

        //When we use Car::make instead of Car::create, we have to call save method

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);

        $car = Car::find($id);

        $hq = Headquarter::find($id);

        // dd($car->engine);
        // var_dump($car->productionDate);

        // var_dump($hq);

        // var_dump($car->products);

        $products = Product::find($id);

        // print_r($products);
        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        // dd($car);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {
        $request->validated();


        $car = Car::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
            ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  Usual Way
    // public function destroy($id)
    // {
    //     $car = Car::find($id);

    //     $car->delete();

    //     return redirect('/cars');
    // }

    // Better Way
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/cars');
    }
}
