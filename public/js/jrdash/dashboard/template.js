var Template = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Template Created');
    };
    
    // ------------------------------------------------------------------------
    
    this.todo = function(obj) {
        var output = '';
        if (obj.completed == 1){
            output += '<div id="todo_'+ obj.todo_id +'" class="todo_complete list_items col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        }else {
            output += '<div class="list_items col-lg-12 col-md-12 col-sm-12 col-xs-12" id="todo_'+ obj.todo_id +'">';
        }
        output += '<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 ">';
            output += '<span>' + obj.content + '</span>';
        output += '</div>';
        var data_completed = (obj.completed == 1)? 0: 1;
        var data_text = (obj.completed == 1)? 'data-toggle="tooltip" title="Mark Incomplete"><i class="glyphicon glyphicon-remove"></i>': 'data-toggle="tooltip" title="Mark Complete"><i class="glyphicon glyphicon-ok"></i>';
        output += '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">';
            output += '<a class="todo_update" data-completed="'+data_completed+'" todo_id="' + obj.todo_id + '" href="api/update_todo/" '+data_text+'</a>';
        output += "</div>";
        output += '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">';
            output += '<a data_id="'+ obj.todo_id +'" class="todo_delete" href="api/delete_todo/" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-minus-sign"></i></a>';
        output += '</div>';
        output += '</div>';
        return output;
    };
    
    // ------------------------------------------------------------------------
    
    this.note = function(obj) {
        var output = '';
        output += '<div class="list_items col-lg-12 col-md-12 col-sm-12 col-xs-12" id="note_'+ obj.note_id +'">';
            output += '<div class=" col-lg-9 col-md-9 col-sm-9 col-xs-9">';
                output += '<a class="note_toggle" data-id="'+ obj.note_id +'" id="note_title_'+ obj.note_id +'" href="#">' + obj.title + '</a>';
            output += '</div>';
            output += '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">';
                output += '<a class="update_note_display" note_id="' + obj.note_id + '" href="#" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>';
            output += "</div>";
            output += '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">';
                output += '<a data-toggle="tooltip" title="Delete" data_id="'+ obj.note_id +'" class="note_delete" href="api/delete_note/" ><i class="glyphicon glyphicon-minus-sign"></i></a>';
            output += "</div>";

        output += '</div>';
        output += '<div class="hidden well well-sm" id="note_content_show_'+ obj.note_id +'" ><p><pre id="note_content_'+ obj.note_id +'">' + obj.content + '</pre></p></div>';
        output += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                output += '<div class="note_edit_container" id="note_edit_container_'+ obj.note_id +'"> </div>';
        output += '</div>';

        return output;
    };

    this.note_edit = function(note_id) {
        var output = '';

        output += '<form method="post" class="note_edit_form" action="api/update_note">';
            output += '<div class="input-group">';
            output += '<input type="text" name="title" class="title form-control" />';
            output += '<input type="hidden" class="note_id form-control" name="note_id" value="'+ note_id +'" />';
            output += '<textarea name="content" class="content form-control" ></textarea>';
            output += '<input type="submit" class="note_edit_save btn btn-success" value="Save">';
            output += '<input type="submit" class="note_edit_cancel btn" value="Cancel">';
            output += '</div>';
        output += '</form>';

        return output;
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
