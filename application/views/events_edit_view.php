<form class="form-inline" id="edit-events" method="post" action="/events/insert/<?php echo $board_id;?>">
    <input type="hidden" id="board-id" name="board-id" value="<?php echo $board_id;?>"/>
    <div class="form-group">
        <select required class="form-control" name="relay-id" id="relay-id">
            <option value="">Relay #</option>
            <?php foreach($relays as $relay): ?>
                <option value="<?php echo $relay['id'];?>"><?php echo $relay['name'] .  ' #' . $relay['relay_id'];?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <input required type="text" class="form-control" name="time" id="time" placeholder="hh:mm:ss">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="days[Mon]"> Mon
        </label>
        <label>
            <input type="checkbox" name="days[Tue]"> Tue
        </label>
        <label>
            <input type="checkbox" name="days[Wed]"> Wed
        </label>
        <label>
            <input type="checkbox" name="days[Thu]"> Thu
        </label>
        <label>
            <input type="checkbox" name="days[Fri]"> Fri
        </label>
        <label>
            <input type="checkbox" name="days[Sat]"> Sat
        </label>
        <label>
            <input type="checkbox" name="days[Sun]"> Sun
        </label>
    </div>
    <div class="form-group">
        <select required class="form-control" name="state" id="state">
            <option value="">State</option>
            <option value="on">On</option>
            <option value="off">Off</option>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Add">
    <a href="#" class="btn btn-default hidden" id="close-event">Close</a>
    <a href="#" class="btn btn-danger hidden" id="delete-event">Delete</a>
</form>

<?php if (isset($events)): ?>
    <table class="table table-striped table-hover" id="events">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Time / Days</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($events as $event): ?>
                <tr
                data-event_id='<?php echo $event['id'];?>'
                data-relay_id='<?php echo $event['relay_u_id'];?>'
                data-time='<?php echo $event['time'];?>'
                data-days='<?php echo $event['days'];?>'
                data-state='<?php echo $event['state'];?>'>
                    <th scope="row"><?php echo $event['relay_id'];?></th>
                    <td><?php echo $event['name'];?></td>
                    <td><?php echo $event['time'];?> <?php echo trim(str_replace('"', '', $event['days']), '[]');?></td>
                    <td><?php echo $event['state'];?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>