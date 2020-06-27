<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Jawaban;
use App\Layanan;
use Gate;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UserExport;
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
    public function export_excel()
    {
        return Excel::download(new UserExport, 'User.xlsx');
    }
    public function status(Request $request)
    {
        $layanan = Layanan::all();
        $jawaban = DB::table('jawaban')
            ->whereDate('created_at', '>', $request->dari)
            ->whereDate('created_at', '<', $request->sampai)
            ->get();
        foreach ($layanan as $layanan) {
            $lay[] = $layanan->id;
        }
        foreach ($jawaban as $jawaban) {
            $a[$jawaban->user_id][] = $jawaban->layanan_id;
        }
        $b = array_keys($a);
        $g = 0;
        foreach ($a as $a) {
            $arr3 = array_diff($lay, $a);
            if (count($arr3) == 0) {
                // $q[] = 1;
                $user = DB::table('users')
                    ->where('id', $b[$g])
                    ->update(['status' => 1]);
            } else {
                // $q[] = 0;
                $user = DB::table('users')
                    ->where('id', $b[$g])
                    ->update(['status' => 0]);
            }
            $g++;
        }
        return redirect('admin/user')->with('users', $user);
    }
}
