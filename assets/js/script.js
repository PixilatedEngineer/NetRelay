$(function() {

    function get_form_group(number){
        return '<div class="form-group"><div class="row"><label class="col-xs-2 col-sm-2 col-md-2" for="relay-name-' + number + '">#' + number + '</label><div class="col-xs-10 col-sm-10 col-md-10"><input type="text" class="form-control" name="relays[' + number + ']" id="relay-name-' + number + '" placeholder="Relay Name"></div></div></div>';
    }

    $('#relays-number').on('change', function(){
        var relas_number = $(this).val(),
            cols = relas_number / 4,
            rows = 4,
            relays_html = '<div class="row">',
            number = 1;

        if(cols == 8){
            cols = 4;
            rows = 8;
        }

        for(var i = 1; i <= cols; i++){
            relays_html += '<div class="col-sm-6 col-md-3">';
                for(var j = 1; j <= rows; j++, number++){
                    relays_html += get_form_group(number);
                }
            relays_html += '</div>';
        }
        relays_html += '</div>';

        $('.relays-edit-group').html(relays_html);
    });

    $('#events.table-hover tbody tr').on('click', function(){
        $('#close-event').removeClass('hidden');
        $('#delete-event').removeClass('hidden').attr('href', '/events/delete/' + $(this).data('event_id'));

        var edit_events = $('#edit-events');
        edit_events.attr('action', '/events/update/' + $(this).data('event_id'));
        edit_events.find('#relay-id').find('option[value=' + $(this).data('relay_id') + ']').prop('selected', true);
        edit_events.find('#time').val($(this).data('time'));
        edit_events.find('#state').find('option[value=' + $(this).data('state') + ']').prop('selected', true);
        edit_events.find('input[type=submit]').val('Edit');

        var days = $(this).data('days');
        edit_events.find('input[type=checkbox]').prop('checked', false);
        $.each(days, function(index, value){
            edit_events.find('input[type=checkbox][name="days[' + value + ']"]').prop('checked', true);
        });
    });

    $('#close-event').on('click', function(){
        $(this).addClass('hidden');
        $('#delete-event').addClass('hidden');

        $('#edit-events').find('input[type=submit]').val('Add');

        $(':input', '#edit-events')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    });

    $('.relays a').on('click', function(){
        $.post('/relays/exec', {ip: $(this).data('board-ip'), relay_id: $(this).data('relay-id'), status: $(this).data('status')});
        if($(this).data('status') == 'on') {
            $(this).data('status', 'off');
            $(this).removeClass('btn-primary').addClass('btn-info');
        } else {
            $(this).data('status', 'on');
            $(this).removeClass('btn-info').addClass('btn-primary');
        }
    });

});