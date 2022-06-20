@extends('admin.admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Task List
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table id="datatable" class="table table-striped b-t b-light">
        <thead>
          <tr>
            <!-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> -->
            <th>ID</th>
            <th>Task name</th>
            <th>Code task</th>
            <th>Assign</th>
            <th style="width:10px;"></th>
          </tr>
        </thead>
        <tbody>

          @foreach($showToDoList as $showList)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td class="id">{{$showList->id}}</td>
            <td class="taskName" >{{$showList->task_name}}</td>
            <td class="codeTask">{{$showList->code_task}}</td>
            <td class="Assign_name" data-id-user="{{$showList->assign}}">{{$showList->name}}</td>
          
            <td>
            <a href="" data-toggle="modal" data-target="#edit-tasks" class="btn_edit" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a href="{{route('task.delete', ['id' => $showList->id])}}" class="active"  ui-toggle-class=""><i class="fa fa-trash text-danger text"></i></a>
            </td>
          </tr>
          @endforeach

          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-tasks" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                  <h4 class="modal-title">Edit Task</h4>
                </div>
                <div class="modal-body">

                  <form role="form">
                    <div class="form-group">
                    <input type="hidden" id="id" value="" />
                      <label for="exampleInputEmail1">Name task</label>

                      <input type="text" class="form-control" id="nameTask" placeholder="">
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Assign</label>
                        <!-- {{dump($showToDoList)}} -->
                        <!-- {{dump($showUser)}} -->
                      <select class="form-control input-sm m-bot15" id="assign_name" name="assign" >
                        @foreach($showUser as $user)  
                            <option  value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>

                    </div>
                    <button type="submit" id="submit" class="btn btn-default">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
      <script>
        $(document).on('click','.btn_edit',function(){
            console.log('opened');
            var data= $(this).parents('tr');
            $('#id').val(data.find('.id').text());
            $('#nameTask').val(data.find('.taskName').text());
            $('#assign_name').val(data.find('.Assign_name').attr('data-id-user'));
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#datatable').Datatable({
                select:true
            });
        });
    </script>
    </footer>
  </div>
</div>
@endSection
