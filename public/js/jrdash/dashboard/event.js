var Event = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Event Created');
        Result = new Result();
        create_todo();
        create_note();
        update_todo();
        update_note();
        delete_todo();
        delete_note();
        update_note_display();
        note_toggle();
    };
    
    // ------------------------------------------------------------------------
    
    var create_todo = function() {
        $("#create_todo").submit(function(evt) {
            console.log('create_todo clicked');
            evt.preventDefault();

            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function(o){
                if(o.result === 1){
                    Result.success('Added in To-do list');
                    var output = Template.todo(o.new_entry[0]);
                    $('#list_todo').append(output).slideDown('slow');
                    $('#todo_field').val('');
                }else {
                    Result.error(o);
                    $('#todo_field').val('');
                }
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var create_note = function() {
        $("#create_note").submit(function(evt) {
            console.log('create_note clicked');
            evt.preventDefault();

            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function(o){
                if(o.result == 1){
                    Result.success('Added in Note list');
                    var output = Template.note(o.new_entry[0]);
                    $('#list_note').append(output);
                    $('#notes_field').val('');
                    $('#notes_content').val('');
                }else {
                    Result.error(o);
                }
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var update_todo = function() {
        $('body').on('click','.todo_update', function(evt){
            evt.preventDefault();
            $(this).blur();
            $(this).tooltip('hide');
            $(this).css('outline:none;')
            var self = $(this);
            var url = $(this).attr('href');
            var postData = {
                todo_id: $(this).attr('todo_id'),
                completed: $(this).attr('data-completed')
            };

            $.post(url, postData, function(o){
                if(o.result == 1){
                    if(postData.completed == 1){
                        Result.success('Todo List Marked Completed');
                        $('#todo_'+postData.todo_id).addClass('todo_complete');
                        self.html('<i class="glyphicon glyphicon-remove"></i>');
                        self.attr('data-completed', 0);
                    }else{
                        Result.success('Todo List Marked In-Completed');
                        $('#todo_'+postData.todo_id).removeClass('todo_complete');
                        self.html('<i class="glyphicon glyphicon-ok"></i>');
                        self.attr('data-completed', 1);
                    }
                }else {
                    Result.error(o);
                }
            }, 'json');

        });
    };

    // ------------------------------------------------------------------------

    var update_note = function() {

        $("body").on('submit','.note_edit_form', function(evt){
            evt.preventDefault();
            var form = $(this);
            var url = $(this).attr('action');
            var postData = {
                'note_id': $(this).find('.note_id').val(),
                'title': $(this).find('.title').val(),
                'content': $(this).find('.content').val()
            }

            $.post(url,postData, function(o){
                if(o.result == 1){
                    Result.success("Success");
                    $("#note_title_"+ postData.note_id).html(postData.title);
                    $("#note_content_"+ postData.note_id).html(postData.content);
                    form.remove();
                }else{
                    Result.error(o);
                }
            }, 'json');

        });


    };
    
    // ------------------------------------------------------------------------
    
    var delete_todo = function() {
        $("body").on('click','.todo_delete', function(evt){
            evt.preventDefault();
            var self = $(this).parent('div');
            var url = $(this).attr('href');
            var postData = {
                'todo_id':$(this).attr('data_id')
            };
            $.post(url, postData, function(o){
               if(o.result == 1){
                   Result.success('Item Deleted');
                   $('#todo_'+postData.todo_id).remove();
               } else{
                   Result.error(o);
               }
            }, 'json');

        });
    };

    // ------------------------------------------------------------------------

    var delete_note = function() {
        $("body").on('click','.note_delete', function(evt){
            evt.preventDefault();
            var self = $(this).parent('div');
            var url = $(this).attr('href');
            var postData = {
                'note_id':$(this).attr('data_id')
            };
            $.post(url, postData, function(o){
                if(o.result == 1){
                    Result.success('Item Deleted');
                    $("#note_"+ postData.note_id).remove();
                } else{
                    Result.error(o);
                }
            }, 'json');

        });
    };

    var update_note_display = function() {
        $("body").on('click','.update_note_display', function(evt){
            evt.preventDefault();


            var note_id = $(this).attr('note_id');
            //alert(note_id);
            var output = Template.note_edit(note_id);
            $("#note_edit_container_"+ note_id).html(output);

        //    Change the value after the container is loaded in to the parent div.
            var title = $("#note_title_"+note_id).html();
            var content = $("#note_content_"+note_id).html();

            $("#note_edit_container_"+ note_id).find('.title').val(title);
            $("#note_edit_container_"+ note_id).find('.content').val(content);
        });

        $("body").on('click','.note_edit_cancel', function(evt){
            evt.preventDefault();
            $(this).parents('.note_edit_container').html('');

        });
    };

    var note_toggle = function(){
        $("body").on('click','.note_toggle', function(evt) {
            evt.preventDefault();
            var note_id = $(this).data('id');
            $("body").find("#note_content_show_"+note_id).toggleClass('hidden');
        });
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
