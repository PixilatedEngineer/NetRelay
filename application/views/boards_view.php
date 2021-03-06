<?php foreach($boards as $board): ?>
    <div class="row">
        <div class="col-md-10">
            <h4>
                <?php echo $board['name'] . ' #' . $board['id']; ?>
                <?php echo ' (distributing panel @ ' . $board['location'] . ') '; ?>
                <?php echo 'IP: ' . $board['ip']; ?>
            </h4>
        </div>
        <div class="col-md-2 text-right">
            <a class="btn btn-default" href="/boards/edit/<?php echo $board['id']; ?>" role="button">Edit</a>
            <a class="btn btn-success" href="/events/<?php echo $board['id']; ?>" role="button">Events</a>
        </div>
    </div>
    <div class="row">
        <?php foreach($board['relays'] as $relay): ?>
            <div class="col-md-3 col-sm-6 col-xs-12 relays">
                <a href="#"
                   class="btn btn-r-disabled btn-full-width"
                   data-board-ip="<?php echo $board['ip'];?>"
                   data-relay-id="<?php echo $relay['relay_id']; ?>"
                   data-status="off">
                    <?php echo '#' . $relay['relay_id'] . '.' . $relay['name']; ?>
                    <?php if(isset($relay['event'])) echo '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>';?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <hr/>
<?php endforeach; ?>