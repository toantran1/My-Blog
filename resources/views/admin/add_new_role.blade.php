@extends('admin.admin_layout')
@section('admin_content')
<?php use Illuminate\Support\Facades\Session; ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add New Role
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
                    <form role="form" action="{{URL::to('admin/insert-role')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role name</label>
                            <input type="text" class="form-control" name="role_name" id="" placeholder="Enter role name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">status</label>
                            <select class="form-control input-sm m-bot15" name="status_role">
                                <option value="0">Active</option>
                                <option value="1">Default</option>

                            </select>
                        </div>

                        <button type="submit" name="add_new_role" class="btn btn-info">Add Role</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endSection