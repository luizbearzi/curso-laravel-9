<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        $users = $this->model
                    ->getUsers(
                        search: $request->search ?? ''
                    );

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
    // forma para mostrar usuário $user = User::where('id', $id)->first();
        if (!$user = User::find($id)) 
            return redirect()->route('users.index');

        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request) // pega todos os dados escritos no novo usuário
    {   
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->image) {
             $data['image'] = $request->image->store('users');
         // ou a de baixo para colocar iamgens
         //    $extension =$request->image->getClientOriginalExtension();
         //   $data['image'] = $request->image->storeAs('users', now() . ".{$extension}");
        }

        $this->model->create($data);
        //$user =  User::create($data);

        return redirect() ->route('users.index');
        
       // abaixo uma opção de cadastro que pode ser usada
       // $user = new User;
       // $user->name = $request->name;
       // $user->email = $request->email;
       // $user->password = $request->password;
       // $user->save();
    }

        public function edit($id)
        {
            if (!$user = User::find($id)) 
            return redirect()->route('users.index'); 

            return view('users.edit', compact('user'));
        }

        public function update(StoreUpdateUserFormRequest $request, $id)
        {
            if (!$user = $this->model->find($id)) 
            return redirect()->route('users.index'); 
            
            $data = $request->only('name', 'email');
            if ($request->password)
                $data['password'] = bcrypt($request->password);

            if ($request->image) {
               if ($user->image && Storage::exists($user->image)) {
                                Storage::delete($user->image);
                }
                $data['image'] = $request->image->store('users');
               }

            $user->update($data);

            return redirect()->route('users.index');

        }

        public function destroy($id)
        {
            if (!$user = User::find($id)) 
            return redirect()->route('users.index');

            $user->delete();

            return redirect()->route('users.index');
        }

}
