@extends('layouts.layout')
@section('content')
<form action="{{route('user.store')}}" method="POST">@csrf
          <fieldset>
                    <legend>InputDataPengguna</legend>
                    <div class="form-group row">
                              <div class="col-md-5">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" name="email" class="form-control" required>
                              </div>
                    </div>
                    <div class="col-md-5">
                              <label for="nama">Nama Lengkap</label>
                              <input id="nama" type="text" name="nama" class="formcontrol" required>
                    </div>
                    </div>
                    <div class="form-group row">
                              <div class="col-md-5">
                                        <label for="roles">Roles</label>
                                        <select id="roles" name="roles[]" class="form-control" required>
                                                  <option value="">--PilihRoles--</option>
                                                  <option value="admin">Admin</option>
                                                  <option value="user">User</option>
                                        </select>
                              </div>
                              <div class="form-group row">
                                        <div class="col-md-5">
                                                  <label for="passw">Password</label>
                                                  <input id="passw" type="password" name="passw" class="formcontrol" required>
                                        </div>
                              </div>
                              <div class="col-md-10">
                                        <input type="submit" class="btn btn-success btn-send" value="Simpan">
                                        <input type="Button" class="btn btn-primary btn-send" value="Kembali" onclick="history.go(-1)">
                              </div>
                              <hr>
          </fieldset>
</form>
@endsection