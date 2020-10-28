$(document).ready(function(){

console.log(window.config);
    $(document).on('keyup','#search', function () {


        var search = $('#search').val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "/users/search",
            type: "POST",
            dataType: "json",

            data:{
                search:search,
                _token:_token
            },
            success: function (response) {

                fillTable(response);
                console.log(response);

            }
        });

    });
    function fillTable(data) {

        $('.column-row').remove();
        $(data[0]).each(function (row,values) {





            $("tbody").append('<tr class="column-row">' +
                (window.config.isModerator == 1 ? '<td>' + values.id +'</td>'  : '' ) +
                '<td>' + values.name +'</td>' +
                (window.config.isModerator == 1 ?'<td>'+ values.email +'</td>' : '') +
                '<td>'+ values.nickname +'</td>' +
                '<td>'+ values.created_at.substr(0,10) +'</td>'+
                '<td><div id="roles-container' +values.id +'"></div>' +(window.config.isAdmin== 1 ?
                '<form  action="'+ window.config.addRoute +'" method="post">' +
                '<input type="hidden" name="_token" value="'+ window.config.csrf +'"></input>'+
                '<p><select size="3" multiple name="roles[]" class="select-role">' +
                '<option disabled>Roles</option>' +
                ''+
                '</select></p>' +
                '<p><input type="submit" value="Add role" ></p>' +
                ' <input type="hidden" name="userId" value="'+ values.id +'">' +
                '</form>' : '') +'</td>' +
                '<td>' + '<a href="profile/'+ values.id +'/skills" class="btn btn-small btn-info">User Skills</a>' + '</td>'+
                (window.config.isModerator == 1 ?
                '<td>' + '<a href="admin/user/'+ values.id +'" class="btn btn-small btn-info">Edit this user</a>' + '</td>' : '') +
                '</tr>')

            $(values.roles).each(function (row,value) {

                $('<div>' + value.name +(window.config.isAdmin== 1 ?
                    '<form method="post" action="'+ window.config.deleteRoute +'" style="display: inline-block""> ' +
                    '<input type="hidden" value='+window.config.csrf+' name="_token">' +
                    '<input type="hidden" name="roleId" value="'+value.id+'">' +
                    '<input type="hidden" name="userId" value="'+values.id+'">'+
                    '<button style="outline: none;border: 0;background: transparent;width: 5px;height: 5px" type="submit">' +
                    '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
                    '<path fill-rule="evenodd" //                                                                       d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>\n' +
                    '</svg>'+
                    '</button>'+
                    '</form>': '') + '</div>').appendTo("#roles-container"+values.id);
            })

        })
        if (window.config.isAdmin == 1){ $(data[1]).each(function (row,values) {
            $('<option value="'+ values.id +'">'+ values.name +'</option>').appendTo(".select-role");
        })}

    }
});

