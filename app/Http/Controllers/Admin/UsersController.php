<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Jawaban;
use App\Layanan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();

        return view('admin.users.create', [
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->roles()->sync($request->roles);

        return redirect('admin/user')->with('success', 'User ' . $user->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('edit-users')) {
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'role' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->save()) {
            return redirect('admin/user')->with('warning', 'User ' . $request->name . ' berhasil di ubah');
        } else {
            $request->session()->flash('errorr', 'There was an error updating the user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('edit-users')) {
            return redirect('admin/user');
        }
        $user->roles()->detach();
        $user->delete();
        return redirect('admin/user')->with('errorr', 'User ' . $user->name . ' berhasil dihapus');
    }
    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_siswa', $nama_file);

        // import data
        Excel::import(new UserImport, public_path('/file_siswa/' . $nama_file));

        // notifikasi dengan session
        Session::flash('sukses', 'Data Siswa Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('admin/user');
    }
    public function status(Request $request)
    {
        // menangkap data pengecekan
        $cek = $request->cek;

        // mengambil data dari table pegawai sesuai pencarian data
        $user = DB::table('user')
            ->where('name', 'like', "%" . $cek . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return view('index', ['pegawai' => $pegawai]);

        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $jawaban = Jawaban::all();
        $layanan = Layanan::all();
        $a = $layanan->id->collect();
        foreach ($user as $user) {
            if ($jawaban->user_id->contains('layanan_id', $a)) {
                //bakal post 1 status di user_id
                return redirect('admin/user')->with('warning', 'User ' . $request->name . ' berhasil di ubah');
            } else {
                //bakal post 0 status di user_id
                $request->session()->flash('errorr', 'There was an error updating the user');
            }
        }
    }
}
