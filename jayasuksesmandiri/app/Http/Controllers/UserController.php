<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::all();

        return view('user/index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => 'required',
            'status' => 'required'
        ], [
            'name' => 'Nama Harus Terisi',
            'email.unique' => 'Email Sudah Ada',
            'email' => 'Email Harus Terisi',
            'password' => 'Password Harus Terisi',
            'status' => 'Status Harus Terisi'
        ]);

        $karyawan = new User();
        $karyawan->name = $validateData['name'];
        $karyawan->email = $validateData['email'];
        $karyawan->password = $validateData['password'];
        $karyawan->status = $validateData['status'];
        $karyawan->save();

        return redirect()->route('karyawan.index')->with('info-add', "$karyawan->name berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'required',
            'status' => 'required'
        ], [
            'name.required' => 'Nama harus terisi',
            'email.required' => 'Email harus terisi',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain',
            'password.required' => 'Password harus terisi',
            'status.required' => 'Status harus terisi'
        ]);

        $karyawan = User::find($id);
        $karyawan->name = $validateData['name'];
        $karyawan->email = $validateData['email'];
        $karyawan->password = $validateData['password'];
        $karyawan->status = $validateData['status'];
        $karyawan->save();

        return redirect()->route('karyawan.index')->with('info-update', "Akun $karyawan->name berhasil Diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $karyawan = User::find($id);
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('info-delete', "$karyawan->name berhasil dihapus");
    }
}
