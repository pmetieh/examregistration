@extends('layouts.adminmaster', array('pageTitle' => 'Delete Role'))

@section('content')
    <div id="main" class="row">
        <form class="form form-horizontal" id="deleterole" name="deleterole" method="post" action="deleterole">
            {{csrf_field()}}
            <h1>Delete A Role</h1>
            <div class="form-group">
                <div class=" col-lg-6">
                    <label class="control-label" for="rolename" >Role Name</label>
                </div>
                <div class=" col-lg-6">
                    <select class="form-control" name="rolename" id="rolename">
                        <?php
                          $roles = DB::table('roles')->get();

                        //dd($roles);
                        foreach($roles as $role)
                        {
                            echo '<option value="'.$role->id.'">'.$role->name.'</p>';
                        }
                        ?>
                    </select>

                </div>
            </div>
            <div class="col-lg-6">
                <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Delete Role</button>
            </div>
            <div class="col-lg-6">
                <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
            </div>
        </form>
<script>
    $(function(){
      ///  alert('jQuery');
        $('#deleterole').submit(function(){

            var id = $('#rolename').val();
         //   alert('deleterole/'+'{'+id+'}');
            $(this).attr('action', 'deleterole/'+id);
        //    alert($(this).attr('action'));
           // return false;
        });


    })
</script>
    </div>

@endsection