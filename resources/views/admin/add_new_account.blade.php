@extends('admin.admin_layout')
@section('admin_content')
<?php use Illuminate\Support\Facades\Session; ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add New Account
            </header>
            <div class="panel-body">

                <div class="position-center">
                <?php
                $meassage =  Session::get('message');

                if ($meassage) {
                    echo $meassage ;
                    Session::put('message', null);
                }
                ?>
                    <form role="form" action="{{URL::to('admin/create-account')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full name</label>
                            <input type="text" class="form-control" name="full_name" id="" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" name="email" id="" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="" placeholder="confirm password">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Role</label>
                        @foreach($showRole as $role)
                            <select class="form-control input-sm m-bot15" name="role">
                                <option value="{{$role->user_id}}">{{$role->role_name}}</option>  
                            </select>
                        @endforeach
                        </div>
                       
                        <button type="submit" name="add_category_product" class="btn btn-info">Create account</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endSection