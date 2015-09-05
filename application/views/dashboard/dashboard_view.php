<div class="row">

    <div id="dashboard-side" class="panel panel-primary col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel-heading"><strong>Todo</strong></div>
        <div class="panel-body">
            <form id="create_todo" class="form-horizontal" style="padding: 10px;" method="post" action="<?=site_url('api/create_todo')?>">
                <div class="input-group">
                    <input type="text" class="form-control" id="todo_field" name="content" placeholder="Create New Todo Item" />
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-success" value="Create" />
                    </span>
                </div>
            </form>
            <div id="list_todo">
                <span class="ajax-loader-gray"></span>
            </div>
        </div>
    </div>

    <div id="dashboard-main" class="panel panel-default col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel-heading"><strong>Notes</strong></div>
        <div class="panel-body">
            <form id="create_note" class="form-horizontal" style="padding: 10px;" method="post" action="<?=site_url('api/create_note')?>">
                <div class="input-group">
                    <input tabindex="1" class="form-control" id="notes_field" type="text" name="title" placeholder="Note Title" />
                    <span class="input-group-btn">
                        <input tabindex="3" type="submit" class="btn btn-success" value="Create" />
                    </span>
                </div>
                <textarea class="form-control" id="notes_content" tabindex="2" name="content"></textarea>
            </form>
            <div id="list_note">
                <span class="ajax-loader-gray"></span>
            </div>
        </div>
    </div>

</div>
